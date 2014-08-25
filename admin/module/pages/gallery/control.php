<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/admin/classes/gallery.class.php");
        
    $designObj = new Images();

    $theme = array("По умолчанию" => array(
                                            "id" => "default",
                                            "description" => "Список изображений, с всплывающим окном"
                                          ),
                   "Дизайн 1" =>     array(
                                            "id" => "design1",
                                            "description" => "Слайд галерея"
                                           ),
        
                   "Дизайн 2" =>     array(
                                            "id" => "design2",
                                            "description" => "Дизайн 2"
                                          )
                   );
    
    foreach($theme as $i => $items)
    {
       $selDesign = $designObj->resID[1] == $items["id"] ? "checked":"";
       
       $design .= "<div class=\"design-box\">".
                      "<p>".$items["description"]."</p>".
                          "<input id=".$items["id"]." type=\"radio\" name=\"design\" value=".$items["id"]." $selDesign />".
                          "<label for=".$items["id"].">".$i."</label>".
                   "</div>";
    }
    
    $tpl = new Qtemplate($_SERVER["DOCUMENT_ROOT"]."/admin/module/pages/gallery/template/","control"); 
        $tpl->assign_vars(array("design" => $design));
    echo $tpl->render();
?>