<?php
/**
 * Created by PhpStorm.
 * User: halh
 * @author halh
 * @description Hàm này viết các function lớp cơ bản cho các class API chức năng
 * Date: 3/24/14
 * Time: 11:15 AM
 */
//Yeu cau tat ca cac api chay qua ham http auth
require_once dirname(__FILE__) . "/base/HttpAuthComponent.class.php";

class baseAPI extends HttpAuthComponent
{

	// Thông tin user yêu cầu truy cập API
	protected $userRecord = 0;

	//xác định kiểu dữ liệu sẽ trả về
	protected $type_response;

	//Tham số nhận từ client API
	protected $data = array();

	// Load các đối tượng cần ứng với api cần gửi
	protected $handlerObject = null;

	//Đối tượng cần gọi
	protected $handlerMethod = null;

	protected $required;

	protected $LogFile;

	protected $logid;

	protected $debug = false;

	protected $default = array();

	protected $logdb = false;

	protected $cache = false;

	var $currentCacheFile = "";

	protected $time_cache_file = "60";

	protected $auth_custom = array();

	protected $path_cache = "wp-content/temp/api";

	function  __construct($action = null, $auth = false)
	{
		if ($this->debug) {
			$this->LogFile = __CLASS__;
			$this->logid = time();
		}

		//Check auth
		if ($auth) {
			$this->userRecord = $this->authorize();

			// User not found
			if (empty($this->userRecord) || !isset($this->userRecord['userid'])) {

				$this->SendResponse(self::HTTP_FORBIDDEN, 'Lỗi: Dữ liệu kiểm tra của người dùng không hợp lệ');
			}
		}
		include_once dirname(__FILE__).'/base/authentication.php';

		$this->auth_custom = isset($custom)?$custom:array();

		/**
		 * @todo  xác định kiểu sẽ trả về dựa vào cấu hình của quản trị trên user record
		 */
		$this->_print_header();

		$this->baseAPI($action, $auth);
	}

	function _print_header($type = 'json')
	{
		$this->type_response = $type;

		switch ($this->type_response) {
			case 'json':
				header('Content-type: text/json');
				break;
			default:
				//All data response type json
				header('Content-type: text/json');
				break;
		}
	}

	function _flush_cache_output($data, $return = false)
	{
		if(!$this->cache) return;

		$filename = md5(@serialize($data));

		//Cache file path
		$this->currentCacheFile = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . $this->path_cache. DIRECTORY_SEPARATOR . $filename;

		if (file_exists($this->currentCacheFile)) {
			$fh = fopen($this->currentCacheFile, 'r');
			if(!$fh) {
				$this->logs('Khong thể open cache file '.$this->currentCacheFile);
			}

			$cacheTime = trim(fgets($fh));

			// if data was cached recently, return cached data
			if ($fh && $cacheTime > strtotime('-'.$this->time_cache_file .'second')) {
				if($return)
				{
					return fread($fh, filesize($this->currentCacheFile));
				}

				echo fread($fh, filesize($this->currentCacheFile));
				exit;
			}

			// else delete cache file
			fclose($fh);
			unlink($this->currentCacheFile);
		}

		return;
	}

	/**
	 * @param string $filename
	 * @param bool $return
	 * @return string
	 *
	 * Trả về kết quả File Cache của bảng.
	 */
	function _flush_cache_table_output($filename = "", $return = false)
	{

		//Cache file path
		$currentCacheFile = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . $this->path_cache. DIRECTORY_SEPARATOR . $filename;

		if (file_exists($currentCacheFile)) {
			$fh = fopen($currentCacheFile, 'r');
			if(!$fh) {
				$this->logs('Khong thể open cache file '.$currentCacheFile);
			}

			$cacheTime = trim(fgets($fh));

			// if data was cached recently, return cached data
			if ($fh && $cacheTime > strtotime('-'.$this->time_cache_file .'second')) {
				if($return)
				{
					return fread($fh, filesize($currentCacheFile));
				}

				echo fread($fh, filesize($currentCacheFile));
				exit;
			}

			// else delete cache file
			fclose($fh);
			unlink($currentCacheFile);
		}

		return;
	}

	function file_cache($filename = '') {
		if(!$this->cache) return;

		$this->time_cache_file = 3600*24;

		if(!$filename)
			$filename = __FUNCTION__.rand(1,100);

		$data_cache = $this->_flush_cache_table_output($filename, true);

		if($data_cache) return $data_cache;

		return;
	}

	/**
	 * @param $data
	 * @return mixed|string|void
	 *
	 * Cache dữ liệu trả về
	 */
	function _cache_output($data)
	{
		$json = json_encode($data); //encode du lieu neu khong ton tai file

		if(!$this->cache) return $json;

		if ($this->currentCacheFile) {

			$fh = fopen($this->currentCacheFile, 'w');
			if(!$fh) {
				$this->logs('Khong thể write cache file '.$this->currentCacheFile);
			}
			fwrite($fh, time() . "\n"); //luu thoi gian o dau file
			fwrite($fh, $json); //luu lai ra file
			fclose($fh);
		}

		return $json;
	}

	/**
	 * @param $data
	 * @param $filename
	 * @return void
	 * Cache dữ liệu bảng tạm, những bảng ít thay đổi nhưng được sử dụng nhiêu cải thiện hiệu suất.
	 */
	function _cache_temp_table($data, $filename) {

		if(!$this->cache) return;

		$currentCacheFile = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . $this->path_cache. DIRECTORY_SEPARATOR . $filename;
		if ($currentCacheFile) {

			$fh = fopen($currentCacheFile, 'w');
			if(!$fh) {
				$this->logs('Khong thể write cache file '.$currentCacheFile);
			}
			fwrite($fh, time() . "\n"); //luu thoi gian o dau file
			fwrite($fh, @serialize($data)); //luu lai ra file
			fclose($fh);
		}
	}

	function baseAPI($action = null, $auth = true)
	{
		//Require_base_for_wordpress
		$data = array_merge($_GET, $_POST);

		/**
		 * Kiểm tra cache file
		 */
		$this->_flush_cache_output($data);

		// Require base sendstudio functionality. This connects to the database, sets up our base paths and so on.
//		require_once dirname(dirname(__FILE__)) . '/admin/index.php';

		switch ($this->type_response) {
			case 'json':
				if (!(extension_loaded('json') && function_exists('json_encode') && function_exists('json_decode'))) {
					$this->SendResponse(self::HTTP_FORBIDDEN, 'Cấu hình máy chủ hiện không hỗ trợ trả về định dạng json');
				}
				break;
			default:
				$this->SendResponse(self::HTTP_FORBIDDEN, 'Cấu hình máy chủ hiện không hỗ trợ trả về định dạng mặc định');
				break;
		}

		if (!is_array($data)) {
			$this->SendResponse(self::HTTP_BAD_REQUEST, 'Lỗi: Dữ liệu truyền lên không đúng định dạng.');
		}

		if (isset($action)) {
			$data['action'] = $action;
		}

		/*
		 * Kiểm tra trạng thái của user với các api tương ứng.
		 */
		if ($auth) {
			$statusAPI = 'api_' . $data['action'] . '_status';

			//Nếu dữ liệu của user có record "api_$apiname_status"
			if (isset($this->userRecord[$statusAPI]) && !$this->userRecord[$statusAPI]) {

				//Nếu tồn tại message của api
				if (isset($this->userRecord["api_" . $data['action'] . "_message"]) && $this->userRecord["api_" . $data['action'] . "_message"]) {
					$this->SendResponse(self::HTTP_FORBIDDEN, 'Lỗi: ' . $this->userRecord["api_" . $data['action'] . "_message"]);
				} else {
					$this->SendResponse(self::HTTP_FORBIDDEN, 'Lỗi: Tài khoản của bạn bị chặn truy cập API này');
				}
			}
		}

		unset($tempEach);
		unset($paramRequired);

		// đảm boả type và action là alphanumeric
		$data['action'] = preg_replace('/[^\w]/', '_', $data['action']);

//		$this->api_test($data);

		$handlerMethod = strtolower((string)$data['action']);

		unset($tempClass);
		unset($tempFile);

		$this->handlerMethod = $handlerMethod;

		$this->data = $data;
	}

	function checkIP()
	{
		if (!in_array($_SERVER['REMOTE_ADDR'], $this->auth_custom['admin_allow_ip'] )) {
			$this->SendResponse(self::HTTP_NOT_ACCEPTABLE, "Dịch vụ của bạn không được phép truy cập vào địa chỉ này");
		}

		return;
	}

	function Process()
	{
		$subaction = strtolower($_GET['subaction']);

		if (!$subaction) $subaction = strtolower($_GET['type']);

		//Kiểm tra dữ liệu nhập vào
		$this->_validateParamRequired($subaction);

		if (is_callable(array($this->handlerMethod, $subaction))) {

			call_user_func(array($this->handlerMethod, $subaction));
		}

		$this->SendResponse(self::HTTP_FORBIDDEN, "Không tồn tại hành động yêu cầu");
	}

	function api_test($data)
	{
		// authentication::xmlapitest receive special treatment
		if ($data['type'] == 'authentication' && $data['action'] == 'apitest_false') {
			$this->SendResponse(self::HTTP_FORBIDDEN, array(
				'acc' => array(),
				'error_message' => "Tài khoản của bạn chưa được kích hoạt trên hệ thống"
			));
		}

		if ($data['type'] == 'authentication' && $data['action'] == 'apitest_ok') {
			$this->SendResponse(self::HTTP_OK, array(
				'acc' => array(
					'userid' => $this->userRecord['userid'],
					'username' => $this->userRecord['username'],
				),
				'error_message' => "Tài khoản của bạn chưa được kích hoạt trên hệ thống"
			));
		}
	}

	function _validateParamRequired($func = "", $data = array(), $url_return = "")
	{
		$paramRequired = array();

		$not_check = array('type', 'subaction', 'action');

		if (empty($data)) {
			$data = $this->data;
		}

		if ($func) {
			if(isset($this->required[$func]))
				$paramRequired = $this->required[$func];

			//Set giá trị mặc định cho giá trị data
			if (isset($this->default[$func]))
				$data = array_merge($this->default[$func], $data);

			foreach ($not_check as $notcheck) {
				if (isset($data[$notcheck])) {
					unset($data[$notcheck]);
					unset($paramRequired[$notcheck]);
				}
			}
		}

		if(isset($this->required[$func])) {
			foreach ($paramRequired as $tempEach) {
				if (!isset($data[$tempEach])) {
					$this->SendResponse(self::HTTP_BAD_REQUEST, "Lỗi: Định dạng trường dữ liệu gửi lên không phù hợp với yêu cầu: {$tempEach}", $url_return);
				}

				if (is_array($tempEach) && !empty($tempEach)) {
					foreach ($tempEach as $each) {
						if (!isset($data[$each])) {
							$this->SendResponse(self::HTTP_BAD_REQUEST, "Lỗi: Định dạng trường dữ liệu gửi lên không phù hợp với yêu cầu:data => {$each}", $url_return);
						}
					}
				}
			}
		}

		$this->data = $data;
	}

	/**
	 * CreateOutput
	 * This is a check value output
	 * @param Mixed $output The output to display can be a string, a single-element array or multi-dimensional array.
	 *
	 * @return Void Returns a formatted array document.
	 */
	function CreateOutput($status = null, $output = '', $url_return = '')
	{
		$arr_output = $output;

		//Nếu đã khai báo trong biến message => trả về header
		if (array_key_exists($status, self::$messages) && !$url_return) {

			header($this->httpHeaderFor($status));
		}

		return array("data" => $arr_output);
	}

	function logs($msg, $logfile = null)
	{
		if (!$this->debug) {
			return;
		}

		if ($logfile) {
			$this->LogFile = $logfile;
		}

		// grab the line number of where we got called from, plus the file and function it was in
		$trace = debug_backtrace();
		$file = $trace[0]['file'];
		$function = $trace[1]['function']; // the function that called us, not ourself
		$line = $trace[0]['line'];
		$time = time();

		if (!is_null($msg)) {
			error_log($this->logid . ' Line ' . $line . ';function ' . $function . '; time ' . date('Y/m/d h:i:s', time()) . '; ' . $msg . "\n", 3, dirname(dirname(__FILE__)) . "/wp-content/temp/log/" . $this->LogFile . ".log");
		}

		if ($this->logdb) {
			return;
//			$db = IEM::getDatabase();
//			if(!is_object($db)) {
//				return false;
//			}
//
//			$request = " GET:" . json_encode($_GET) . " POST:" . json_encode($_POST);
//
//			if(is_string($msg))
//				$response = $msg;
//			else
//				$response = print_r($msg,true);
//
//			//Get password from merchant site
//			$query = "INSERT INTO log_system_api (userid, ip_address, request, response, logid, time) VALUES (
//				{$this->userRecord['userid']},
//				'{$_SERVER['REMOTE_ADDR']}',
//				'{$request}',
//				'{$response}',
//				{$this->logid},
//				{$time})";
//
//			$result = $db->Query($query);
//			if ($result == false) {
//				list($error, $level) = $db->GetError();
//				error_log($this->logid. ' error:'.$error.' level: '. $level."\n", 3,dirname(dirname(__FILE__)) . "/admin/temp/api/trigger_db.log");
//				return;
//			}
		}
	}


// ----- Defines common functions used
	/**
	 * Send response back
	 * It will print out a response and stop the script execution
	 *
	 * @param boolean $status Indicates whether or not to respond with a "SUCCESS" or "FAILED" response
	 * @param array $data Data to be sent back,
	 */
	function SendResponse($status, $data, $url_return = '', $callback = NULL)
	{
		if (ob_get_level()) {
			ob_end_clean();
		}

		//Turn on buffer
		ob_start();

		//Print header
		$this->_print_header();

		$data = $this->CreateOutput($status, $data, $url_return);

		if ($this->debug) {
			//Log dữ liệu gửi trả về
			$this->logs(json_encode($data, true),null);
		}

		if ($url_return) {
			header("Location:" . $url_return . "?code=" . $status . "&" . http_build_query($data));
			exit;
		}

		//Return content
		switch ($this->type_response) {
			case 'json':
				echo $this->_cache_output($data);
				break;
			default:
				echo $this->_cache_output($data);
				break;
		}

		$size = ob_get_length();
		header("Content-Length: $size");

		//Send out data and turn off output buffer
		ob_end_flush();

		flush();

		//Gọi callback trước khi exit xử lý.
		if (isset($callback)) $this->{$callback}($data['message']);

		exit;
	}

	function GetApi($api = false, $instantiate = true)
	{
		$api = strtolower($api);
		if ($api == 'email') {
			$api = 'ss_email';
		}

		$api_file = dirname(__FILE__) . '/' . $api . '.php';
		if (!is_file($api_file)) {
			return false;
		}

		$api .= '_API';

		if (!class_exists($api, false)) {
			require_once($api_file);
		}

		if ($instantiate) {
			$myapi = New $api();
			return $myapi;
		} else {
			return true;
		}
	}


	function send_email($to = array(), $content = '') {

		if($this->debug)
			$this->logs('bat dau gui email '.__FUNCTION__);

		$emailapi = $this->GetApi('email');

		$emailapi->SetSmtp(SENDSTUDIO_SMTP_SERVER, SENDSTUDIO_SMTP_USERNAME, @base64_decode(SENDSTUDIO_SMTP_PASSWORD), SENDSTUDIO_SMTP_PORT);

		$emailapi->ClearRecipients();
		$emailapi->ForgetEmail();
		$emailapi->Set('forcechecks', false);

		$emailapi->Set('Subject', "Thông báo có người dùng đăng ký thông qua API Payment");
		$emailapi->Set('FromName', "Quản trị EM BK");
		$emailapi->Set('FromAddress', "luuhaiha88@gmail.com");
		$emailapi->Set('ReplyTo', "luuhaiha88@gmail.com");

		$emailapi->AddBody('text', $content);

		foreach ($to as $email) {
			$emailapi->AddRecipient($email, false, 't');
		}

		$emailapi->Set('TrackOpens', false);
		$emailapi->Set('TrackLinks', false);

		$emailapi->Set('CharSet', SENDSTUDIO_CHARSET);
		$mail_results = $emailapi->Send(true);

		if($this->debug)
			$this->logs('Ket qua send la: '.print_r($mail_results,true));

	}

	function conn_db($db_name = NULL, $db_host= NULL, $db_user= NULL,$db_password= NULL) {
		global $wpdb;

		require_once dirname(__FILE__).'/base/constant.php';
		require_once dirname(__FILE__).'/base/MysqliDb.php';

		if ( isset( $wpdb ) )
			return;

		if(!isset($db_host)) {
			$db_host = DB_HOST;
		}

		if(!isset($db_user)) {
			$db_user = DB_USER;
		}

		if(!isset($db_password)) {
			$db_password = DB_PASSWORD;
		}

		if(!isset($db_name)) {
			$db_name = DB_NAME;
		}

		$wpdb = new Mysqlidb( $db_host ,$db_user, $db_password, $db_name);

		if(!$wpdb) {
			$this->SendResponse(self::HTTP_FORBIDDEN,'Không thể kêt nối đến dữ liệu');
		}
	}
	// [Informational 1xx]


	const HTTP_CONTINUE = 100;


	const HTTP_SWITCHING_PROTOCOLS = 101;


	// [Successful 2xx]


	const HTTP_OK = 200;


	const HTTP_CREATED = 201;


	const HTTP_ACCEPTED = 202;


	const HTTP_NONAUTHORITATIVE_INFORMATION = 203;


	const HTTP_NO_CONTENT = 204;


	const HTTP_RESET_CONTENT = 205;


	const HTTP_PARTIAL_CONTENT = 206;


	// [Redirection 3xx]


	const HTTP_MULTIPLE_CHOICES = 300;


	const HTTP_MOVED_PERMANENTLY = 301;


	const HTTP_FOUND = 302;


	const HTTP_SEE_OTHER = 303;


	const HTTP_NOT_MODIFIED = 304;


	const HTTP_USE_PROXY = 305;


	const HTTP_UNUSED = 306;


	const HTTP_TEMPORARY_REDIRECT = 307;


	// [Client Error 4xx]


	const errorCodesBeginAt = 400;


	const HTTP_BAD_REQUEST = 400;


	const HTTP_UNAUTHORIZED = 401;


	const HTTP_PAYMENT_REQUIRED = 402;


	const HTTP_FORBIDDEN = 403;


	const HTTP_NOT_FOUND = 404;


	const HTTP_METHOD_NOT_ALLOWED = 405;


	const HTTP_NOT_ACCEPTABLE = 406;


	const HTTP_PROXY_AUTHENTICATION_REQUIRED = 407;


	const HTTP_REQUEST_TIMEOUT = 408;


	const HTTP_CONFLICT = 409;


	const HTTP_GONE = 410;


	const HTTP_LENGTH_REQUIRED = 411;


	const HTTP_PRECONDITION_FAILED = 412;


	const HTTP_REQUEST_ENTITY_TOO_LARGE = 413;


	const HTTP_REQUEST_URI_TOO_LONG = 414;


	const HTTP_UNSUPPORTED_MEDIA_TYPE = 415;


	const HTTP_REQUESTED_RANGE_NOT_SATISFIABLE = 416;


	const HTTP_EXPECTATION_FAILED = 417;


	// [Server Error 5xx]


	const HTTP_INTERNAL_SERVER_ERROR = 500;


	const HTTP_NOT_IMPLEMENTED = 501;


	const HTTP_BAD_GATEWAY = 502;


	const HTTP_SERVICE_UNAVAILABLE = 503;


	const HTTP_GATEWAY_TIMEOUT = 504;


	const HTTP_VERSION_NOT_SUPPORTED = 505;


	private static $messages = array(


		// [Informational 1xx]


		100 => '100 Continue',


		101 => '101 Switching Protocols',


		// [Successful 2xx]


		200 => '200 OK',


		201 => '201 Created',


		202 => '202 Accepted',


		203 => '203 Non-Authoritative Information',


		204 => '204 No Content',


		205 => '205 Reset Content',


		206 => '206 Partial Content',


		// [Redirection 3xx]


		300 => '300 Multiple Choices',


		301 => '301 Moved Permanently',


		302 => '302 Found',


		303 => '303 See Other',


		304 => '304 Not Modified',


		305 => '305 Use Proxy',


		306 => '306 (Unused)',


		307 => '307 Temporary Redirect',


		// [Client Error 4xx]


		400 => '400 Bad Request',


		401 => '401 Unauthorized',


		402 => '402 Payment Required',


		403 => '403 Forbidden',


		404 => '404 Not Found',


		405 => '405 Method Not Allowed',


		406 => '406 Not Acceptable',


		407 => '407 Proxy Authentication Required',


		408 => '408 Request Timeout',


		409 => '409 Conflict',


		410 => '410 Gone',


		411 => '411 Length Required',


		412 => '412 Precondition Failed',


		413 => '413 Request Entity Too Large',


		414 => '414 Request-URI Too Long',


		415 => '415 Unsupported Media Type',


		416 => '416 Requested Range Not Satisfiable',


		417 => '417 Expectation Failed',


		// [Server Error 5xx]


		500 => '500 Internal Server Error',


		501 => '501 Not Implemented',


		502 => '502 Bad Gateway',


		503 => '503 Service Unavailable',


		504 => '504 Gateway Timeout',


		505 => '505 HTTP Version Not Supported'


	);


	public static function httpHeaderFor($code)
	{


		return 'HTTP/1.1 ' . self::$messages[$code];


	}


	public static function getMessageForCode($code)
	{


		return self::$messages[$code];


	}

	public static function isError($code)
	{


		return is_numeric($code) && $code >= self::HTTP_BAD_REQUEST;


	}

	public static function canHaveBody($code)
	{


		return
			// True if not in 100s
			($code < self::HTTP_CONTINUE || $code >= self::HTTP_OK)

			&& // and not 204 NO CONTENT

			$code != self::HTTP_NO_CONTENT

			&& // and not 304 NOT MODIFIED

			$code != self::HTTP_NOT_MODIFIED;
	}

	/**
	 * Set
	 * This sets the class var to the value passed in.
	 * If a variable name isn't provided, this will return false.
	 * If the variable doesn't exist in the object, this will return false
	 * It checks to make sure a class variable exists before it assigns the value.
	 *
	 * <b>Example</b>
	 * <code>
	 * $obj->Set('non-existent-var', 'xyz');
	 * </code>
	 * will return false.
	 *
	 * <code>
	 * $obj->Set('existent-var', 'xyz');
	 * </code>
	 * will return true.
	 *
	 * @param String $varname Name of the class var to set.
	 * @param Mixed $value The value to set the class var (this can be an array, string, int, float, object).
	 *
	 * @return Boolean True if it works, false if the var isn't present or not provided.
	 */
	function Set($varname = '', $value = '')
	{

		if ($varname == '') {
			return false;
		}

		// make sure we're setting a valid variable.
		$my_vars = array_keys(get_object_vars($this));
		if (!in_array($varname, $my_vars)) {
			return false;
		}

		$this->$varname = $value;

		return true;
	}

	/**
	 * Get
	 * Returns the class variable based on the variable passed in.
	 * If a variable name isn't provided, or if the object variable doesn't exist, this will return false.
	 *
	 * @param String $varname Name of the class variable to return.
	 *
	 * @return False|Mixed Returns false if the class variable doesn't exist, otherwise it will return the value in the variable.
	 */
	function Get($varname = '')
	{
		if ($varname == '') {
			return false;
		}

		if (!isset($this->$varname)) {
			return false;
		}

		return $this->$varname;
	}

	function DenyAccess($msg = '')
	{

		if (!$msg) {
			$msg = "Bạn không có quyền truy cập tính năng này";
		}

		$this->SendResponse(self::HTTP_NOT_ACCEPTABLE, $msg);
	}

}
