<?php
    if ($_GET["component"] == "slider" && !isset($_GET["model"])) 
    {
        require_once(ROOT_PATH_LIBS. "pagination.class.php");
        require_once(admin."classes/slider.class.php");

        $showSlider = new showCol();
        
        if (isset($_POST) || isset($_GET["delete"]))
        $showSlider->__Removal($obj=isset($_GET["delete"]) ? $_GET["delete"]:$_POST["objects"]);
        
        $obj = new pagination("Select * from slidercollection ORDER by id ASC", "Select id from slidercollection ORDER by id ASC", 10);
        
         $doc = phpQuery::newDocument("<div id=\"slider-coll\"></div>");
         $doc["#slider-coll"]->append("<h1>Ротационные блоки</h1>");
        
        if ($obj->result == true) 
        {
            $doc["#slider-coll"]->append("<form action='' method='POST'></form>");
            $doc["#slider-coll form"]->append("<div id=\"action\"><a class=\"add-item\" href=\"?component=slider&model=addslider"."\">Добавить коллекцию</a></div>");
            $doc["#slider-coll form"]->append("<ul id=\"no-list-style\"></ul>");
            
            do {
                    $active = "<img src=\"/admin/template/images/ico/admin/noprotect.png\"  alt=\"Без защиты\" title=\"Без защиты \" />";

                    if ($obj->result["status"] == 0)
                    $active = "<img src=\"/admin/template/images/ico/admin/defend.png\" alt=\"Эта статья не активная\" title=\"Не активная\" />";
                    
                    $doc["#slider-coll form ul"]->append("<li>
                                                                <a href=\"javascript:\" class=\"options default\"
                                                                                        edition='?component=$_GET[component]&model=editslider&edit=".$obj->result["id"]."&sort=1' 
                                                                                        delete='?component=".$_GET["component"]."&c=$_GET[c]&delete=".$obj->result["id"]."'
                                                                                        property='type=slider&id=".$showSlider->obj->result["id"]."'>
                                                                                        ".$obj->result["name"]."
                                                                </a>
                                                          </li>");
            } while ($obj->result = mysqli_fetch_assoc($obj->sql));
                        
            $doc["#slider-coll"]->append($obj->navigation("admin.php?a=slider&c=all&page="));

        } else {
            $doc["#slider-coll"]->append("<div id=\"action\"><a class=\"add-item\" href=\"/admin/?component=slider&model=addslider\">Добавить колекцию</a></div>");
        }
        $content .= $doc;
    }
?>