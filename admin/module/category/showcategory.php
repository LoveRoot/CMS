<?php
	if ($_GET["component"] == "pages" && !isset($_GET["model"]))
	{
            require_once(ROOT_PATH_LIBS."pagination.class.php");
            require_once(admin."/classes/category.class.php");

            $pages = new category();
            $catalog_tree = new AdminTree();

            $templ = new Qtemplate(admin."module/category/tpl/", "show");

            if (isset($_GET["delete"]))
            $pages->__delete(intval($_GET["delete"]));

            if (!empty($catalog_tree->category))
            {
                  $templ->assign_vars(array("pages" => $catalog_tree->__GetTree(0)));
            }
                else
            {
               $content = core::I()->GetTemplate("ShowAlert", array("ShowAlert" => "Элементы на странице не найдены.<br />Вы можете&nbsp;<a href=\"?a=category&c=add\">Создать новую страницу</a>",
                                                          "caption" => "<h1>К сожалению</h1>"));
            }

            $content .= $templ->render();
	}
?>

