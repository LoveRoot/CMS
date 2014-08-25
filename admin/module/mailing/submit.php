<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/classes/core.class.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/libs/mailsender/MailSender.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/classes/mysqliDB.class.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/admin/classes/mailing.class.php");

	$title = addslashes($_POST["title"]);
	$message = addslashes($_POST["msg"]);

	$send = new MailSend($title, $message, $_POST["sel"]);

?>