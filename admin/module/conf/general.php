<?php
    	require_once($_SERVER["DOCUMENT_ROOT"]."/classes/core.class.php");
	
	$data = new core();
	$template = new general();
	
	$dates = date("d-m-Y");
	
	$path = $_SERVER["DOCUMENT_ROOT"]."/template/";

	$title = $data->__config("title");
	$name_site = $data->__config("name");
        $email = $data->__config("email");
	$desc = $data->__config("description");
	$keyw = $data->__config("keywords");
        $breadcrumbs_status = $data->__config("breadcrumbs");
	$autoCategory = $data->__config("rend_cat_auto");
	$stop = $data->__config("reconstruction");
	
	$tpl = new Qtemplate($_SERVER["DOCUMENT_ROOT"]."/admin/module/conf/template/","general");
		$tpl->assign_vars(array("title" => $title,
					"name-site" => $name_site,
                                        "email" => $email,
					"description" => $desc,
					"keywords" => $keyw,
					"pagination" => $pagination,
					"template" => $template->GetTemplate($path),
                                        "breadcrumbs-status" => $breadcrumbs_status,
					"auto-category" => $autoCategory,                                      
					"site-stop" => $stop));
	echo $content .= $tpl->render();
?>
	
	
		