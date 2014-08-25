<?php
    require_once(admin."classes/faq.class.php");
    require_once(ROOT_PATH_LIBS."pagination.class.php");
     
    $faq = new faq();

    $page = new pagination("Select id, title, p_id, status From faq where p_id='".intval($_GET["edit"])."'", 
                           "Select id From faq where p_id='".intval($_GET["edit"])."'", 10);

    echo "<div id='action'>";
    echo "<a class=\"add-item\" href=\"?component=faq&model=addfaq&page=".intval($_GET["edit"])."\">Добавить вопрос</a>";
    echo "</div>";

    if ($page->result == true) 
    {
        echo "<div id=\"list\">";
        echo "<Form action=\"\" method=\"POST\">";
        echo "<ul>";
        do 
        {
            if ($page->result["status"] == 0)
            $active = "<img src=\"/admin/template/images/ico/admin/status_hide.png\" alt=\"Эта запись не активная\" title=\"Эта запись не активная\" />";
            else
            $active = "<img src=\"/admin/template/images/ico/admin/noprotect.png\" alt=\"Эта запись активная\" title=\"Эта запись активная\" />";    
                
            $status = $page->result["status"] == 0 ? "hide":"";
            
            echo "<li><a href=\"javascript:\" class=\"options faq $status\" delete='/admin/".$_SERVER["QUERY_STRING"]."&delete=".$page->result["id"]."'
                                                       edition='?component=faq&&model=editfaq&edit=".$page->result["id"]."&page=".$page->result["p_id"] . "'
                                                       property='type=faq&id=".$page->result["id"]. "'
                                                       values='" . $page->result["title"] . "'>" . substr($page->result["title"], 0, 220) . "</a></li>";
            
           
        }
        while ($page->result = mysqli_fetch_assoc($page->sql));
        echo "</ul>";

        echo $page->navigation("admin.php?" . $_SERVER["QUERY_STRING"] . "&page=");

        echo "</Form>";
        echo "</div>";
    }
    else {
        echo core::I()->GetTemplate("ShowAlert", array("caption" => "<h1>К сожалению</h1>",
            "ShowAlert" => "В данной категории нет актиынх вопросов, <a href=\"/admin/?component=faq&c=add&edit=" . $_GET["edit"] . "\">Добавить вопрос</a>"
        ));
    }
?>