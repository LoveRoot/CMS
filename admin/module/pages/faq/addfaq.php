<?php
    if ($_GET["component"] == "faq" && $_GET["model"] == "addfaq")
    {
        require_once(admin."classes/faq.class.php");

        $tree = new AdminTree("status=1 and type='faq'"); 
        $faq = new AddFaq(); 
        $core = new core();
        
        $faq = new Qtemplate(admin."module/pages/faq/template/", "template");
        
        $faq->assign_vars(array(
                                "location" => $PHP_SELF,
                                "title" => strip_tags($_POST["title"]),
                                "content" => strip_tags($_POST["content"]),
                                "pages" => $tree->__GetTreeSelect(),
                                "status" => "checked"
                                
        ));
        
        $content .= $faq->render();
    }
?>