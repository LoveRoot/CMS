<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/classes/core.class.php");
        require_once($_SERVER["DOCUMENT_ROOT"]."/admin/classes/configure.class.php");
        
	$conf = new core();
	
	global $HeaderCaption;
	
	$HeaderCaption = "Настройки системы";
	
	$content .= $conf->get_include_contents($_SERVER["DOCUMENT_ROOT"]."/admin/module/conf/options.php");
?>
