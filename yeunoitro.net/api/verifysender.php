<?php
/**
 * Created by Halh.
 * @author Halh
 * @verison 1.0
 * Date: 3/19/14
 * Time: 8:57 AM
 */
Require_once "baseAPI.php";

class verifysender extends baseAPI
{

	protected $required = array();

	protected $default = array();

	var $ses;

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

		IEM::langLoad("verifysender");
	}

	function Process()
	{
		$GLOBALS['Message'] = '';

		$subaction = IEM::requestGetGET('subaction', '', "strtolower");

		if (!$subaction) $subaction = IEM::requestGetGET('type', '', "strtolower");

		$action = $subaction;

		$this->_validateParamRequired($action);

		$data = $this->Get('data');
		$userRecord = $this->Get('userRecord');

		$user = GetUser($userRecord['userid']);

		$check_access = $action;

		$all_permision = array('check','view');

		if(in_array($check_access,$all_permision)) {
			$check_access = 'all';
		}

		$access = $user->HasAccess('verifysender', $check_access);

		if (!$access) {
			$this->DenyAccess();
		}

		switch ($action) {
			case 'check':
			case 'view':
				$verifyEmailapi = $this->GetApi('verifysender');
				$verifyEmailowner = ($user->Admin() || $user->AdminType() == 'n') ? 0 : $user->userid;

				$NumberOfNewsletters = $verifyEmailapi->GetEmailVerify($user->userid, array(), true);

				if ($NumberOfNewsletters <= 0) {
					$this->SendResponse(self::HTTP_OK, array());
				}

				$mynewsletters = $verifyEmailapi->GetEmailVerify($user->userid, array(), false);

				switch ($subaction) {
					case 'view':

						if (!empty($mynewsletters)) {
							$this->SendResponse(self::HTTP_OK, $mynewsletters, '', '_trigger_action');
						}
						break;
					case 'check':
						$id = (isset($data['email']) && $data['email']) ? $data['email'] : 0;

						if (array_key_exists($id, $mynewsletters) && $mynewsletters[$id]['status'] == GetLang('Status_EmailVerified')) {
							$this->SendResponse(self::HTTP_OK, $id, '', '_trigger_action');
						}

						$this->SendResponse(self::HTTP_FORBIDDEN, "Trạng thái của {$id} chưa được xác minh");
						break;
				}

				$this->SendResponse(self::HTTP_FORBIDDEN, "Không tìm thấy địa chỉ gửi");

				break;
			case 'delete':
				$id = (isset($data['email']) && $data['email']) ? $data['email'] : 0;
				$verifyEmail = array($id);

				$access = $user->HasAccess('verifysender', 'delete');

				if ($access) {

					$this->DeleteEmail($verifyEmail);
				} else {

					$this->DenyAccess();
				}
				break;
			case 'activate':
			case 'deactivate':

				$id = $data['email'];
				$verifysender = $this->GetApi('verifysender');
				$message = '';

				if ($user->HasAccess('verifysender', 'Create')) {

					if (!$user->HasAccess('verifysender', $action)) {
						$this->DenyAccess();
						break;
					}

					switch ($action) {
						case 'activate':

							$countEmailofUser = $verifysender->GetEmailVerify($user->userid, array(), true,  $start=0, $perpage=20, $getLastSentDetails = false, GetLang('Status_EmailVerified'));

							if ($countEmailofUser >= isset($userRecord['limit_email_sender'])?$userRecord['limit_email_sender']:1) {
								$this->SendResponse(self::HTTP_FORBIDDEN, sprintf(GetLang('Limited_Total_Email'), 1));
							}

							if ($verifysender->Active($id)) {

								//add callback 1 func
								$this->SendResponse(self::HTTP_OK, GetLang('emailVerifyActivedSuccessfully'), '', '_trigger_action');
							} else {
								$this->SendResponse(self::HTTP_FORBIDDEN, GetLang('emailVerifyActivedError'));
							}

							break;
						case 'deactivate':

							if ($verifysender->Active($id, false)) {

								$this->SendResponse(self::HTTP_OK, GetLang('emailVerifyActivedNotSuccessfully'), '', '_trigger_action');
							} else {

								$this->SendResponse(self::HTTP_FORBIDDEN, GetLang('emailVerifyActivedError'));
							}
							break;
					}
				}

				break;
			case 'create':

				//Lưu Email vào bảng. Yêu cầu người sử dụng phải có quyền save.
				$tempAPI = $this->GetApi('verifysender');
				if (!$user->HasAccess('verifysender', 'Create')) {

					$this->DenyAccess();

					return;
				}

				//Luu dia chi post.
				if (isset($data['email']) && $data['email']) $tempAPI->email = $data['email'];

				//Kiểm tra đã tồn tại Email trong hệ thống chưa.
				if (!$tempAPI->checkDuplicate($tempAPI->email)) {

					$this->SendResponse(self::HTTP_FORBIDDEN, sprintf(GetLang('EmailAddFail_AlreadyExists'), $tempAPI->email));
				}

				//Check valid email
				if (!validEmail($tempAPI->email)) {

					$this->SendResponse(self::HTTP_FORBIDDEN, sprintf(GetLang('EmailAddFail_InvalidEmailAddress'), $tempAPI->email));
				}

				//Kiểm tra giới hạn số địa chỉ cho phép
				$countEmailofUser = $tempAPI->GetEmailVerify($user->userid, array(), true,  $start=0, $perpage=20, $getLastSentDetails = false, GetLang('Status_EmailVerified'));

				if ($countEmailofUser >= isset($userRecord['limit_email_sender'])?$userRecord['limit_email_sender']:1) {
					$this->SendResponse(self::HTTP_FORBIDDEN, sprintf(GetLang('Limited_Total_Email'), 1));
				}

				$tempAPI->ownerid = $user->userid;
				if ($tempAPI->create()) {

					$this->SendResponse(self::HTTP_OK, sprintf(GetLang('emailVerifyCreatedAndActiveSuccessfully'), $tempAPI->email), '', '_trigger_action');
				}

				break;

			default:
				break;
		}

		$this->SendResponse(self::HTTP_FORBIDDEN, "Không tồn tại hành động yêu cầu");
	}

	/**
	 * Thực hiện hành động sau khi trả về response, kết quả được output ra trước và xử lý sau
	 * => đảm bảo thời gian time out ngay lập tức.
	 * => tách bạch nghiệp vụ của các hàm.
	 * => dễ debug
	 *
	 */
	function _trigger_action()
	{

		$subaction = IEM::requestGetGET('subaction', '', "strtolower");

		if (!$subaction) $subaction = IEM::requestGetGET('type', '', "strtolower");

		$data = $this->Get('data');

		$this->ses = new SimpleEmailService(EM_DEFAULT_AMAZON_ACCESS_KEY, EM_DEFAULT_AMAZON_SECRET_KEY);
		$this->debug = true;

		if (!isset($this->ses)) {
			$this->logs('Không gọi được Class SES', __FUNCTION__ . ".log");
		};

		$response = '';

		switch ($subaction) {
			case 'delete':
				$response = $this->ses->deleteVerifiedEmailAddress($data['email']);
				break;
			case 'activate':

			$response = $this->ses->verifyEmailAddress($data['email']);
				break;
			case 'deactivate':
				$response = $this->ses->deleteVerifiedEmailAddress($data['email']);
				break;
			case 'create':
				$response = $this->ses->verifyEmailAddress($data['email']);
				break;
			default:
				break;
		}

		$this->logs(json_encode($response), __FUNCTION__ . ".log");

		//Cập nhật lại tất cả trạng thái ứng với tình trạng trên Amazon
		$this->RefreshActive();
	}


	/**
	 *  Refresh status active
	 */
	function RefreshActive($showmessage = false)
	{
		if (!isset($this->ses)) {
			$this->logs('Không gọi được Class SES');
		}

		$api = $this->GetApi('verifysender');
		$userRecord = $this->Get('userRecord');

		$myemails = $api->GetEmailVerify($userRecord['userid']);

		$api->ownerid = $userRecord['userid'];

		//Get list email verified
		$listVerified = $this->ses->listVerifiedEmailAddresses();

		if (empty($listVerified)) {
			$this->logs("Lỗi cấu hình dịch vụ API. Không tìm thấy danh sách Email, Vui lòng kiểm tra lại thông tin truy cập dịch vụ hoặc liên hệ quản trị để biết thêm.", __FUNCTION__ . ".log");

			return;
		}

		foreach ($myemails as $myemail) {
			//neu
			if (!in_array(trim($myemail['email']), $listVerified['Addresses'])) {
				if ($myemail['status'] != GetLang('Status_EmailPending')) {
					//Update trang thai thanh ngừng hoạt động.
					$api->save($myemail['email'], GetLang('Status_EmailNotActive'));
				}
				continue;
			}

			//Check trạng thái của Email.
			if (!$this->ses->GetIdentityVerificationAttributes($myemail['email'])) {
				continue;
			}

			//Nếu email verified và không ở trạng thái xác minh, update trang thai thanh da xu ly.
			if (
				$myemail['status'] != GetLang('Status_EmailVerified')
				&&
				$api->Save($myemail['email'], GetLang('Status_EmailVerified'))
			) {
				//Thông báo địa chỉ đã được xác minh
				$this->logs(sprintf(GetLang('emailVerifiedSuccess') . " : " . GetLang('Status_EmailVerified'), $myemail['email']));
			}
		}
	}

	function DeleteEmail($verifyEmailids = array())
	{
		if (!is_array($verifyEmailids)) {
			$verifyEmailids = array($verifyEmailids);
		}

		if (empty($verifyEmailids)) {

			$this->SendResponse(self::HTTP_FORBIDDEN, GetLang('NoEmailVerifyToDelete'));
		}
		$userRecord = $this->Get('userRecord');

		$user = GetUser($userRecord['userid']);
		$api = $this->GetApi('verifysender');

		$sends_in_progress = array();
		$delete_ok = $delete_fail = 0;

		//Xoá các email trong danh sách.
		foreach ($verifyEmailids as $p => $verifyEmailid) {

			if ($api->delete($verifyEmailid, $user->userid)) {
				$delete_ok++;
			} else {
				$delete_fail++;
			}
		}

		$msg = '';

		if ($delete_ok > 0) {
			if ($delete_ok == 1) {
				$msg .= GetLang('verifyEmail_Deleted');
			} else {

				$msg .= sprintf(GetLang('verifyEmail_Deleted'), $this->FormatNumber($delete_ok));
			}
		}

		if ($delete_fail > 0) {
			if ($delete_fail == 1) {
				$msg .= GetLang('verifyEmail_faildelete');
			} else {
				$msg .= sprintf(GetLang('verifyEmail_faildelete'), $this->FormatNumber($delete_fail));
			}
		}

		$this->SendResponse(self::HTTP_OK, $msg, '', "_trigger_action");
	}
}