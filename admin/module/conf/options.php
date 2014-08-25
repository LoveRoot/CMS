<?php
    $conf = new core();
    
    $general = $conf->get_include_contents($_SERVER["DOCUMENT_ROOT"] . "/admin/module/conf/general.php");
    $defend = $conf->get_include_contents($_SERVER["DOCUMENT_ROOT"] . "/admin/module/conf/defend.php");
    $module = $conf->get_include_contents($_SERVER["DOCUMENT_ROOT"] . "/admin/module/conf/module.php");
    $comments = $conf->get_include_contents($_SERVER["DOCUMENT_ROOT"] . "/admin/module/conf/comments.php");
    $events = $conf->get_include_contents($_SERVER["DOCUMENT_ROOT"] . "/admin/module/conf/events.php");
    $search = $conf->get_include_contents($_SERVER["DOCUMENT_ROOT"] . "/admin/module/conf/search.php");
    $slider = $conf->get_include_contents($_SERVER["DOCUMENT_ROOT"] . "/admin/module/conf/slider.php");
    $gallery = $conf->get_include_contents($_SERVER["DOCUMENT_ROOT"] . "/admin/module/conf/gallery.php");
    $downloader = $conf->get_include_contents($_SERVER["DOCUMENT_ROOT"] . "/admin/module/conf/downloader.php");
    $sql = $conf->get_include_contents($_SERVER["DOCUMENT_ROOT"] . "/admin/module/conf/sql.php");

    if ($_POST) 
    {
        if (empty($_POST["title"]))
            $conf->error($conf->message[] = "<li>Заголовок сайта не должен быть пустым</li>");
        
        if (!empty($_POST["email"])) {
             if (!preg_match("/^([-0-9a-z_])+@([a-z])+([.a-z])/i", $_POST["email"]))
                $this->error($this->message[] = "<li>Вы ввели не правильный формат почтового ящика</li>");
        }
        
        if (!intval($_POST["gallery_normal_w"]))
            $conf->error($conf->message[] = "<li>Неправильно задана минимальная ширина оригинального изображения в галереи</li>");
        if (!intval($_POST["gallery_normal_h"]))
            $conf->error($conf->message[] = "<li>Неправильно задана максимальная ширина оригинального изображения в галереи</li>");
        if (!intval($_POST["gallery_thumb_w"]))
            $conf->error($conf->message[] = "<li>Неправильно задана минимальная ширина миниатюрного изображения в галереи</li>");
        if (!intval($_POST["gallery_thumb_h"]))
            $conf->error($conf->message[] = "<li>Неправильно задана максимальная ширина миниатюрного изображения в галереи</li>");
        if (!intval($_POST["h_img_d"]))
            $conf->error($conf->message[] = "<li>Высота изображения при загрузке файлов на сервер должна быть числом</li>");
        if (!intval($_POST["w_img_d"]))
            $conf->error($conf->message[] = "<li>Ширина изображения при загрузке файлов на сервер должна быть числом</li>");
        if (!intval($_POST["comments_num_rows"]))
            $conf->error($conf->message[] = "<li>Кол-во комментариев на странице должно быть числом </li>");

        if (!empty($conf->message)) {
            $content = $conf->GetMessage("ShowAlert", array("caption" => "<h1>Произошла ошибка</h1>", "ShowAlert" => $conf->error()));
        } else {
            $config = fopen($_SERVER["DOCUMENT_ROOT"] . "/engine/config.ini", "w");

            foreach ($_POST as $f => $s) {
                $save = $f . "='" . $s . "'";

                $fsave = fwrite($config, $save . "\n");
            }

            fclose($config);
            setcookie("success", "Ваши параметры успешно сохранены...", time() + 1);
            header("Location: ".$_SERVER["HTTP_REFERER"]."");
        }
    }

    $tpl = new Qtemplate($_SERVER["DOCUMENT_ROOT"] . "/admin/module/conf/template/", "config");
    $tpl->assign_vars(array("general" => $general,
        "defend" => $defend,
        "module" => $module,
        "slider" => $slider,
        "gallery" => $gallery,
        "downloader" => $downloader,
        "comments" => $comments,
        "events" => $events,
        "event" => $event,
        "sql" => $sql
        )
    );
    echo $content .= $tpl->render();
?>


