<?php
/**
 * Created by PhpStorm.
 * User: macbookpro
 * Date: 4/7/14
 * Time: 11:17 AM
 */

Require_once "baseAPI.php";

class payment extends baseAPI
{

	const PAY_PER_EMAIL = 0;
	const BUSINESS_PAYMENT = "vatgia@baokim.vn";

	/**
	 * @var array
	 * Quy định cho các gói dịch vụ trên trang chủ
	 */
	protected $packages = array(
		100 => array(
			'gia_email'=> 179000,
			'tang_sms' => 0,
			'packageid' => 2,
			'packagename' => 'Gói dùng thử'
		),
		5000 => array(
			'gia_email'=> 179000,
			'tang_sms' => 0,
			'packageid' => 2,
			'packagename' => 'Gói cơ bản'
		),
		10000 => array(
			'gia_email'=> 269000,
			'tang_sms' => 500,
			'packageid' => 3,
			'packagename' => 'Gói nâng cao'
		),
		20000 => array(
			'gia_email'=> 449000,
			'tang_sms' => 1000,
			'packageid' => 4,
			'packagename' => 'Gói phổ biến'
		),
		50000 => array(
			'gia_email'=> 899000,
			'tang_sms' => 2000,
			'packageid' => 5,
			'packagename' => 'Gói chuyên nghiệp'
		),
		100000 => array(
			'gia_email'=> 1499000,
			'tang_sms' => 5000,
			'packageid' => 6,
			'packagename' => 'Gói tiên phong'
		)
	);

	protected $required = array(
		"order" => array(
			'total_email',
			'url_success',
			'url_detail',
			'url_cancel',
		),
		"transaction" => array(
			'order_id',
			'transaction_id',
			'created_on',
			'payment_type',
			'transaction_status',
			'total_amount',
			'net_amount',
			'fee_amount',
			'merchant_id',
			'customer_name',
			'customer_email',
			'customer_phone',
			'checksum'
		),
		"bpn" => array(
			'order_id',
			'transaction_id',
			'created_on',
			'payment_type',
			'transaction_status',
			'total_amount',
			'net_amount',
			'fee_amount',
			'merchant_id',
			'customer_name',
			'customer_email',
			'customer_phone',
			'verify_sign'
		)
	);


	protected $default = array(
		"order" => array(
			"business" => "",
			"shipping_fee" => 0,
			"tax_fee" => 0,
			"order_description" => "",
			"url_cancel" => "http://email.vatgia.com/home/transaction",
			"url_detail" => "http://email.vatgia.com/home/transaction",
			"pay_per_email" => self::PAY_PER_EMAIL,
		)
	);

	function __construct()
	{
		$this->debug = true;
		$this->logdb = true;

		parent::__construct(__CLASS__, true);

		//Load lag file
		IEM::langLoad("users");
	}

	function Process()
	{

		$subaction = IEM::requestGetGET('subaction', '', "strtolower");

		if (!$subaction) $subaction = IEM::requestGetGET('type', '', "strtolower");

		$url_return = IEM::requestGetGET('_return', SENDSTUDIO_APPLICATION_URL . "/home/transaction", 'urldecode');

		//Kiểm tra dữ liệu nhập vào
		$this->_validateParamRequired($subaction, array(), $url_return);

		if (is_callable(array($this->handlerMethod, $subaction))) {

			call_user_func(array($this->handlerMethod, $subaction));
		}

		$this->SendResponse(self::HTTP_FORBIDDEN, "Không tồn tại hành động yêu cầu");
	}

	/**
	 * Xử lý thông tin order.
	 *
	 * Gửi và nhận thông tin trả về.
	 * @see BaoKimPayment class
	 * @table order, transactions, user
	 *
	 * Bao gồm các chức năng sau:
	 * - Nhận thông tin dơn hàng từ các merchant
	 * - Lưu đơn hàng yêu cầu, Gen ra địa chỉ gọi sang cổng thanh toán
	 * - Lưu log truy cập
	 * - Trả về địa chỉ cho người dùng redirect
	 */
	function order()
	{

		$this->checkIP();

		//Tổng hợp thông tin cần thiết
		$baokimPayment = new BaoKimPayment();

		//Kiểm tra chuỗi checksum
//		if(!$baokimPayment->verifyResponseUrl($this->data)) {
//			$this->SendResponse(self::HTTP_FORBIDDEN,"Dữ liệu truyền lên không thể xác thực");
//		}

		$orderapi = $this->GetApi('order');

		$re_fix = array(
			'order_id', 'pay_per_email', 'total_amount',
			'url_success', 'url_detail', 'url_cancel',
			'shipping_fee', 'tax_fee', 'business',
			'packagename', 'packageid'
		);

		foreach ($re_fix as $value) {

			if ($value == 'url_success') {
				$orderapi->url_success = SENDSTUDIO_APPLICATION_URL . "/api/payment.php?type=transaction&_return=" . $this->data[$value];
				continue;
			}

			if ($value == 'pay_per_email') {
				$orderapi->pay_per_email = self::PAY_PER_EMAIL;
				continue;
			}

			if ($value == 'business') {
				$orderapi->business = self::BUSINESS_PAYMENT;
				continue;
			}

			if ($value == 'total_amount') {
				$orderapi->total_amount = $this->packages[$this->data['total_email']]['gia_email'];
				continue;
			}

			if ($value == 'packagename') {
				$orderapi->packagename = $this->packages[$this->data['total_email']]['packagename'];
				continue;
			}

			if ($value == 'packageid') {
				$orderapi->packageid = $this->packages[$this->data['total_email']]['packageid'];
				continue;
			}

			if(!isset($this->data[$value])) {
				continue;
			}

			$orderapi->Set($value, $this->data[$value]);
		}

		$result = $orderapi->Create();

		$redirectUrl = $baokimPayment->createRequestUrl(
			$orderapi->order_id,
			$orderapi->business,
			$orderapi->total_amount,
			$orderapi->shipping_fee,
			$orderapi->tax_fee,
			$orderapi->order_description,
			$orderapi->url_success,
			$orderapi->url_cancel,
			$orderapi->url_detail
		);

		if ($result) {
			$this->SendResponse(self::HTTP_OK, $redirectUrl);
		}

		$this->SendResponse(self::HTTP_FORBIDDEN, "Không tạo được đơn hàng ứng với yêu cầu");
	}

	const TRANSACTION_SUCCCESS_MSG = "Giao dịch của bạn đã được thanh toán thành công";
	const TRANSACTION_NOT_VERIFY_OTP = "Giao dịch chưa được xác minh OTP, bạn vui lòng thử lại";
	const TRANSACTION_VERIFIED_OTP = "Giao dịch đã xác minh OTP, nhưng chưa hoàn thành.";
	const TRANSACTION_DELETED = "Giao dịch đã bị huỷ";
	const TRANSACTION_NOT_RECEIVED = "Giao dịch bị từ chối nhận tiền";
	const TRANSACTION_TIME_EXPIRE = "Giao dịch hết hạn";
	const TRANSACTION_FAILED = "Giao dịch đã thất bại";
	const TRANSACTION_VIOLATED = "Giao dịch đã đóng băng";


	/**
	 * Xử lý thông tin giao dịch BK gửi trả về.
	 *
	 * Bao gồm các chức năng
	 * - Lưu log khi gọi tới
	 * - Tạo giao dịch
	 * - Cập nhật trạng thái đơn hàng
	 */
	function transaction()
	{
		//Cập nhật lại cookie của người dùng.
		IEM::requestRemoveCookie('IEM_CookieLogin');

		//Tổng hợp thông tin cần thiết
		$baokimPayment = new BaoKimPayment();

		$url_return = IEM::requestGetGET('_return', SENDSTUDIO_APPLICATION_URL . "/home/transaction");

		unset($this->data['_return']);

		//Kiểm tra chuỗi checksum
		if (!$baokimPayment->verifyResponseUrl($this->data)) {
			$this->SendResponse(self::HTTP_FORBIDDEN, "Không thể xác thực giao dịch", $url_return);
		}

		$message = "";

		switch ($this->data['transaction_status']) {
			case '4':
				$message = self::TRANSACTION_SUCCCESS_MSG;
				break;
			case '13':
				$message = self::TRANSACTION_SUCCCESS_MSG;
				break;
			case '1':
				$message = self::TRANSACTION_NOT_VERIFY_OTP;
				break;
			case '2':
				$message = self::TRANSACTION_VERIFIED_OTP;
				break;
			case '5':
				$message = self::TRANSACTION_DELETED;
				break;
			case '6':
				$message = self::TRANSACTION_NOT_RECEIVED;
				break;
			case '7':
				$message = self::TRANSACTION_TIME_EXPIRE;
				break;
			case '8':
				$message = self::TRANSACTION_FAILED;
				break;
			case '12':
				$message = self::TRANSACTION_VIOLATED;
				break;

		}

		//Cập nhật đơn hàng thành công. redirect ngừoi dùng đến trang gốc.
		$this->SendResponse(self::HTTP_OK, $message, $url_return);
	}


	function vg_transaction() {
		//Kiểm tra chuỗi checksum
		$call_api_helper = new IEMCallApiHelper();
		if (!$call_api_helper::verifyChecksum($_POST)){
			$this->SendResponse(self::HTTP_FORBIDDEN, "Không thể xác thực thông tin giao dịch");
		}

		//Nếu tồn tại thông tin user => Lưu lại theo thông tin giao dịch, ko thì false
		if(!isset($_POST['userinfo'])){
			$this->SendResponse(self::HTTP_FORBIDDEN, "Không lấy được thông tin về người dùng");
		}

		//is string => decode json
		$_POST['userinfo'] = json_decode($_POST['userinfo'],true);

		/**
		 * Start set thông tin chi tiết
		 */
		if(isset($_POST['userinfo']['email'])){
			$email_address=$_POST['userinfo']['email'];
		}else{
			$this->SendResponse(self::HTTP_FORBIDDEN, "Không lấy được thông tin về người dùng (email)");
		}

		if(isset($_POST['total_email'])){
			$total_amount=$this->packages[$_POST['total_email']]['gia_email'];
		}else{
			$this->SendResponse(self::HTTP_FORBIDDEN, "Không lấy được thông tin về gói mail");
		}

		//Tạo giao dịch
		if($this->debug){
			$this->logs("Tạo giao dịch cho: " . $email_address. " Tìm thông tin user", __FUNCTION__);
		}

		$user_reg = $this->GetApi('user');
		$fields = array(
			'trialuser', 'username', 'fullname', 'emailaddress',
			'status', 'admintype', 'editownsettings',
			'listadmintype', 'segmentadmintype', 'usertimezone',
			'textfooter', 'htmlfooter', 'templateadmintype',
			'infotips', 'smtpserver',
			'smtpusername', 'smtpport', 'usewysiwyg',
			'enableactivitylog', 'xmlapi', 'xmltoken',
			'googlecalendarusername', 'googlecalendarpassword',
			'adminnotify_email', 'adminnotify_send_flag', 'adminnotify_send_threshold',
			'adminnotify_send_emailtext', 'adminnotify_import_flag', 'adminnotify_import_threshold',
			'adminnotify_import_emailtext',
			'transaction_id' => 'transaction_id',
			'credit_bonus' => 'credit_bonus',
		);

		if($this->debug){
			$this->logs("Tìm kiếm User_id ứng với customer_email: " . $email_address. " Tìm thông tin user", __FUNCTION__);
		}

		$userid = $user_reg->Find($email_address);

		//Nếu ko tồn tại, trước hết tạo
		if (!$userid){
			$values = $user_reg->GetValueRegisterDefault($email_address);
			if(empty($values)) {
				$this->SendResponse(self::HTTP_FORBIDDEN, "Dữ liệu Email gửi lên không đúng định dạng");
			}

			foreach($fields as $p => $area) {
				$val = (isset($values[$area]))? $values[$area]:'';
				$user_reg->Set($area, $val);
			}

			$user_reg->Set('groupid', SENDSTUDIO_ID_GROUP_TRIAL);

			// this has a different post value otherwise firefox tries to pre-fill it.
			$smtp_password = '';

			if(isset($values['smtp_p'])) {
				$smtp_password = $values['smtp_p'];
			}

			$user_reg->Set('smtppassword', $smtp_password);

			if($values['ss_p'] != '') {
				$user_reg->Set('password', $values['ss_p']);
			}

			$user_reg->Set('gettingstarted', 1);

			$result = $user_reg->Create();

			if($result == '-1') {
				$this->SendResponse(self::HTTP_FORBIDDEN, GetLang('UserNotCreated_License'));
			}else{
				if($result){
					$userid = $result;
				}else{
					$this->SendResponse(self::HTTP_FORBIDDEN, GetLang('UserNotCreated'));
				}
			}
		}

		//Đã tạo xong, gọi API qua vatgia tiến hành thanh toán dịch vụ.
		if ($this->debug) {
			$this->logs("Bắt đầu gọi sang Vatgia api với customer_email: " .$email_address. "", __FUNCTION__);
		}

		//CaoPV:Start <vancao.vn@gmail.com> Lưu giao dịch
		$insert_txn=array(
			'user_id'=>$userid,
			'amount'=>$total_amount,
			'type_id'=>2,//GD thanh toán mua gói email gửi
			'created_on'=>date('Y-m-d H:i:s',time()),
		);

		$vg_trans = $this->GetApi('vg_transactions');
		$log_trans = $this->GetApi('log_transactions');

		$txn_id=$vg_trans->insert($insert_txn);

		//Insert log Txn : Ghi log thông tin chi tiết của giao dịch
		$insert_log=array(
			'txn_id'=>$txn_id,
			'info'=>json_encode(array(
				'user_id'=>$userid,
				'package'=>$this->packages[$_POST['total_email']]
			)),
			'created_on'=>date('Y-m-d H:i:s',time())
		);

		$log_trans->insert($insert_log);

		//CaoPV:Gọi sang vatgia api, thanh toán cho đơn hàng tương ứng.
		$requestVg=new RequestSecurityVG();
		$responseVg=$requestVg->payment_vg($_POST['userinfo']['email'],$total_amount);

		$update_txn=array(
			'status_id'=>isset($responseVg['error'])&&$responseVg['error']==1?1:0,
			'completed_on'=>date('Y-m-d H:i:s',time()),
			'log_id'=>isset($responseVg['log_id'])?$responseVg['log_id']:0
		);

		$vg_trans->update($txn_id,$update_txn);
		//CaoPV:End

		if(!$responseVg){
			$this->SendResponse(self::HTTP_FORBIDDEN, 'Lỗi khi tiến hành thanh toán');
		}

		if(isset($responseVg['error']) && is_numeric($responseVg['error']) && $responseVg['error'] == 1) {
			$this->logs("Gọi thanh toán thành công customer_email: " . $_POST['userinfo']['email'], __FUNCTION__);
		}else{
			$this->SendResponse(self::HTTP_FORBIDDEN, 'Tài khoản chính trên Vatgia.com của bạn không đủ khả năng thanh toán gói dịch vụ này, chúng tôi sẽ đưa bạn đến trang nạp tiền');
		}

		$time = 0;

		//thanh toán xong => cập nhật thông tin
		if ($user_reg->Load($userid)){
			//Hoàn thành tạo tài khoản => cấu hình rule cho tài khoản đó ( có userid )
			$license = $user_reg->GetLicense($userid);

			$fieldslicense = array('packagename','packageid');

			foreach($fieldslicense as $value) {
				if(isset($this->packages[$_POST['total_email']][$value])){
					$user_reg->Set($value,$this->packages[$_POST['total_email']][$value]);
				}
			}
			$time = mktime(0, 0, 0, date("m")+1, date("d"), date("Y"));

			$expires = date('Y.m.d', $time);

			if ($this->debug) {
				$this->logs("Bắt đầu cậu nhật License cho: " . $userid . " với customer_email: " . $_POST['userinfo']['email'] . " Với time expires:".$expires, __FUNCTION__);
			}

			$updatedLicense = false;

			if($license){
				$updatedLicense = $user_reg->UpdateLicense($userid, $expires);
			}else{
				$user_reg->CreateLicense($userid, $expires);
			}

			foreach ($fields as $p => $area) {
				if ($area == "credit_bonus") {
					if($updatedLicense)
						$user_reg->credit_bonus += $_POST['total_email'];
					else
						$user_reg->credit_bonus = $_POST['total_email'];
				}

				if($area == "transaction_id") {
					$user_reg->transaction_id = $txn_id;
				}

				$val = (isset($user_reg->{$area}))? $user_reg->{$area}: '';

				$user_reg->Set($area, $val);
			}

			$user_reg->Set('groupid', SENDSTUDIO_ID_GROUP_VATGIA);

			if($this->debug) {
				$this->logs("Cập nhật user: " . $userid . " với customer_email: " .$email_address. " cập nhật thông tin user thành công" , __FUNCTION__);
			}

			$result = $user_reg->Save();

			if($result) {
				//@todo hành động khi cập nhật thành công vào tài khoản người dùng
				//Update trang thai hoat dong.
				$user_reg->UpdateStatus($userid);
			}else{
				$this->SendResponse(self::HTTP_FORBIDDEN, 'Thất bại trong việc cập nhật thông tin cho tài khoản của bạn, vui lòng liên hệ hỗ trợ.');
			}
		}else{
			$this->SendResponse(self::HTTP_FORBIDDEN, 'Tài khoản đã tồn tại, tuy nhiên chúng tôi không lấy được thông tin tài khoản trên hệ thống');
		}

		if($this->debug) {
			$this->logs("Bắt đầu hoàn thành giao dịch: " . $userid . " với customer_email: " . $email_address, __FUNCTION__);
		}

		if($this->debug) {
			$this->logs("Bắt đầy gửi Email với userid: " . $userid . " với customer_email: " . $email_address, __FUNCTION__);
		}

		//Tạo thành công tài khoản gửi Email notify cho quản trị
		$data['to'] = array('luuhaiha88@gmail.com','anhnm.fyu@gmail.com','vancao.vn@gmail.com');
		$data['content_email'] = "USER INFO: " . print_r($user_reg, true) . "ORDER INFO: NONE, Transaction API: " . print_r(array_merge($insert_log,$update_txn,array('id'=>$txn_id)),true);
		$data['credit'] = $user_reg->credit_bonus;
		$data['time'] = $time;
		$data['sotinvb'] = isset($this->packages[$_POST['total_email']]['tang_sms'])?$this->packages[$_POST['total_email']]['tang_sms']:0;
		$data['email'] = $_POST['userinfo']['email'];

		$this->SendResponse(self::HTTP_OK, $data, '', '_send_notify_email');
	}

	function _send_notify_email($data) {

		$requestVg = new RequestSecurityVG();

		//HALH gọi qua viper tặng message
		$requestVg->tang_viper_sms(array(
			'u' => 'sms_cong_service',
			'p' => '1@#sevicecong',
			'email' => $data['email'],
			'sotinvb' => $data['sotinvb']
		));

		if($this->debug)
			$this->logs('Goi call back voi data to '.print_r($data,true));

		$this->send_email($data['to'], $data['content_email']);
	}

	/**
	 * Xử lý thông tin BPN gửi từ BK
	 *
	 * @see http://developer.baokim.vn/thu-vien/6/tich-hop-gio-hang?section=bpn
	 * - Phân tích thông tin nhận
	 * - Gửi lại BK yêu cầu xác nhận
	 * - Cập nhật trạng thái giao dịch
	 * - Khởi tạo tài khoản trên hệ thống EM BK
	 * - Cập nhật thông tin gói dịch vụ cho khách hàng
	 * - Lưu log
	 *
	 */
	function bpn()
	{
		$this->checkIP();

		//Tổng hợp thông tin cần thiết
		$baokimPayment = new BaoKimPayment();

		//Kiểm tra chuỗi checksum
		if (!$baokimPayment->bpnGeneChecksum($this->data)) {
			$this->SendResponse(self::HTTP_FORBIDDEN, "Dữ liệu truyền lên không được xác thực từ BK");
		}

		//Baokim đã xác thực thông tin gửi lên, tiến hành xử lý giao dịch cập nhật giao dịch
		$transaction = $this->GetApi('transaction');

		//Kiểm tra tôn tại giao dịch đã hoàn thành trên hê thống.
		if ($transaction->isCompleted($this->data['transaction_id'])) {
			$this->SendResponse(self::HTTP_FORBIDDEN, "Giao dịch này đã được hoàn thành");
		}

		foreach($this->data as $key => $value) {
			if(!isset($transaction->{$key})){
				continue;
			}
			$transaction->Set($key, $value);
		}

		//Tạo giao dịch
		if (!$transaction->Create()) {
			$this->SendResponse(self::HTTP_FORBIDDEN, "Không tạo được giao dịch trên hệ thống, bạn vui lòng liên hệ hỗ trợ");
		}

		//Lấy thông tin đơn hàng sau khi đã tạo được giao dịch.
		$order_api = $this->GetApi('order');

		//Cap nhat thong tin order
		if (!$order_api->UpdateTransactionId($this->data['order_id'], $this->data['transaction_id'])) {
			$this->SendResponse(self::HTTP_FORBIDDEN, "Không cập nhật được thông tin đơn hàng yêu cầu ID: " . $this->data['order_id'] . ", bạn vui lòng liên hệ hỗ trợ");
		}

		//hoàn thành giao dịch
		if (!$transaction->CompleteTransaction($this->data['transaction_id'])) {
			$this->SendResponse(self::HTTP_FORBIDDEN, "Không thể hoàn thành giao dịch");
		}

		//Baokim đã xác thực thông tin gửi lên, tiến hành xử lý giao dịch cập nhật giao dịch
		$order_api->LoadOrder($this->data['order_id']);

		$subscriberinfo = array();

		$user_reg = $this->GetApi('user');
		$fields = array(
			'trialuser', 'username', 'fullname', 'emailaddress',
			'status', 'admintype', 'editownsettings',
			'listadmintype', 'segmentadmintype', 'usertimezone',
			'textfooter', 'htmlfooter', 'templateadmintype',
			'infotips', 'smtpserver',
			'smtpusername', 'smtpport', 'usewysiwyg',
			'enableactivitylog', 'xmlapi', 'xmltoken',
			'googlecalendarusername', 'googlecalendarpassword',
			'adminnotify_email', 'adminnotify_send_flag', 'adminnotify_send_threshold',
			'adminnotify_send_emailtext', 'adminnotify_import_flag', 'adminnotify_import_threshold',
			'adminnotify_import_emailtext',
			'transaction_id' => 'transaction_id',
			'credit_bonus' => 'credit_bonus',
			'data_bonus' => 'data_bonus'
		);

		$result = false;
		$userid = $user_reg->Find($this->data['customer_email']);

		if ($this->debug) {
			$this->logs("User_id là: " . $userid . " với customer_email: " . $this->data['customer_email'], __FUNCTION__);
		}

		if (!$userid) {

			$values = $user_reg->GetValueRegisterDefault($this->data['customer_email']);

			if(empty($values)) {
				$this->SendResponse(self::HTTP_FORBIDDEN, "Dữ liệu Email gửi lên không đúng định dạng");
			}

			foreach ($fields as $p => $area) {
				if ($area == "credit_bonus") {
					$values['credit_bonus'] = $order_api->total_email;
				}
				//CaoPV:Tặng danh sách liên hệ khi mua gói email
				//Date created : 15-09-2014
				if ($area == "data_bonus") {
					$values['data_bonus'] = $order_api->total_email;
				}

				if ($area == "transaction_id") {
					$values['transaction_id'] = $this->data['transaction_id'];
				}

				$val = (isset($values[$area]))
					? $values[$area]
					: '';

				$user_reg->Set($area, $val);
			}

			$user_reg->Set('groupid', SENDSTUDIO_ID_GROUP_VATGIA);

			// this has a different post value otherwise firefox tries to pre-fill it.
			$smtp_password = '';

			if (isset($values['smtp_p'])) {
				$smtp_password = $values['smtp_p'];
			}

			$user_reg->Set('smtppassword', $smtp_password);

			if ($values['ss_p'] != '') {
				$user_reg->Set('password', $values['ss_p']);
			}

			$user_reg->Set('gettingstarted', 1);

			$result = $user_reg->Create();

			if ($result == '-1') {
				$this->SendResponse(self::HTTP_FORBIDDEN, GetLang('UserNotCreated_License'));
			} else {
				if ($result) {
					$userid = $result;

				} else {

					$this->SendResponse(self::HTTP_FORBIDDEN, GetLang('UserNotCreated'));
				}
			}
		} else {

			//Nếu tìm thấy user, cập nhật thông tin
			if ($user_reg->Load($userid))
			{

				if ($user_reg->transaction_id == $this->data['transaction_id']) {
					$this->SendResponse(self::HTTP_FORBIDDEN, 'Giao dịch đã được cập nhật cho người dùng này');
				}

				foreach ($fields as $p => $area) {
					if ($area == "credit_bonus") {
						$user_reg->credit_bonus += $order_api->total_email;
					}

					//CaoPV:Tặng danh sách liên hệ khi mua gói email
					//Date created : 15-09-2014
					if ($area == "data_bonus") {
						$user_reg->data_bonus += $order_api->data_bonus;
					}

					if ($area == "transaction_id") {
						$user_reg->transaction_id = $this->data['transaction_id'];
					}

					$val = (isset($user_reg->{$area}))
						? $user_reg->{$area}
						: '';

					$user_reg->Set($area, $val);
				}

				if ($this->debug) {
					$this->logs(print_r($user_reg, true), __FUNCTION__);
				}

				$result = $user_reg->Save();

				if ($result) {
					//@todo hành động khi cập nhật thành công vào tài khoản người dùng
					//Update trang thai hoat dong.
					$user_reg->UpdateStatus($userid);
				}
			}
			else
			{
				$this->SendResponse(self::HTTP_FORBIDDEN, 'Không lấy được thông tin tài khoản trên hệ thống');
			}
		}

		//Hoàn thành setup tài khoản => cấu hình rule cho tài khoản đó
		if($result) {

			//Get thông tin
			$license = $user_reg->GetLicense($userid);

			$fieldslicense = array('packagename','packageid');

			foreach($fieldslicense as $value) {

				if(isset($order_api->{$value})) {
					$user_reg->Set($value, $order_api->{$value});
				}
			}

			if(!empty($license))
			{
				$user_reg->UpdateLicense($userid);
			}
			else
			{
				$user_reg->CreateLicense($userid);
			}
		}

		//hoàn thành giao dịch
		$transaction->updateOwnerTransaction($userid, $this->data['transaction_id']);

		//Tạo thành công tài khoản gửi Email notify cho quản trị
		$emailapi = $this->GetApi('email');

		$emailapi->SetSmtp(SENDSTUDIO_SMTP_SERVER, SENDSTUDIO_SMTP_USERNAME, @base64_decode(SENDSTUDIO_SMTP_PASSWORD), SENDSTUDIO_SMTP_PORT);

		$emailapi->ClearRecipients();
		$emailapi->ForgetEmail();
		$emailapi->Set('forcechecks', false);

		$emailapi->Set('Subject', "Thông báo có người dùng đăng ký thông qua API Payment");
		$emailapi->Set('FromName', "Quản trị EM BK");
		$emailapi->Set('FromAddress', "luuhaiha88@gmail.com");
		$emailapi->Set('ReplyTo', "luuhaiha88@gmail.com");

		$emailapi->AddBody('text', "USER INFO: " . print_r($user_reg, true) . "ORDER INFO:" . print_r($order_api, true) . " Transaction API: " . print_r($transaction, true));

		$emailapi->AddRecipient("luuhaiha88@gmail.com", false, 't');

		$emailapi->Set('TrackOpens', false);
		$emailapi->Set('TrackLinks', false);

		$emailapi->Set('CharSet', SENDSTUDIO_CHARSET);
		$mail_results = $emailapi->Send(true);

		$this->SendResponse(self::HTTP_OK, '');
	}
}
//
//$payment = new payment();
//$payment->Process();
