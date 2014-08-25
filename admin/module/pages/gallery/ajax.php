<?php
    if ((isset($_POST["ajaxSubmit"])) && (!empty($_POST["content"]))) {

        include($_SERVER["DOCUMENT_ROOT"] . "/classes/routing.class.php");
        include($_SERVER["DOCUMENT_ROOT"] . "/classes/mysqliDB.class.php");
        include($_SERVER["DOCUMENT_ROOT"] . "/classes/core.class.php");
        include($_SERVER["DOCUMENT_ROOT"] . "/admin/classes/paginationAjax.class.php");
        include($_SERVER["DOCUMENT_ROOT"] . "/admin/classes/gallery.class.php");
        include($_SERVER["DOCUMENT_ROOT"] . "/admin/classes/download.class.php");

        $core = new core();

        $ajaxQuery = new Gallery();

        switch ($_POST["ajaxSubmit"]) {
            case "create_collection":
                $ajaxQuery = new Collection();
                $ajaxQuery->__CreateCollection($_POST["content"], intval($_POST["id"]), intval($_POST["p_coll"]));
            break;

            case "delete_collection":
                $ajaxQuery = new Collection();
                $ajaxQuery->__DeleteCollection($_POST["content"], 1);
            break;

            case "show_gallery":
                $ajaxQuery = new Images();
                $ajaxQuery->__GetImages($_POST["content"]);
            break;

            case "upload_gallery":

                $ajaxQuery = new MultipleDownload($_SERVER["DOCUMENT_ROOT"]."/upload/images/collection/".$_POST["content"],
                                                  $core::HOST()."/upload/images/collection/".$_POST["content"],
                                                  array("thumb" =>  $core->__config("gallery_thumb_w"), "normal" =>  $core->__config("gallery_normal_w")),
                                                  true);

            break;

            case "upload_collection_logo":
                $ajaxQuery = new DownloadLogo($_SERVER["DOCUMENT_ROOT"]."/upload/pages", $height = 180, $_POST["content"]);
            break;

            case "delete_image":
                $ajaxQuery = new Images();
                $ajaxQuery->__DeleteImage($_POST["content"], $_POST["callback"]);
            break;

            case "delete_logo":
                if(unlink($_POST["content"]))
                echo "Удалено...";
            break;

            case "save_gallery":
                $ajaxQuery = new SaveGallery($_POST["content"], $_POST["content2"], $_POST["content3"], $_POST["col"]);
            break;
        }
    }
?>