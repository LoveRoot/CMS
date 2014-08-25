<?php
    if ($_GET["component"] == "slider" and $_GET["model"] == "addslider") 
    {
        require_once(admin."classes/slider.class.php");
        
        $addSlider = new addCol();
        $category = new AdminTree();

        $message = isset($addSlider->message) ? $addSlider->message : "";

        $addcol = new Qtemplate($_SERVER["DOCUMENT_ROOT"] . "/admin/module/slider/template/", "addCol");
        $addcol->assign_vars(array(
            "SELF" => $PHP_SELF,
            "pages" => $pages,
            "name" => $_POST["name"],
            "volimg" => $_POST["volimg"],
            "category" => $category->__GetTreeSliderMultiSelect(0, 0, 0),
            "description" => $_POST["description"]
        ));
        
        $content .= $addcol->render();
    }
?>