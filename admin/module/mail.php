<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/admin/classes/core.class.php");
	
	$mail = new admin();
	
	$mail->connect();
	$mail->email();
	
	do
	{
		print "fsd";
	}
	while($mail->res_mail = mysqli_fetch_assoc($mail->get_mail));
?>
