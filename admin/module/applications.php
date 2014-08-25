<?php
	switch($_GET["c"])
	{
		case readfull:
			$content .= $core->get_include_contents($_SERVER["DOCUMENT_ROOT"]."/admin/module/application/app_read_full.php");
		break;
		
		default:
			$content .= $core->get_include_contents($_SERVER["DOCUMENT_ROOT"]."/admin/module/application/application.php");
	}
?>