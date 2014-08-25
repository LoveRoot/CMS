<?php
    if ((isset($_POST["ajaxSubmit"])) && (!empty($_POST["content"]))) {
             
        include($_SERVER["DOCUMENT_ROOT"] . "/classes/routing.class.php");
        include($_SERVER["DOCUMENT_ROOT"] . "/classes/mysqliDB.class.php");
        include($_SERVER["DOCUMENT_ROOT"] . "/classes/core.class.php");
        include($_SERVER["DOCUMENT_ROOT"] . "/admin/classes/slider.class.php");
        include($_SERVER["DOCUMENT_ROOT"] . "/admin/classes/download.class.php");

        $ajaxQuery = new slider();

        switch ($_POST["ajaxSubmit"]) {
  
            case "upload":
                $ajaxQuery = new MultipleDownload($_SERVER["DOCUMENT_ROOT"]."/upload/slider/collection/".$_POST["content"], 
                                                  core::I()->HOST()."/upload/slider/collection/".$_POST["content"], array("thumb" => 240, "normal" => 600), true);      
            break;
        
            case "GetImages":   
                $slider = new showImages("/upload/slider/collection/".$_POST["content"]."/");
            break;

        }
    }
?>