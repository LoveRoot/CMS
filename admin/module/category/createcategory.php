<?php
if (isset($_GET["component"]) && $_GET["component"] == "pages" && isset($_GET["c"]) && $_GET["c"] == "add")
{
    require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/classes/category.class.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/classes/configure.class.php");
		require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/classes/category.class.php");

    $tree = new AdminTree("status=1");

    $obj = new create_category();
    $obj->create();
    $templ = new general();
    $page_templ = $templ->GetFile($_SERVER["DOCUMENT_ROOT"]."/template/".core::I()->__config("template")."/user_template/",$obj->result["template"]);

    $content = !empty($obj->message) ? $obj->message : "";

    if ($obj->permissions->protect == 0)
    {
        $groups .= "<option value='*'>Для всех</option>";
        $groups .= "<option value='*.*'>Для зарегистрированных</option>";

        $sql = mysqli_query(core::I()->link, "Select name, id_group From groups where id_group != '1'");
	$result = mysqli_fetch_object($sql);
	do {
             $list_groups .= "<option value='" . $result->id_group . "' " . $selGroups . ">" . $result->name . "</option>";
         } while ($result = mysqli_fetch_object($sql));

         if (intval($obj->result["viewsgroups"]))
         $resGroups = explode(",", $obj->result["viewsgroups"]);
         else
         $resGroups = $obj->result["viewsgroups"];

        $groups = "<option value='register'" . $registerSelect . ">Для зарегистрированных</option>";
        $groups .= "<option value='*'" . $allSelect . ">Для всех</option>";
        $groups .= "<option value='custom' " . $customSelect . ">Свой вариант</option>";

        $name = $_POST["name"];
        $seotitle = $_POST["seotitle"];

        $altname = $_POST["altname"];
        $h1 = strip_tags(mysql_escape_string($_POST["h1"]));
        $context = strip_tags(mysql_escape_string($_POST["context"]));
        $num_row = $_POST["num_row"];
        $description = $_POST["desc"];
        $keywords = $_POST["keyw"];
        $pass_access = $_POST["password_access"];

        $templ = new Qtemplate(admin."module/category/tpl/", "create");

        $templ->assign_vars(array("location" => $location,
                                  "title" => $name,
                                  "altname" => $altname,
                                  "h1" => $h1,
                                  "context" => $context,
                                  "page-template" => $page_templ,
                                  "pagination" => $num_row,
                                  "type-page" => "",
                                  "list-groups" => $list_groups,
                                  "pages" => $tree->__GetTreeSelect(0),
                                  "logo" => $logo,
                                  "seotitle" => $seotitle,
                                  "description" => $description,
                                  "keywords" => $keywords,
                                  "password" => $pass_access,
                                  "groups" => $groups
        ));


    } else {
       $content = $core->GetMessage("ShowAlert", array("caption" => "<h1>К сожалению</h1>",
                                                       "ShowAlert" => "У вас недостаточно прав для создания страниц"));
    }

    $content .= $templ->render();
}
?>