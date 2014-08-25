<?php

    $data = new module();

    $tpl = new Qtemplate($_SERVER["DOCUMENT_ROOT"] . "/admin/module/conf/template/", "slider");
    $tpl->assign_vars(array(
        "" => ""
    ));
    echo $content .= $tpl->render();
?>