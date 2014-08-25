<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/classes/routing.class.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/classes/mysqliDB.class.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/classes/core.class.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/classes/winProp.class.php");

    $root = $_SERVER["DOCUMENT_ROOT"];

    if ($_GET["saveWinProp"])
    {
        if (isset($_GET["status"])) 
        $status = 1;
        else
        $status = 0;

        switch ($_GET["saveWinProp"]) {
            case "pages":
                $saveProp = new SaveWinPropPages($_GET["id"], $_GET["title"], $_GET["url"], $status);
            break;

            case "slider":
                $saveProp = new SaveWinPropSlider($_GET["id"], $_GET["title"], "", $status);
                break;

            case "article":
                 $saveProp = new SaveWinPropArticle($_GET["id"], $_GET["title"], $_GET["url"], $status);
            break;

            case "static_page":
                $saveProp = new SaveWinPropStatic_page($_GET["id"], $_GET["title"], $_GET["url"], $status);
            break;

            case "faq":
                $saveProp = new SaveWinPropFaq($_GET["id"], $_GET["title"], "", $status);
            break;

            case "gallery":
                $saveProp = new SaveWinPropGallery($_GET["id"], $_GET["title"], $_GET["url"], $status);
            break;
        }
    }

    switch ($_GET["type"])
		{
        case "pages":
            $prop = new winProperty("Select id, title, link, status From pages where id='".intval($_GET["id"])."'");

            if ($prop->result["status"] == 1)
                $status = "checked";

            $templ = new Qtemplate($_SERVER["DOCUMENT_ROOT"] . "/admin/template/winProperty/", "pages");

            $templ->assign_vars(array(
                "id" => $prop->result["id"],
                "title" => $prop->result["title"],
                "url" => $prop->result["link"],
                "status" => $status
            ));
            echo $templ->render();
        break;

        case "article":
            $prop = new winProperty("Select id, title, status, rewrite_url From article where id='".intval($_GET["id"])."'");

            if ($prop->result["status"] == 1)
                $status = "checked";

            $templ = new Qtemplate($_SERVER["DOCUMENT_ROOT"] . "/admin/template/winProperty/", "post");

            $templ->assign_vars(array(
                "id" => $prop->result["id"],
                "title" => $prop->result["title"],
                "url" => $prop->result["rewrite_url"],
                "status" => $status
            ));
            echo $templ->render();
        break;

        case "slider":
            $prop = new winProperty("Select id, name, status From slidercollection where id='" . intval($_GET["id"]) . "'");

            if ($prop->result["status"] == 1)
                $status = "checked";

            $templ = new Qtemplate($_SERVER["DOCUMENT_ROOT"] . "/admin/template/winProperty/", "slider");

            $templ->assign_vars(array(
                "id" => $prop->result["id"],
                "title" => $prop->result["name"],
                "status" => $status
            ));
            echo $templ->render();
        break;

        case "static_page":
            $prop = new winProperty("Select id, title, status, rewrite_url From static_page where id='" . intval($_GET["id"]) . "'");

            if ($prop->result["status"] == 1)
            $status = "checked";

            $templ = new Qtemplate($_SERVER["DOCUMENT_ROOT"] . "/admin/template/winProperty/", "static_page");

            $templ->assign_vars(array(
                "id" => $prop->result["id"],
                "title" => $prop->result["title"],
                "url" => $prop->result["rewrite_url"],
                "status" => $status
            ));

            echo $templ->render();
        break;

        case "faq":
            $prop = new winProperty("Select id, title, status From faq where id='".intval($_GET["id"])."'");

            if ($prop->result["status"] == 1)
            $status = "checked";

            $templ = new Qtemplate($_SERVER["DOCUMENT_ROOT"] . "/admin/template/winProperty/", "faq");

            $templ->assign_vars(array(
                "id" => $prop->result["id"],
                "title" => $prop->result["title"],
                "status" => $status
            ));
            echo $templ->render();
        break;

        case "gallery":
            $prop = new winProperty("Select id, name, link, status From collection where id='".intval($_GET["id"])."'");

            if ($prop->result["status"] == 1)
            $status = "checked";

            $templ = new Qtemplate($_SERVER["DOCUMENT_ROOT"] . "/admin/template/winProperty/", "gallery");


            if (file_exists($_SERVER["DOCUMENT_ROOT"]."/upload/pages/logo/".$prop->result["id"]."/logo.jpg"))
            $logo = "<img src=\"http://".$_SERVER["HTTP_HOST"]."/upload/pages/logo/".$prop->result["id"]."/logo.jpg\" />
                     <div><a onclick=\"__DeleteLogo('$root/upload/pages/logo/".$prop->result["id"]."/logo.jpg')\" href=\"javascript:\">Удалить</a></div>";
            else
            $logo = '';

            $templ->assign_vars(array(
                "id" => $prop->result["id"],
                "logo" => $logo,
                "title" => $prop->result["name"],
                "url" => $prop->result["link"],
                "status" => $status
            ));
            echo $templ->render();
        break;

        default:
}
?>