<?php
    require_once(ROOT_PATH_LIBS."paginationAjax.class.php");
    require_once(admin."classes/users.class.php");

        if (isset($_GET["model"])) {
            switch ($_GET["model"]) {
                case "addusers":
                    require_once("addusers.php");
                break;

                case "editusers":
                    require_once("editusers.php");
                break;

            default:
//                $content .= core::I()->GetMessage("Модель не определена");
        }
    } else {
        $usr = new UsrList();
        $html = new html();

        $data = $usr->GetUserList();
        do {
                $usrs .= "<li>".$html->link($data->result["login"], array("href" => "javascript:;",
                                                                          "class" => "options",
                                                                          "onclick" => "open_window_property()",
                                                                          "edition" => "?component=users&model=editusers&id=".$data->result["id"],
                                                                          "delete" => "?component=users&model=delete&delete=".$data->result["id"],
                                                                          "values" => $data->result["login"]
                                            ))."</li>";
        } while ($data->result = mysqli_fetch_assoc($data->query));

        $templ = new QTemplate(admin . "template/users/", "users_list");
        $templ->assign_vars(array("users" => $usrs));
        $content .= $templ->render();
    }
?>