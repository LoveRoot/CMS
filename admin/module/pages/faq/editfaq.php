<?php
    if ($_GET["component"] == "faq" && !empty($_GET["edit"]))
    {
        require_once(admin."classes/faq.class.php");
        
        $tree = new AdminTree("status=1 and type='faq'");       
        $faq = new EditFaq();
        
        $name = isset($_POST["title"]) ? $_POST["title"] : $faq->title;
        $data = isset($_POST["content"]) ? $_POST["content"] : $faq->data;
        $status = isset($_POST["status"]) ? "checked" : $faq->status;
        
        $content = isset($faq->message) ? $faq->message : "";
        
        if ($status == 1)
        $status = "checked";
            
        $faq = new Qtemplate(admin."module/pages/faq/template/", "template");
        
        $faq->assign_vars(array(
                                "location" => $PHP_SELF,
                                "title" => $name,
                                "content" => $data,
                                "pages" => $tree->__GetTreeSelect(0),
                                "status" => $status
        ));
        
        $content .= $faq->render();
    }
?>