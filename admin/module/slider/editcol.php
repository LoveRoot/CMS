<?php
    if ($_GET["component"] == "slider" && $_GET["edit"]) 
    {
        require_once(admin."classes/slider.class.php");
        require_once(admin."module/slider/photo.php");
        
        $editCol = new editCol();
        $pages = new AdminTree();
        
        if ($_POST["update"]) {
            $editCol->__UpdateSliderImage($_POST["name"], $_POST["category"], $_POST["description"], intval($_GET["edit"]));
        }

        if ($editCol->result == true) {

            $HeaderCaption = "Редактирование коллекции: " . $editCol->result["name"] . "";

            $templ = new Qtemplate($_SERVER["DOCUMENT_ROOT"] . "/admin/module/slider/template/", "editCol");
            $templ->assign_vars(array(
                "SELF" => $PHP_SELF,
                "num" => $i,
                "id" => $editCol->result["id"],
                "ajax-submit" => "<div id=\"ajax\"></div>",
                "name" => $editCol->result["name"],
                "volimg" => $editCol->result["volimg"],    
                "category" => $pages->__GetTreeSliderMultiSelect(0),
                "category-main" => $pages->main,
                "description" => $editCol->result["description"],
                "images" => $images,
                "sort-active" => "/admin.php?a=slider&edit=4&sort=1#photo",
                "sort-no-active" => "/admin.php?a=slider&edit=4&sort=0#photo"
            ));

            $content .= $templ->render();
        }
        else {
            echo core::I()->GetMessageError("Такого типа страницы не существует");
        }
    }
?>