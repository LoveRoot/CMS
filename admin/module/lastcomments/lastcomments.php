<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/admin/classes/lastcomments.class.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/admin/classes/pagination.class.php");
	
	$comments = new page(
						"Select * From comments",
						"Select id From comments", 5
						);
	
	
	$lastcomments_tpl = new Qtemplate($_SERVER["DOCUMENT_ROOT"]."/admin/module/lastcomments/template/", "lastcomments");
		$lastcomments_tpl->assign_vars(array(
								"" => ""
								));
	$lastcomments = $lastcomments_tpl->render();
?>