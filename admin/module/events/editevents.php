<?php
	if ($_REQUEST["a"] == "events" and $_REQUEST["edit"])
	{
		include_once($_SERVER["DOCUMENT_ROOT"]."/classes/core.class.php");
		include_once($_SERVER["DOCUMENT_ROOT"]."/admin/classes/events.class.php");
		
		$events = new editEvents();
		$events->__getPrioritet();
		
		$title = $events->result["title"];
		$beginDate = $events->result["currentdate"];
		$beginTime = $events->result["currenttime"];
		
		$lastDate = $events->result["lastdate"];
		$lastTime = $events->result["lasttime"];
		
		$status = $events->result["status"];
		
		$eventContent = $events->result["content"];
		
		$сhildcategories = $events->result["сhildcategories"];
		
		if ($status == 1)
		$status = "checked";
		
		if ($сhildcategories == 1)
		$сhildcategories = "checked";
		
		$category = mysqli_query($events->socket, "SELECT c.title, c.id, c.link, c.type, sc.name, sc.index_cat, sc.id_key, sc.altname FROM category as c LEFT JOIN subcategory as sc ON c.link = sc.index_cat where c.type = 'normal' ORDER BY c.title, sc.name");
			
		$expl = explode(",", $events->result["pages"]);
		
		$pages .= "<option style='font-weight:bold;'".$selCat." value=\"/\">Для всех</option>";
		
		for ($i=0, $p=-1; $results = mysqli_fetch_assoc($category); $i++)
		{
			$sel_category = in_array($results["link"], $expl) ? "selected='selected'":'';
			$sel_subcategory = in_array($results["altname"], $expl) ? "selected='selected'":'';
				
			if ($p !== $results["link"])
			{
				$p = $results["link"];
				$pages .= "<option style='font-weight:bold;'".$sel_category." value=".$results["link"].">".$results["title"]."</option>";
			}
			
			if (!empty($results["name"]))
			$pages .= "<option style='padding-left:20px;'".$sel_subcategory." value=".$results["altname"].">".$results["name"]."</option>";			
		}

		
		foreach($events->priority as $num => $value)
		{
			$prioritet = $events->result["priority"] == $num ? "selected='selected'":"";
			$option .= "<option value='".$num."'".$prioritet.">".$value."</option>";
		}
		
		$tpl = new Qtemplate($_SERVER["DOCUMENT_ROOT"]."/admin/module/events/template/","edit");
			$tpl->assign_vars(array(
									"location" => $PHP_SELF,
									"title" => $title,
									"begin-date" => $beginDate,
									"begin-time" => $beginTime,
									"last-date" => $lastDate,
									"last-time" => $lastTime,
									"prioritet" => $option,
									"event" => $eventContent,
									"status" => $status,
									"сhild-categories" => $сhildcategories,
									"page" => $pages
									));
		echo $content .= $tpl->render();		
	}
?>
