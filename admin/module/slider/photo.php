<?php
    $remove = new editCol();

    switch ($_GET["method"]) {
        case "delete":
            $remove->ImgRemove($_GET["article"]);
        break;
    }
    
    $id = intval($_GET["edit"]);
    
    $path = "/upload/slider/collection/{$id}/";
    
    $img = new ShowImages($path);

    $doc = phpQuery::newDocument("<div id=\"img\"><div id=\"img_preview\" style=\"overflow:hidden;\"></div></div>");
    
    if (empty($img->get_img))
    $doc["#img_preview"]->append("<p>В этой коллекции нет изображений</p>");
    
    $doc["#img_preview"]->append("<div id=\"objects\"><ul></ul></div>"); 
    
    foreach($img->get_img as $img)
    {
       if ($img == ".." || $img == ".") continue;
       if (!is_dir($_SERVER["DOCUMENT_ROOT"].$path.$img))
              
               
       $templ = new Qtemplate(admin."module/slider/template/", "img_list");
       $templ->assign_vars(array("img-dir" => "", 
                                 "img-original" => core::I()->Host().$path."original/".$img,
                                 "img-src" => core::I()->Host().$path.$img,
                                 "img-alt" => "",
                                 "img-title" => ""));
       $doc["#img_preview #objects ul"]->append($templ->render());
    }

    $doc["#img"]->append("<a id=\"addImg\" onclick=\"download_slider(this);\"></a><input id=\"Download\" type=\"file\" name=\"filename[]\" style=\"display:none;\" multiple />");
    
    $images = $doc;
    
?>
