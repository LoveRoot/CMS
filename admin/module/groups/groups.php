<?php

require_once(ROOT_PATH_LIBS . "htmlentities.class.php");
require_once(ROOT_PATH_LIBS . "pagination.class.php");
require_once(admin . "/classes/groups.class.php");

if (isset($_GET["model"])) {
    switch ($_GET["model"]) {

        case "addgroups":
            require_once("addgroups.php");
        break;

        case "editgroups":
            require_once("editgroups.php");
        break;
    
        case "delete":
            $groups = new groups();
            $groups->Delete(intval($_GET["id"]));
        break;

        default:
            $content .= core::I()->GetMessage("Модель не определена");
    }
} else {

    $gr = new groups();
    $html = new html();

    if ($gr->list->result == true) {
        do {
            $shGroups .= "<li>" . $html->link($gr->list->result["name"], array("href" => "javascript:;",
                        "class" => "options",
                        "onclick" => "open_window_property()",
                        "edition" => "?component=groups&model=editgroups&id=" . $gr->list->result["id"],
                        "delete" => "?component=groups&model=delete&id=".$gr->list->result["id"],
                        "values" => $gr->list->result["name"]
                    )) . "</li>";
        } while ($gr->list->result = mysqli_fetch_assoc($gr->list->sql));
    } else {
        $shGroups = "У вас нет активных рабочих групп";
    }


    $templ = new QTemplate(admin . "template/groups/", "groups_list");
    $templ->assign_vars(array("groups" => $shGroups));
    $content .= $templ->render();
}
?>
