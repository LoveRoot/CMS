<?php
	$data = new module();

	$tpl = new Qtemplate($_SERVER["DOCUMENT_ROOT"]."/admin/module/conf/template/","events");
		$tpl->assign_vars(array(
								"lastnews" => $data->getLastnews(),
								"whoonline" => $data->getWhoonline(), 
								"lastcomments" => $data->getLastcomments(),
								"tags" => $data->getTags(),
								"event" => $data->getEvent(),
								"search" => $data->getSearch(),
								"slider" => $data->getSlider()
								));
	echo $content .= $tpl->render();
?>