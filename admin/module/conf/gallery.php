<?php

    $data = new module();

    $tpl = new Qtemplate($_SERVER["DOCUMENT_ROOT"] . "/admin/module/conf/template/", "gallery");
    $tpl->assign_vars(array(
        "max_width" => $data->__config("gallery_normal_w"),
        "max_height" => $data->__config("gallery_normal_h"),
        "max_width_thumb" => $data->__config("gallery_thumb_w"),
        "max_height_thumb" => $data->__config("gallery_thumb_h")
    ));
    echo $content .= $tpl->render();
?>


