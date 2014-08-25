<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/admin/classes/application.class.php");
	$app = new application();
	
	$app->set_app_read(intval($_GET["id"]));

?>

