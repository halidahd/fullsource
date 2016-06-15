<?php
/**
 * Created by Halh.
 * @author Halh
 * @verison 1.0
 * Date: 3/19/14
 * Time: 8:57 AM
 */
Require_once "baseAPI.php";

class sendmail extends baseAPI
{
	function __construct()
	{
		parent::__construct(__CLASS__);

//		$this->SendResponse(self::HTTP_FORBIDDEN, 'Test truy cap');
	}

	function Process()
	{
		$this->handlerObject->ForgetEmail();
		$this->handlerObject->ClearRecipients();

		if (!$this->data['ToAddress']) {
			$this->SendResponse(self::HTTP_FORBIDDEN, 'Lỗi: Không tìm thấy địa chỉ gửi tới');
		}

		if (!$this->data['TextBody'] && !$this->data['HTMLBody']) {
			$this->SendResponse(self::HTTP_FORBIDDEN, 'Lỗi: Không tìm thấy nội dung Email');
		}

		$this->handlerObject->SetSmtp(SENDSTUDIO_SMTP_SERVER, SENDSTUDIO_SMTP_USERNAME, @base64_decode(SENDSTUDIO_SMTP_PASSWORD), SENDSTUDIO_SMTP_PORT);

		if ($this->userRecord['smtpserver']) {
			$this->handlerObject->SetSmtp($this->userRecord['smtpserver'], $this->userRecord['smtpusername'], $this->userRecord['smtppassword'], $this->userRecord['smtpport']);
		}

		// Bỏ qua unsubscriber link với các email lẻ
		$this->handlerObject->ForceLinkChecks(true);

		// Bỏ qua track link
		$this->handlerObject->TrackLinks(false);

		// Bỏ qua track open
		$this->handlerObject->TrackOpens(false);

		$this->handlerObject->Set('CharSet', SENDSTUDIO_CHARSET); //isset

		// clear out the attachments just to be safe.
		$this->handlerObject->ClearAttachments();

		$this->handlerObject->Set('Subject', $this->data['Subject']);
		$this->handlerObject->Set('FromName', $this->data['FromName']);
		$this->handlerObject->Set('FromAddress', isset($this->data['FromAddress']) ? $this->data['FromAddress'] : $this->userRecord['emailaddress']);
		$this->handlerObject->Set('ReplyTo', isset($this->data['ReplyTo']) ? $this->data['ReplyTo'] : $this->userRecord['emailaddress']);
		$this->handlerObject->Set('BounceAddress', SENDSTUDIO_BOUNCE_ADDRESS);

		$this->handlerObject->Set('SentBy', $this->userRecord['userid']);

		if ($this->data['Multipart']) {
			if ($this->data['TextBody'] && $this->data['HTMLBody'] && $this->data['Format'] == 'b') {
				$this->handlerObject->Set('Multipart', true);
			} else {
				$this->handlerObject->Set('Multipart', false);
			}
		}

		//Định dạng người dùng muốn nhận ( 't' or 'h'), mặc định theo định dạng gửi đi.
		$format = "h";

		if ($this->data['TextBody'] && in_array($this->data['Format'], array('t', 'b'))) {
			$this->handlerObject->AddBody('text', $this->data['TextBody']);
			$this->handlerObject->AppendBody('text', $this->userRecord['textfooter']);
			$this->handlerObject->AppendBody('text', stripslashes(SENDSTUDIO_TEXTFOOTER));
			$format = "t";
		}

		if ($this->data['HTMLBody'] && in_array($this->data['Format'], array('h', 'b'))) {
			$this->handlerObject->AddBody('html', $this->data['HTMLBody']);
			$this->handlerObject->AppendBody('html', $this->userRecord['htmlfooter']);
			$this->handlerObject->AppendBody('html', stripslashes(SENDSTUDIO_HTMLFOOTER));
			$format = "h";
		}

		$this->handlerObject->AddRecipient($this->data['ToAddress'], $this->data['ToName'], $format);

		$mail_result = $this->handlerObject->Send();

		//Lưu kết quả vào db.
		$db = IEM::getDatabase();

		if (is_object($db)) {
			$query = "INSERT INTO `users_sendmail_api` (`ownerid`, `emailaddress`,`sendtime`, `status`,`error_message`, `username`)
							VALUES ('" . $this->userRecord['userid'] . "',
									'" . $this->handlerObject->Get('ToAddress') . "',
									'" . time() . "',
									 " . $mail_result['success'] . ",
									'" . json_encode($mail_result['fail']) . "',
									'" . $this->userRecord['username'] . "'
									);";

			$result = $db->Query($query);
			if ($result == false) {
				list($error, $level) = $db->GetError();

				$this->SendResponse(self::HTTP_FORBIDDEN, $error);
			}

			$db->FreeResult($result);
		}

		if ($mail_result['success'] > 0) {

			$this->SendResponse(self::HTTP_OK, $mail_result['fail']);
		} else {
			reset($mail_result['fail']);
			$failure_message = current($mail_result['fail']);

			//@todo Update thong tin khi gui that bai
			$this->SendResponse(self::HTTP_FORBIDDEN, $failure_message);
		}
	}

	function GetResponse()
	{
		return "OK Da lay duoc du lieu tra ve";
	}
}