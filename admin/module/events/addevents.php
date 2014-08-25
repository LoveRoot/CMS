<?php

if ($_REQUEST["a"] == "events" and $_REQUEST["c"] == "add" )
{
	require_once($_SERVER["DOCUMENT_ROOT"]."/classes/core.class.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/admin/classes/events.class.php");

	$events = new addEvent();
	$events->__getCategory();
	
	$title = htmlspecialchars($_POST["title"]);
	$thisDate =  date("d.m.Y");
	$thisTime =  date("H:m:s");
	$lastDate = $_POST["lastdate"];
	$lastTime = $_POST["lasttime"];
	
	if ($_POST) 
	{
		$posted = 0;
		if (!empty($_POST["posted"])) $posted = 1;
		$date = intval($_POST["date"]);
		$events->add($posted);
	}

	if($events->form == 1)
	{	
		$tpl = new Qtemplate($_SERVER["DOCUMENT_ROOT"]."/admin/module/events/template/","add");
			$tpl->assign_vars(array("title" => $title,
									"category" => $events->arr,
									"thisDate" => $thisDate,
									"thisTime" => $thisTime,
									"lastDate" => $lastDate,
									"lastTime" => $lastTime,
									"event" => htmlspecialchars($_POST["content"])								
									));
		echo $content .= $tpl->render();
	}
	
}
?>