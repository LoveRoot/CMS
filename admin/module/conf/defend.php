<?php
    $data = new core();

    $tpl = new Qtemplate($_SERVER["DOCUMENT_ROOT"] . "/admin/module/conf/template/", "defend");
    $tpl->assign_vars(array(
                            "defend-ip" => $data->__config("ADMIN_IP_ADDR_ENABLE"),
                            "attach-ip" => $data->__config("ADMIN_IP_ADDR"),
                            "confirm-regs" => $data->__config("confirm_register")
    ));
    echo $content = $tpl->render();
?>
