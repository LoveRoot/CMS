<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/admin/classes/blacklist.class.php");

if ($_POST)
{
	$black = new blacklist();
	$black->addlist($_POST["list"]);
	$content .= $black->success("Ваши параметры успешно сохранены !<br />Через 3 сек вы будите перемещены....");
	header("Refresh:3; url=".$_SERVER["HTTP_REFERER"]."");
}

$black_read = new def_blacklist();

foreach($black_read->file_read as $read)
{
	$outlist .= $read;
}

$bl = new Qtemplate("admin/template/","blacklist");
	$bl->assign_vars(array("list" => $outlist));	
$content .= $bl->render();
?>