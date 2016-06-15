<?php
/**
* Class này là class base dùng cho các service RESTFUL kế thừa.
* Giúp giải quyết các vấn đề về HTTP AUTHENTICATION.
* @author halh <luuhaiha88@gmail.com>
* 
* @property string $username
* @property string $realm
*/
class HttpAuthComponent
{

	function  __construct() {

	}
	
	/**
	* Có tự động trả về và kết thúc quá trình chạy khi phát hiện người dùng chưa đc xác thực hay không?
	* 
	* @var boolean
	*/
	public $autoResponse401OnUnauthorized = true;
	
	protected $_show404 = false;
	
	/**
	 * 
	 * Set các tham số Digest, bao gồm username.
	 * @var unknown_type
	 */
	protected $_username;

	protected $_password;
	/**
	 * 
	 * Ket qua tra ve khi authenticate faile
	 * @var unknown_type
	 */
	protected $_response = false;
	
	function getUsername()
	{
		
		return $this->_username;
	}
	
	private $_realm;
	
	function getRealm()
	{
		if (!isset($this->_realm)) $this->_realm = 'API SERVICE BAO KIM EMAIL MARKETING';
		
		return $this->_realm;
	}
	
	function setRealm($v)
	{
		$this->_realm = $v;
	}
	
	function responseUnauthorized()
	{
		$realm = $this->getRealm();
		$nonce = rand(100, 999).time();

		if (isset($_SERVER['PHP_AUTH_DIGEST'])) {
			
			// return $this->_response;
		}

		header('HTTP/1.1 401 Unauthorized');
		header('WWW-Authenticate: Digest '.
			'realm="'.$realm.'"'.
			',qop="auth",nonce="'.$nonce.'",opaque="'.sprintf('%x', crc32($realm)).'"');

		return $this->_response;
	}

	/**
	 * @return bool
	 * @author halh
	 * Authentication from class name, file nay dat cung cap voi thu muc includes
	 */
	function get_db() {

		$config_include = dirname(dirname(dirname(__FILE__))) . "/wp-config.php";
		if(file_exists($config_include)) {
			include_once $config_include;
		 } else {
			return false;
		}

		/**
		 * Tao connect DB.
		 */
		$conn = @mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);

		@mysql_select_db(DB_NAME, $conn);

		@mysql_query("SET NAMES 'utf8'", $conn);

		return $conn;
	}

	function _authenticate_name($username = '') {
		if(!$username) {
			return false;
		}

		//tam fix true
		return;
		$conn = $this->get_db();
		if(!is_object($db)) {
			return false;
		}

		//Get password from merchant site
		$query = "";

		$result = @mysql_query($query, $conn);
		if ($result == false) {
			list($error, $level) = $db->GetError();
			trigger_error($error, $level);
			return false;
		}

		$details = $db->Fetch($result);
		$db->FreeResult($result);

		if (empty($details)) {
			return 0;
		}

		return $details;
	}

	protected function parseDigestHeader($txt)
	{
	    // protect against missing data
	    $parts = array('realm','nonce','nc', 'cnonce', 'qop','username','uri','response','opaque');
	    $data = array();
	    $keys = implode('|', $parts);

	    preg_match_all('@('.$keys.')=(?:([\'"])([^\2]+?)\2|([^\s,]+))@', $txt, $matches, PREG_SET_ORDER);

	    foreach ($matches as $m) {
	        $data[$m[1]] = $m[3] ? $m[3] : $m[4];
	    }

	    if (count($parts) != count($data)) return false;
	    
	    if (sprintf('%x', crc32($data['realm'])) != $data['opaque']) return false;

		$userRecord = $this->_authenticate_name((string)$data['username']);

		if (empty($userRecord) || !isset($userRecord['userid']) ) return false;

		if(isset($userRecord['xmltoken'])) $userRecord['xmltoken'] = preg_replace("/^".pack('H*','EFBBBF')."/", '', $userRecord['xmltoken']);

	    $h1 = md5($data['username'] . ':' . $data['realm'] . ':' . $userRecord['xmltoken']);
		$h2 = md5($_SERVER['REQUEST_METHOD'].':'.$data['uri']);
		$validResponse = md5($h1.':'.$data['nonce'].':'.$data['nc'].':'.$data['cnonce'].':'.$data['qop'].':'.$h2);

		if ($validResponse != $data['response']) {

			return false;	
		}

	    return $userRecord;
	}
	
	function onUnauthorized()
	{
		if ($this->autoResponse401OnUnauthorized) {
			
			return $this->responseUnauthorized();
		}
		
		return false;
	}
	
	function authorize()
	{
		$realm = $this->getRealm();

		# nếu chưa có thông tin xác thực gửi lên
		if (!isset($_SERVER['PHP_AUTH_DIGEST']) || empty($_SERVER['PHP_AUTH_DIGEST'])) {

			$this->onUnauthorized();

			exit;
		}
		$userRecord = false;
		if (!($userRecord = $this->parseDigestHeader($_SERVER['PHP_AUTH_DIGEST']))) {
				
			$this->onUnauthorized();

			exit;
		}

		return $userRecord;
	}
}