<?php
    if ($_GET["component"] == "article" && $_GET["model"] == "editarticle") 
    {
        require_once(admin."classes/article.class.php");
        
        $tree = new AdminTree("status=1 and type='article'");

        $obj = new edit_article();
        
        $title = isset($_POST["title"]) ? $_POST["title"] : $obj->resultQuery["title"];
        $shortarticle = isset($_POST["shortarticle"]) ? $_POST["shortarticle"] : $obj->resultQuery["shortnews"];
        $fullarticle = isset($_POST["fullarticle"]) ? $_POST["fullarticle"] : $obj->resultQuery["fullnews"];
        $status = isset($_POST["status"]) ? "checked" : !empty($obj->resultQuery["status"]) ? "checked" : "";
        $main = isset($_POST["main"]) ? "checked" : !empty($obj->resultQuery["main"]) ? "checked" : "";
        $prioritet = isset($_POST["prioritet"]) ? "checked" : !empty($obj->resultQuery["prioritet"]) ? "checked" : "";
        $seotitle = isset($_POST["seotitle"]) ? $_POST["seotitle"] : $obj->resultQuery["seotitle"];
        $description = isset($_POST["description"]) ? $_POST["description"] : $obj->resultQuery["description"];
        $keywords = isset($_POST["keywords"]) ? $_POST["keywrods"] : $obj->resultQuery["keywords"];
        
        $content = isset($obj->message) ? $obj->message : "";
        
        if ($_POST["tags"]) {
            foreach ($_POST["tags"] as $tag) {
                $tags .= "<div class='rowAddTags'>
                            <input type='text' name='tags[]' value='" . $tag . "' style='width:180px;' />&nbsp;&nbsp;
                            <a href='javascript:' class='delete_tag_row'>
				<img src='/admin/engine/images/remove_row.png' title='Удалить'>
                            </a>
                         </div>";
            }
        }
            else {
                
            $tags = $obj->tags;
        }

        $templ = new Qtemplate(admin."module/pages/article/template/", "template");
            $templ->assign_vars(array("location" => $PHP_SEF,
                                      "title" => $title,
                                      "url" => $url,
                                      "pages" => $tree->__GetTreeSelect(),
                                      "shortnews" => $shortarticle,
                                      "fullnews" => $fullarticle,
                                      "status-checked" => $status,
                                      "main-checked" => $main,
                                      "prioritet-checked" => $prioritet,
                                      "tags" => $tags,
                                      "seotitle" => $seotitle,
                                      "keywords" => $keywords,
                                      "description" => $description,
                                      "status-checked" => $status,
                                      "main-checked" => $main,
                                      "priority-checked" => $prioritet,
                                     ));
        $content .= $templ->render();
    }
?>
