<?php
    if ($_GET["component"] == "article" && $_GET["model"] == "addarticle") 
    {
        require_once(admin."classes/article.class.php");
        
        $tree = new AdminTree("status=1 and type='article'");
        
        $obj = new add_article();
        
        if (isset($_POST)) {
           $title = $_POST["title"];
           $url = $_POST["urls"];
           $shortarticle = $_POST["shortarticle"];
           $fullarticle = $_POST["fullarticle"];
           $status = $_POST["status"];
           $main = $_POST["main"];
           $prioritet = $_POST["prioritet"];
           $seotitle = $_POST["seotitle"];
           $description = $_POST["description"];
           $keywords = $_POST["keywords"];
        }
        
        $status = isset($status) ? "checked":"";
        $main = isset($main) ? "checked":"";
        $prioritet = isset($main) ? "checked":"";
 
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
                                      "status-checked" => "checked",
                                      "main-checked" => "",
                                      "priority-checked" => ""
                                     ));
        $content.= $templ->render();
    }
?>
