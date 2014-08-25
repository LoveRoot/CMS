<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/admin/classes/category.class.php");
    
    $page = new edit_category();
    
    $tpl = new Qtemplate($_SERVER["DOCUMENT_ROOT"]."/admin/module/pages/main/template/","edit");
				$tpl->assign_vars(array("h1" => $page->result["h1"],
							"content" => $page->result["content"],
							"description" => htmlspecialchars($_POST["description"]),
							"keywords" => htmlspecialchars($_POST["keywords"]),
							));
    echo $content .= $tpl->render();
?>