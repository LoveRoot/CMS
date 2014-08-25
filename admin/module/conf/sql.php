<?php

    $list = new database();

    $post = $list->getCountPost();
    $comments = $list->getCountComments();

    $tpl = new Qtemplate($_SERVER["DOCUMENT_ROOT"] . "/admin/module/conf/template/", "db");
    $tpl->assign_vars(array("POST" => $post, "COMMENTS" => $comments));
    echo $content .= $tpl->render();
?>