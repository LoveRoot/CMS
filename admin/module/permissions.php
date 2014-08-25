<?php
	$content .= $core->get_include_contents($_SERVER["DOCUMENT_ROOT"]."/admin/module/permissions/showGroups.php");
	$content .= $core->get_include_contents($_SERVER["DOCUMENT_ROOT"]."/admin/module/permissions/editGroups.php");
	$content .= $core->get_include_contents($_SERVER["DOCUMENT_ROOT"]."/admin/module/permissions/addGroups.php");
?>