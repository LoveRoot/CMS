<?php
    $usr = new UsrAdd();

    $resultGroup = DB::I()->__SelectItems("groups", array("name, id"), "id != 1");
    
    do {
        $options .= "<option value='{$resultGroup["id"]}'>".$resultGroup["name"]."</option>";
    } while ($resultGroup = mysqli_fetch_assoc(DB::I()->query));
     
    $templ = new QTemplate(admin."template/users/", "add_user");
        $templ->assign_vars(array("login" => isset($_POST["adm_login"]) ? $_POST["adm_login"] : '',
                                  "name" => isset($_POST["adm_name"]) ? $_POST["adm_name"] : '',
                                  "email" => isset($_POST["adm_email"]) ? $_POST["adm_email"] : '',
                                  "old-name" => isset($_POST["adm_old_name"]) ? $_POST["adm_old_name"] : '',
                                  "family" => isset($_POST["adm_family"]) ? $_POST["adm_family"] : '',
                                  "phone" => isset($_POST["adm_phone"]) ? $_POST["adm_phone"] : '',
                                  "usr-info" => isset($_POST["adm_usr_info"]) ? $_POST["adm_usr_info"] : '',
                                  "groups" => $options
    ));
    $content .= $templ->render();
?>