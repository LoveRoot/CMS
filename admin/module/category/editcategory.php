<?php
    if ($_GET["component"] == "pages" && $_GET["edit"])
    {
        require_once(admin."classes/secure_panel.class.php");
        require_once(admin."classes/download.class.php");
        require_once(admin."classes/category.class.php");
        require_once(admin."classes/configure.class.php");
        
        $obj = new edit_category();
        $templ = new general();
        $page_templ = $templ->GetFile($_SERVER["DOCUMENT_ROOT"]."/template/".core::I()->__config("template")."/user_template/",$obj->result["template"]);

        $nonType = false;
        
        if ($obj->permissions->protect == 0 && $obj->result == true)
        {        
            switch($obj->result["type"])
            {
                case "gallery":                   
                    $page_load = admin."module/pages/gallery/showGallery.php";
                    $control_content = admin."module/pages/gallery/control.php";
                break;

                case "main":
                    $page_load = admin."module/pages/main/editmain.php";
                    $control_content = admin."module/pages/main/template/control.tpl";
                break;

                case "faq":
                    $page_load = admin."module/pages/faq/showfaq.php";
                    $control_content = admin."module/pages/faq/template/control.tpl";
                break;

                case "normal":
                    $page_load = admin."module/pages/normal/showpage.php";
                    $control_content = admin."module/pages/normal/template/control.tpl";
                break;

		case "article":
                    
                    $page_load = admin."module/pages/article/showarticle.php";
                    $control_content = admin."module/pages/article/template/control.tpl";
                break;

                default:
                    $nonType = true;
            }

            if ($nonType == true)
            {
               $content = core::I()->GetTemplate("ShowAlert", array("caption" => "<h1>Ошибка</h1>", "ShowAlert" => "Неверный тип страницы !"));
            }
                else
            {
                $img = core::I()->HOST().$obj->result["img"];

                $status = $obj->result["status"];

                if ($obj->result["form"] == 1)
                $form_checked = "checked";


                $result = DB::I()->__SelectItems("groups",array("name, id_group"),"id_group != '1'");
 
                if(intval($obj->result["viewsgroups"]))
                $resGroups = explode(",",$obj->result["viewsgroups"]);
                else
                $resGroups = array($obj->result["viewsgroups"]);
                
                $tree_pages = isset($_POST["tree"]) ? $_POST["keywrods"] : $obj->result["tree"] == 1 ? "checked":"";
                $registerSelect = $resGroups[0] == "register" ? "selected='selected'":"";
                $allSelect = $resGroups[0] == "*" ? "selected='selected'":"";
                $customSelect = intval($obj->result["viewsgroups"]) ? 'selected=selected':'';

                $groups = "<option value='register'".$registerSelect.">Для зарегистрированных</option>";
                $groups .= "<option value='*'".$allSelect.">Для всех</option>";
                $groups .= "<option value='custom' ".$customSelect.">Свой вариант</option>";
                
                if ($status == 0)
                    $visible = "checked";

                do
                {
                    $selGroups = (in_array($result->id_group, $resGroups)) ? "selected='selected'" : "";
                    $list_groups .= "<option value='".$result->id_group."' ".$selGroups.">".$result->name."</option>";
                }
                while ($result = mysqli_fetch_object($sql));
                                
                if (empty($obj->result["img"]))
                $img = core::I()->HOST()."/engine/images/other/noimage.png";

                $templ = new Qtemplate(admin."module/category/tpl/", "edit");
                
                $templ->assign_vars(array("location" => $PHP_SELF,
                                          "control-content" => core::I()->get_include_contents($control_content),
                                          "content-page" => core::I()->get_include_contents($page_load),
                                          "title" => isset($obj->result["title"]) ? $obj->result["title"] : "",
                                          "altname" => isset($obj->result["link"]) ? $obj->result["link"] : "",
                                          "h1" => isset($obj->result["h1"]) ? $obj->result["h1"] : "",
                                          "context" => isset($obj->result["content"]) ? $obj->result["content"] : "",
                                          "page-template" => $page_templ,
                                          "type-page" => $obj->result["type"],
                                          "list-groups" => $list_groups,
                                          "logo" => $img,
                                          "pagination" => $obj->result["num_row"],
                                          "description" => $obj->result["description"],
                                          "keywords" => $obj->result["keywords"],
                                          "seotitle" => $obj->result["seotitle"],
                                          "password" => $obj->result["password"],
                                          "groups" => $groups,
                                          "form-checked" => $form_checked,
                                          "visible" => $visible,
                                          "tree" => $tree_pages
                ));
                
                
                $content .= $templ->render();
                
            }
        }
    }
?>

