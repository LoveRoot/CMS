<?php

    if ($_GET["component"] == "pages" and !empty($_GET["edit"])) 
    {
        include_once($_SERVER["DOCUMENT_ROOT"] . "/admin/classes/gallery.class.php");
        
        $ShowImages = new Images();
        $idPage = $ShowImages->resID["id"];
        
        $ShowColl = new Collection($idPage);

        $doc = phpQuery::newDocument("<div id=\"gallery-bg\"></div>");

        $doc["#gallery-bg"]->append("<div class=\"control\">
                                        <a art=".$ShowImages->resID[0]." id=\"create_collection\" onclick=\"__AddCollection($idPage,0);\" href=\"javascript:;\">Создать коллекцию</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href=\"".$_GET["edit"].".html\" id=\"views\" target=\"_blank\">Просмотр</a>
                                     </div>");
        
        $doc["#gallery-bg"]->append("<div id=\"collection\">
            <h2>Список коллекций</h2>
	</div>");
        
        $doc["#gallery-bg #collection"]->append("<div id=\"ShowColl\">".$ShowColl->__RenderCollection()."</div>");

         $doc["#gallery-bg"]->append("<div id=\"images\"><h2>Список изображений в коллекции</h2>".
            "<div id=\"objects\">
		<ul></ul>
		<div style=\"display:none;\" class=\"progress\">
		<div class=\"bar\"></div >
		<div class=\"percent\">0%</div >
             </div>
            </div>".
            "<div id=\"add\"><input type=\"button\" value=\"Загрзуить изображения\" id=\"AddImages\" onclick=\"__AddImages();\" /></div>" .
            "<div id=\"inp\"><input id=\"file\" type=\"file\" name=\"filename[]\" style=\"display:none;\" multiple /></div>" .
            "</div>");
        

        echo $doc;
    }
?>