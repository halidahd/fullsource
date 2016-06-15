<?php
/**
 * Created by Halh.
 * @author Halh
 * @verison 1.0
 * Date: 3/19/14
 * Time: 8:57 AM
 */
Require_once "baseAPI.php";

class templates extends baseAPI
{

	protected $required = array(
		"edit"   => array(
			"id",
			"email",
			"Name",
			"Format",
			"TextContent",
			"myDevEditControl_html",
			"isglobal",
			"active",
		),
		"create" => array(
			"TemplateID",
			"email",
			"Name",
			"Format",
			"TextContent",
			"myDevEditControl_html",
			"isglobal",
			"active",
		),
		"change" => array(
			"email",
			'changetype',
			'templates'
		),
		"view"   => array(
			"email",
			'id'
		),
	);

	protected $default = array(
		"create" => array(
			'active'   => 1,
			'isglobal' => 0,
		),
		"edit"   => array(
			'active'   => 1,
			'isglobal' => 0,
		),
	);

	var $sendstudio_functions;

	function __construct()
	{
		parent::__construct(__CLASS__);

		//Load sendstudio function
		if (is_null($this->sendstudio_functions)) {
			if (!class_exists('sendstudio_functions', false)) {
				require_once(SENDSTUDIO_FUNCTION_DIRECTORY . '/sendstudio_functions.php');
			}
			$ss_functions = new Sendstudio_Functions();
			$this->sendstudio_functions = & $ss_functions;
		}

		IEM::langLoad("Templates");
		IEM::langLoad("Newsletters");
	}

	function _parseCookieInfo()
	{
		$cookie_info = IEM::requestGetCookieCRC('IEM_CookieLogin', false);

		if (!$cookie_info || !isset($cookie_info['access_token'])) {
			return false;
		}

		if (isset($cookie_info['acc']) && $cookie_info['acc']) {
			return json_decode($cookie_info['acc'], true);
		}

		return false;
	}

	function Process()
	{

		$subaction = IEM::requestGetGET('subaction', '', "strtolower");

		if (!$subaction) $subaction = IEM::requestGetGET('type', '', "strtolower");

		$action = $subaction;

		$this->_validateParamRequired($action);

		$data = $this->Get('data');

		$userapi = $this->GetApi('User');

		$userid = $userapi->Find($data['email']);
		unset($userapi);

		if (!$userid) {
			$this->DenyAccess();
		}

		$user = & GetUser($userid);

		if (!in_array($user->groupid, getGroupOfUserIDVG())) {
			$this->DenyAccess("Nhóm tài khoản không được cho phép");
		}

		// map the actions to the permissions required to do them
		$effective_permission = array(
			''                  => NULL,
			'activate'          => 'approve',
			'activateglobal'    => 'global',
			'addtemplate'       => 'create',
			'builtin'           => 'builtin',
			'change'            => 'edit',
			'complete'          => 'view',
			'copy'              => 'view',
			'create'            => 'create',
			'deactivate'        => 'approve',
			'deactivateglobal'  => 'global',
			'edit'              => 'edit',
			'manage'            => NULL,
			'save'              => 'edit',
			'view'              => 'view',
			'viewcompatibility' => NULL,
		);

		$access = false;

		if (!isset($data['id'])) {
			// we are not dealing with a particular template
			$access = $user->HasAccess('Templates', $effective_permission[$action]);
		} else if (!is_numeric($data['id'])) {
			// we are dealing with a particular built-in template
			$access = $user->HasAccess('Templates', 'builtin');
		} else {
			// we are dealing with a particular user template
			$id = intval($data['id']);
			if ($id == 0 && $action == 'create') {
				// we are saving/creating a new template
				$access = $user->HasAccess('Templates', $action);
			} else {
				$templates = array_keys($user->GetTemplates());
				if (in_array($id, $templates)) {
					// we at least have 'view' access
					if ($effective_permission[$action] == 'view') {
						$access = true;
					} else {
						$access = $this->_haveTemplateAccess($id, $effective_permission[$action]);
					}
				}
			}
		}

		if (!$access) {
			$this->DenyAccess();
		}

		switch ($action) {
			case 'view':
				$details = array();
				$id = (isset($data['id'])) ? $data['id'] : 0;
				$type = strtolower(get_class($this));
				$template = $this->GetApi('Templates');
				if (is_numeric($id)) {
					if (!$template->Load($id)) {
						$details['textcontent'] = GetLang('UnableToLoadTemplate');
						$details['htmlcontent'] = '';
						$details['format'] = 't';
					} else {
						$details['htmlcontent'] = $template->GetBody('HTML');
						$details['textcontent'] = $template->GetBody('Text');
						$details['format'] = $template->format;
					}
				} else {
					$templatename = str_replace('servertemplate_', '', $id);

					$results = $template->ReadServerTemplate($templatename);
					if (!$results) {
						$details['textcontent'] = GetLang('UnableToLoadTemplateFromServer');
						$details['htmlcontent'] = '';
						$details['format'] = 't';
					} else {
						$details['htmlcontent'] = $results;
						$details['textcontent'] = '';
						$details['format'] = 'h';
					}
				}
				$this->SendResponse(self::HTTP_OK, $details);
				break;

			case 'activate':
			case 'deactivate':
				$access = $user->HasAccess('Templates', 'approve');
				if (!$access) {
					$this->DenyAccess();
				}

				$id = (int)$data['id'];
				$templateapi = $this->GetApi('Templates');
				$templateapi->Load($id);
				$msg = '';

				switch ($action) {
					case 'activate':
						$templateapi->Set('active', $user->Get('userid'));
						$msg .= GetLang('Template_ActivatedSuccessfully');
						break;
					case 'deactivate':
						$templateapi->Set('active', 0);
						if ($templateapi->IsGlobal()) {
							$msg .= GetLang('TemplateCannotBeInactiveAndGlobal');

						}
						$msg .= GetLang('Template_DeactivatedSuccessfully');
				}
				if ($templateapi->Save()) {
					$this->SendResponse(self::HTTP_OK, $msg);
				} else {
					$this->SendResponse(self::HTTP_FORBIDDEN, $msg);
				}
				break;
			case 'activateglobal':
			case 'deactivateglobal':
				$access = $user->HasAccess('Templates', 'Global');
				if (!$access) {
					$this->DenyAccess();
				}

				$id = (int)$data['id'];
				$templateapi = $this->GetApi('Templates');
				$templateapi->Load($id);

				$message = '';

				switch ($action) {
					case 'activateglobal':
						$templateapi->Set('isglobal', $user->Get('userid'));
						$message .= GetLang('Template_Global_ActivatedSuccessfully');
						if (!$templateapi->Active()) {
							$message .= GetLang('TemplateCannotBeInactiveAndGlobal');
						}
						break;
					case 'deactivateglobal':
						$templateapi->Set('isglobal', 0);
						$message .= GetLang('Template_Global_DeactivatedSuccessfully');
						break;
				}
				if ($templateapi->Save()) {
					$this->SendResponse(self::HTTP_OK, $message);
				} else {
					$this->SendResponse(self::HTTP_FORBIDDEN, $message);
				}
				break;
			case 'delete':
				$templateid = (int)$data['id'];
				$access = $user->HasAccess('Templates', 'Delete');
				if ($access) {
					$this->DeleteTemplates(array($templateid));
				} else {
					$this->DenyAccess();
				}
				break;
			case 'change':
				$subaction = strtolower($data['changetype']);
				$templatelist = $data['templates'];

				switch ($subaction) {
					case 'delete':
						$access = $user->HasAccess('Templates', 'Delete');
						if ($access) {
							$this->DeleteTemplates($templatelist);
						} else {
							$this->DenyAccess();
						}
						break;

					case 'activate':
					case 'deactivate':
						$access = $user->HasAccess('Templates', 'Approve');
						if ($access) {
							$this->ActionTemplates($templatelist, $subaction);
						} else {
							$this->DenyAccess();
						}
						break;

					case 'global':
					case 'disableglobal':
						$access = $user->HasAccess('Templates', 'Global');
						if ($access) {
							$this->ActionTemplates($templatelist, $subaction);
						} else {
							$this->DenyAccess();
						}
						break;
				}
				break;
			case 'edit':
				$template = $this->GetApi('Templates');

				$id = (isset($data['id'])) ? (int)$data['id'] : 0;
				$template->Load($id);

				$edittemplate = array('id' => $id);
				$checkfields = array('Name', 'Format');
				$valid = true;
				$errors = array();
				foreach ($checkfields as $p => $field) {
					if ($data[$field] == '') {
						$valid = false;
						$errors[] = GetLang('Template' . $field . 'IsNotValid');
						break;
					} else {
						$value = $data[$field];
						$edittemplate[$field] = $value;
					}
				}

				if (!$valid) {
					$GLOBALS['Error'] = GetLang('UnableToUpdateTemplate') . '<br/>- ' . implode('<br/>- ', $errors);

					$this->SendResponse(self::HTTP_FORBIDDEN, $GLOBALS['Error']);
				}


				$session_template = $edittemplate;

				if (isset($data['TextContent'])) {
					$template->SetBody('Text', $data['TextContent']);
					$textcontent = $data['TextContent'];
				}

				if (isset($data['myDevEditControl_html'])) {
					$htmlcontent = $data['myDevEditControl_html'];

					/**
					 * This is an effort not to overwrite the eixsting HTML contents
					 * if there isn't any contents in it (DevEdit will have '<html><body></body></html>' as a minimum
					 * that will be passed to here)
					 */
					if (trim($htmlcontent) == '') {
						$GLOBALS['Error'] = GetLang('UnableToUpdateTemplate');
						$this->SendResponse(self::HTTP_FORBIDDEN, $GLOBALS['Error']);
					}

					$template->SetBody('HTML', $data['myDevEditControl_html']);
				}

				foreach (array('Name', 'Format') as $p => $area) {
					$template->Set(strtolower($area), $session_template[$area]);
				}

				$template->Set('active', 0);
				if ($user->HasAccess('Templates', 'Approve', $id)) {
					if (isset($data['active'])) {
						$template->Set('active', $user->Get('userid'));
					}
				}

				$template->Set('isglobal', 0);

				if ($user->HasAccess('Templates', 'Global') && isset($data['isglobal'])) {
					$template->Set('isglobal', 1);
				}

				$dest = strtolower(get_class($this));
				$movefiles_result = $this->sendstudio_functions->MoveFiles($dest, $id);
				if ($movefiles_result) {
					if (isset($textcontent)) {
						$textcontent = $this->sendstudio_functions->ConvertContent($textcontent, $dest, $id);
						$template->SetBody('Text', $textcontent);
					}
					if (isset($htmlcontent)) {
						$htmlcontent = $this->sendstudio_functions->ConvertContent($htmlcontent, $dest, $id);
						$template->SetBody('HTML', $htmlcontent);
					}
				}

				$result = $template->Save();

				if (!$result) {
					$GLOBALS['Error'] = GetLang('UnableToUpdateTemplate');
					$this->SendResponse(self::HTTP_FORBIDDEN, $GLOBALS['Error']);
				} else {
					$msg = ' Cập nhật thành công. ';
					if (!$template->Active() && isset($data['isglobal'])) {
						$msg .= GetLang('TemplateCannotBeInactiveAndGlobal');
					}
				}
				$this->SendResponse(self::HTTP_OK, $msg);
				break;

			case 'create':

				$newtemplateid = false;
				if (isset($data['TemplateID'])) {
					$newtemplateid = $data['TemplateID'];
				}

				$newtemplate = array();
				$checkfields = array('Name', 'Format');
				$valid = true;
				$errors = array();
				foreach ($checkfields as $p => $field) {
					if ($_POST[$field] == '') {
						$valid = false;
						$errors[] = GetLang('Template' . $field . 'IsNotValid');
						break;
					} else {
						$value = $data[$field];
						$newtemplate[$field] = $value;
					}
				}
				if (!$valid) {
					$GLOBALS['Error'] = GetLang('UnableToCreateTemplate') . '<br/>- ' . implode('<br/>- ', $errors);
					$this->SendResponse(self::HTTP_FORBIDDEN, $GLOBALS['Error']);
				}

				$user = & GetUser($userid);
				$session_template = $newtemplate;

				$newtemplate = $this->GetApi('Templates');

				//Kiểm tra mẫu tồn tại trên hệ thống
				if ($newtemplate->Find($newtemplateid)) {
					$this->SendResponse(self::HTTP_FORBIDDEN, 'Mẫu đã tồn tại trên hệ thống, không thể tạo mới');
				}

				if (isset($_POST['TextContent'])) {
					$textcontent = $data['TextContent'];
					$newtemplate->SetBody('Text', $textcontent);
				}
				if (isset($data['myDevEditControl_html'])) {
					$htmlcontent = $data['myDevEditControl_html'];
					$newtemplate->SetBody('HTML', $htmlcontent);
				}

				foreach (array('Name', 'Format') as $p => $area) {
					$newtemplate->Set(strtolower($area), $session_template[$area]);
				}

				$newtemplate->Set('active', 0);
				if ($user->HasAccess('Templates', 'Approve')) {
					if (isset($data['active'])) {
						$newtemplate->Set('active', $user->Get('userid'));
					}
				}

				$newtemplate->Set('isglobal', 0);

				if ($user->HasAccess('Templates', 'Global') && isset($data['isglobal'])) {
					$newtemplate->Set('isglobal', 1);
				}

				$newtemplate->ownerid = $user->userid;
				$result = $newtemplate->Create();

				if (!$result) {
					$GLOBALS['Error'] = GetLang('UnableToCreateTemplate');
					$this->SendResponse(self::HTTP_FORBIDDEN, $GLOBALS['Error']);
				}

				$msg = ' Tạo mới thành công ';

				if (!$newtemplate->Active() && isset($_POST['isglobal'])) {
					$msg .= GetLang('TemplateCannotBeInactiveAndGlobal');
				}

				if ($newtemplateid) {
					if (!$newtemplate->SaveTemplateId($result, $newtemplateid)) {
						$msg .= " Không thể cập nhật Id " . $newtemplateid;
					}
				}

				$dest = strtolower(get_class($this));
				$movefiles_result = $this->sendstudio_functions->MoveFiles($dest, $result);
				if ($movefiles_result) {
					if (isset($textcontent)) {
						$textcontent = $this->sendstudio_functions->ConvertContent($textcontent, $dest, $result);
						$newtemplate->SetBody('Text', $textcontent);
					}
					if (isset($htmlcontent)) {
						$htmlcontent = $this->sendstudio_functions->ConvertContent($htmlcontent, $dest, $result);
						$newtemplate->SetBody('HTML', $htmlcontent);
					}
				}
				$newtemplate->Save();

				$user->LoadPermissions($user->userid);
				$user->GrantTemplateAccess($result);
				$user->SavePermissions();

				$this->SendResponse(self::HTTP_OK, $msg);

				break;
			default:

				break;
		}

		$this->SendResponse(self::HTTP_FORBIDDEN, "Không tồn tại hành động yêu cầu");
	}


	/**
	 * DeleteTemplates
	 * This will attempt to delete the templates based on the id's passed in.
	 * It checks whether you are trying to delete a global template, if you are and you don't have access, an error message is shown.
	 * If you are the owner of the template, you can do whatever you like with it.
	 * It will also remove permissions for this user so in future it won't show up (just in case).
	 *
	 * @param Array $templateids An array of templateid's to delete
	 *
	 * @see GetApi
	 * @see API::CheckIntVars
	 * @see ManageTemplates
	 * @see GetUser
	 * @see Templates_API::Load
	 * @see Templates_API::IsGlobal
	 * @see User_API::HasAccess
	 * @see User_API::RevokeTemplateAccess
	 * @see User_API::SavePermissions
	 * @see Templates_API::Delete
	 * @see FormatNumber
	 *
	 * @return Void Doesn't return anything. Deletes the templateid's passed in if it can, then prints out a message about what actions did or didn't occur.
	 */
	function DeleteTemplates($templateids = array())
	{
		if (!is_array($templateids)) {
			$templateids = array($templateids);
		}

		$api = $this->GetApi('Templates');
		$templateids = $api->CheckIntVars($templateids);

		if (empty($templateids)) {
			$this->SendResponse(self::HTTP_FORBIDDEN, GetLang('NoTemplatesSelected'));
		}

		$user = & GetUser();

		$delete_ok = $delete_fail = 0;
		$delete_fail_messages = array();

		$images_found_messages = array();

		$user->LoadPermissions($user->userid);

		foreach ($templateids as $p => $templateid) {
			$api->Load($templateid);
			if ($api->IsGlobal() && !$user->HasAccess('Templates', 'Global')) {
				$delete_fail++;
				$delete_fail_messages[$templateid] = sprintf(GetLang('CannotDeleteGlobalTemplate_NoAccess'), $api->Get('name'));
				continue;
			}

			$status = $api->Delete($templateid);
			if ($status) {
				$delete_ok++;
				$user->RevokeTemplateAccess($templateid);

				$preview_file = SENDSTUDIO_RESOURCES_DIRECTORY . '/user_template_previews/' . $templateid . '_preview.gif';
				if (is_file($preview_file)) {
					$images_found_messages[] = sprintf(GetLang('DeleteTemplatePreview_Image'), $templateid);
				}

			} else {
				$delete_fail++;
			}
		}

		$user->SavePermissions();

		$msg = '';

		if ($delete_fail > 0) {
			if (empty($delete_fail_messages)) {
				if ($delete_fail == 1) {
					$msg .= GetLang('Template_NotDeleted');
				} else {
					$msg .= sprintf(GetLang('Templates_NotDeleted'), $this->FormatNumber($delete_fail));
				}
			} else {
				foreach ($delete_fail_messages as $templateid => $message) {
					$msg .= $message;
				}
			}
		}

		if ($delete_ok > 0) {
			if ($delete_ok == 1) {
				$msg .= GetLang('Template_Deleted');
			} else {
				$msg .= sprintf(GetLang('Templates_Deleted'), $this->FormatNumber($delete_ok));
			}
		}

		if (!empty($images_found_messages)) {
			if ($user->TemplateAdmin()) {
				$GLOBALS['Warning'] = implode('<br/>', $images_found_messages);

				$this->logs($GLOBALS['Warning'], __CLASS__ . "_" . __FUNCTION__ . ".log");
			}
		}

		$this->SendResponse(self::HTTP_OK, $msg);
	}

	/**
	 * ActionTemplates
	 * This will perform the action passed in to all the templates in the array.
	 * The action can be approve, disapprove, global, disableglobal only. Anything else throws an error message and the user is taken back to the manage templates page.
	 *
	 * @param Array $templateids An array of templateid's to perform an action on
	 * @param String $action The action to perform. Can be one of approve, disapprove, global, disableglobal.
	 *
	 * @see GetApi
	 * @see API::CheckIntVars
	 * @see ManageTemplates
	 * @see GetUser
	 * @see Templates_API::Load
	 * @see Templates_API::Save
	 * @see FormatNumber
	 *
	 * @return Void Doesn't return anything. Processes the templates based on the action, prints a message out about what happened and takes the user back to the manage templates screen.
	 */
	function ActionTemplates($templateids = array(), $action = '')
	{
		if (!is_array($templateids)) {
			$templateids = array($templateids);
		}

		$templateapi = $this->GetApi('Templates');

		$templateids = $templateapi->CheckIntVars($templateids);

		if (empty($templateids)) {
			$GLOBALS['Error'] = GetLang('NoTemplatesSelected');
			$this->SendResponse(self::HTTP_FORBIDDEN, $GLOBALS['Error']);
		}

		$action = strtolower($action);

		if (!in_array($action, array('activate', 'deactivate', 'approve', 'disapprove', 'global', 'disableglobal'))) {
			$GLOBALS['Error'] = GetLang('InvalidTemplateAction');
			$this->SendResponse(self::HTTP_FORBIDDEN, $GLOBALS['Error']);
		}

		$user = & GetUser($this->userRecord['userid']);

		$update_ok = $update_fail = 0;
		foreach ($templateids as $p => $templateid) {
			$templateapi->Load($templateid);

			switch ($action) {
				case 'approve':
				case 'activate':
					$langvar = 'Approved';
					$templateapi->Set('active', $user->Get('userid'));
					break;

				case 'disapprove':
				case 'deactivate':
					$langvar = 'Disapproved';
					$templateapi->Set('active', 0);
					break;

				case 'global':
					$langvar = 'Global';
					$templateapi->Set('isglobal', $user->Get('userid'));
					break;

				case 'disableglobal':
					$langvar = 'DisableGlobal';
					$templateapi->Set('isglobal', 0);
					break;
			}
			$status = $templateapi->Save();
			if ($status) {
				$update_ok++;
			} else {
				$update_fail++;
			}
		}

		$msg = '';

		if ($update_fail > 0) {
			if ($update_fail == 1) {
				$GLOBALS['Error'] = GetLang('Template_Not' . $langvar);
			} else {
				$GLOBALS['Error'] = sprintf(GetLang('Templates_Not' . $langvar), $this->FormatNumber($update_fail));
			}
			$msg .= $GLOBALS['Error'];
		}

		if ($update_ok > 0) {
			if ($update_ok == 1) {
				$msg .= GetLang('Template_' . $langvar);
			} else {
				$msg .= sprintf(GetLang('Templates_' . $langvar), $this->FormatNumber($update_ok));
			}
		}

		$this->SendResponse(self::HTTP_OK, $msg);
	}

	/**
	 * Have Access
	 * Check whether or not current user have access to the template
	 *
	 * @param array|integer $templateRecord Template record or template ID to check
	 * @param string $action Action to check
	 *
	 * @return boolean Returns TRUE if user have access, FALSE otherwise
	 */
	private function _haveTemplateAccess($templateRecord, $action)
	{
		$currentUser = & GetUser($this->userRecord['userid']);

		if (!is_array($templateRecord)) {
			$templateid = intval($templateRecord);
			if ($templateid == 0) {
				return false;
			}

			$templateapi = $this->GetApi('Templates');
			if (!$templateapi->Load($templateid)) {
				return false;
			}

			// For now these two arrays will suffice.
			$templateRecord = array(
				'templateid' => $templateid,
				'ownerid'    => $templateapi->ownerid
			);
		}

		// Owner always have access
		if (array_key_exists('ownerid', $templateRecord) && $templateRecord['ownerid'] == $currentUser->userid) {
			return true;
		}

		if (array_key_exists('templateid', $templateRecord)) {
			return $currentUser->HasAccess('Templates', $action, $templateRecord['templateid']);
		}

		// Invalid record
		return false;
	}
}