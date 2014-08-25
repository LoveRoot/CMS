<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/libs/mailsender/view.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/libs/mailsender/PHPMailer.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MailSender
 *
 * @author user
 */
class MailSender {

	/**
	 *
	 * @var MailSender
	 */
	protected static $Instanse;

	/**
	 *
	 * @return MailSender
	 */
	public static function I() {
		if (!self::$Instanse)
			self::$Instanse = new MailSender();
		return self::$Instanse;
	}

	protected $ViewMainPath = '/component/main/view/email/';

	protected function __construct() {

	}

	protected $SmptSetings = array(
		"host"	=> "smtp.yandex.ru",
		"debug" => false,
		"auth"	=> true,
		"port"	=> 25
	);
	protected $MailSetNoReplay = array(
		"username"	=> "robot@region-media-yug.ru",
		"name"		=> "robot@region-media-yug.ru",
		"password"	=> "123457",
		"addreply"	=> "robot@region-media-yug.ru",
		"replyto"	=> "robot@region-media-yug.ru"
	);

	public function SendCreateFirmStyleMail($to, $param) {
		$subject = "Анкета для создания фирменого стиля с region-media-yug.ru";
		$shablon = $_SERVER['DOCUMENT_ROOT'] . '/form/email/create_firm_style.phtml';
		$body	 = view::template($shablon, $param);

		$this->SendMail($to, $subject, $body, $this->MailSetNoReplay, $this->SmptSetings);
	}
	public function SendCreateLogoMail($to, $param) {
		$subject = "Анкета для создания логотипа с region-media-yug.ru";
		$shablon = $_SERVER['DOCUMENT_ROOT'] . '/form/email/create_firm_style.phtml';
		$body	 = view::template($shablon, $param);

		$this->SendMail($to, $subject, $body, $this->MailSetNoReplay, $this->SmptSetings);
	}
	public function SendContextMail($to, $param) {
		if (
						trim($param['fio']) &&
						trim($param['contact']) &&
						trim($param['type'])
		) {
			$subject = "Анкета для контекстной рекламы с region-media-yug.ru";
			$shablon = $_SERVER['DOCUMENT_ROOT'] . '/form/email/context.phtml';
			$body = view::template($shablon, $param);

			$this->SendMail($to, $subject, $body, $this->MailSetNoReplay, $this->SmptSetings);
		}
	}

	public function SendMailing($to, $subject, $message) {
		$subject		= $subject;
//		$shablon		= $_SERVER['DOCUMENT_ROOT'] . '/form/email/context.phtml';
//		$body			= view::template($shablon, $param);

		$this->SendMail($to, $subject, $message, $this->MailSetNoReplay, $this->SmptSetings);
	}

	public function SendOrderCall($to, $mes) {
		$subject = "Заказ обратного звонка";
		$this->SendMail($to, $subject, $mes, $this->MailSetNoReplay, $this->SmptSetings);
	}

	public function SendMail($email_to, $subject, $body, $fromSettings='', $smptSetings='') {
if(!$fromSettings)
	$fromSettings = $this->MailSetNoReplay;
if(!$smptSetings)
	$smptSetings = $this->SmptSetings;

		$mail = new PHPMailer(true);
		$mail->IsSMTP();
		try {

			$mail->Host = $smptSetings['host'];
			$mail->SMTPDebug = $smptSetings['debug'];
			$mail->SMTPAuth = $smptSetings['auth'];
			$mail->Host = $smptSetings['host'];
			$mail->Port = $smptSetings['port'];

			$mail->Username = $fromSettings['username'];
			$mail->Password = $fromSettings['password'];
			$mail->SetLanguage('ru');
			$mail->SetLanguage('ru');
			$mail->AddReplyTo($fromSettings['addreply'], $fromSettings['name']);
			$mail->SetFrom($fromSettings['replyto'], $fromSettings['name']);

			if (is_array($email_to))
				foreach ($email_to as $email) {
					$mail->AddAddress(trim($email));
				}
				if(is_string($email_to))
					$mail->AddAddress(trim($email_to));


			$mail->Subject = htmlspecialchars($subject);
			$mail->MsgHTML($body);
			$mail->Send();
		} catch (phpmailerException $e) {
			echo 1;
			echo $e->errorMessage();
		} catch (Exception $e) {
			echo 2;
			echo $e->getMessage();
		}
	}


}