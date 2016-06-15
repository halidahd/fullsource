<?php
/**
 * Created by Halh.
 * @author Halh
 * @verison 1.0
 * Date: 3/19/14
 * Time: 8:57 AM
 */
Require_once "baseAPI.php";

class newsletter extends baseAPI
{

	protected $required = array(
		"create" => array(
			'Subject',
			'TextContent',
			'HtmlContent',
			'Name',
		)
	);

	protected $default = array();

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

		IEM::langLoad("newsletters");
	}

	function create()
	{

		$user = GetUser($this->userRecord['userid']);

		$newnewsletter = $this->GetApi('newsletters');


		if (isset($this->data['TextContent'])) {
			$newnewsletter->SetBody('Text', $this->data['TextContent']);
		}

		if (isset($this->data['HtmlContent'])) {
			$newnewsletter->SetBody('HTML', $this->data['HtmlContent']);
		}

		if (isset($this->data['Subject'])) {
			$newnewsletter->Set('subject', $this->data['Subject']);
		}

		$newnewsletter->Set('active', 0);
		if ($user->HasAccess('newsletters', 'approve')) {
			if (isset($this->data['Active'])) {
				$newnewsletter->Set('active', $user->Get('userid'));
			}
		}

		$newnewsletter->Set('archive', 1);
		if (isset($this->data['Archive'])) {
			$newnewsletter->Set('archive', $this->data['Archive']);
		}

		foreach (array('Name', 'Format') as $p => $area) {
			$newnewsletter->Set(strtolower($area), $this->data[$area]);
		}

		$newnewsletter->ownerid = $user->userid;
		$result = $newnewsletter->Create();

		if (!$result) {
			$this->SendResponse(self::HTTP_INTERNAL_SERVER_ERROR, GetLang('UnableToCreateNewsletter'));
		}

		$this->SendResponse(self::HTTP_OK, "");
	}
}