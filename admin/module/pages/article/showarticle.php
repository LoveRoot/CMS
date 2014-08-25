<?php
    require_once(admin."/classes/article.class.php");
    require_once(ROOT_PATH_LIBS."pagination.class.php");
    
    $page = new pagination ("Select * From article where p_id='".intval($_GET["edit"])."'",
                            "Select id From article where p_id='".intval($_GET["edit"])."'", 10);
    
    $doc = phpQuery::newDocument("<div id=\"list\"></div>");
    
    $article = new article();
    
    if (isset($_GET["delete"]) && !empty($_GET["delete"])) {
        $article->__delete(intval($_GET["delete"]));
        
        if (!empty($this->err_message)) {
            $message = core::I()->GetTemplate("SystemMessage", array("message" => $this->err_message));
        }
    }

    if ($page->result == true) 
    {   
        $doc["#list"]->append("<div id=\"action\"><a class=\"add-item\" href=\"?component=article&model=addarticle&page=".intval($_GET["edit"])."\">Создать запись</a></div>");
        $doc["#list"]->append("<div id=\"draganddrop\"></div>");
            
        $doc["#list #draganddrop"]->append("<ul id=\"article\"></ul>");     
        do
        {
            $status = $page->result['status'] == 0 ? "hide":"";
                
            $doc["#draganddrop ul"]->append("<li><a href=\"javascript:\" class=\"options article $status\"
                                                                     delete='/admin.php?".$_SERVER["QUERY_STRING"]."&delete=".$page->result["id"] . "'
                                                                     edition='?component=article&model=editarticle&edit=".$page->result["id"]."&page=".intval($_GET["edit"])."'
                                                                     property='type=article&id=".$page->result["id"]."'
                                                                     views='/".$page->result["p_id"]."/".$page->result["rewrite_url"].".html'>
                                                                     ".substr($page->result["title"], 0, 200)."</a></li>");
        }
        while($page->result = mysqli_fetch_assoc($page->sql));
    }
      else {
        $doc["#list"]->append(core::I()->GetTemplate("ShowAlert", array("caption" => "<h1>К сожалению</h1>","ShowAlert" => "Для данной странице статей не найдено, <a href=\"/admin/?component=article&model=addarticle&page=".$_GET["edit"]."\">Создать запись</a>")));
    }
    
    echo $content .= $doc;
?>