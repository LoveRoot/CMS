<?php
    ob_start();
    ini_set("memory_limit", "200M");
    session_start();
    
    define("admin", "admin/");
    define("ROOT_PATH_CLASS", "classes/");
    define("ROOT_PATH_ENGINE", "engine/");
    define("ROOT_PATH_LIBS", "libs/");
    define("ROOT_PATH_MODULE", "module/");
    define("ROOT_PATH_TEMPLATE", "template/");
    define("ROOT_PATH_UPLOAD", "upload/");
    
    require_once(ROOT_PATH_CLASS."core.class.php");
    
    require_once(ROOT_PATH_LIBS."htmlentities.class.php");
    require_once(ROOT_PATH_CLASS."model.class.php");
    require_once(admin."classes/secure_panel.class.php");
    require_once(ROOT_PATH_LIBS."phpQuery/phpQuery.php");
    require_once(ROOT_PATH_LIBS."tree.class.php");

    $tpl = admin."template/";
    $template = admin."template/";
    $style = admin."template/style/";
        
    if (isset($_COOKIE["success"]))
    $message = core::I()->GetTemplate("SystemMessage", array("message" => $_COOKIE["success"]));
    
    require_once(admin."module/login.php");

    if ($login->status == 1) {
        require_once(admin."module/engine.php");
        require_once(admin."engine/module.php");
        require_once(admin."engine/tabs.php");
        
        $tpl_main = new Qtemplate($template, "index");
    } else {
        $tpl_main = new Qtemplate($template, "autorize");
    }
    
    $tpl_main->assign_vars(array(
            "title" => isset($title) ? $title : "Панель управления сайтом Root_CMS",
            "autorize" => isset($autorize) ? $autorize : "",
            "template" => $tpl,
            "style" => $style,
            "tabs" => isset($tabs) ? $tabs : "",
            "content" => isset($content) ? $content : "",
            "message" => !empty($message) ? $message : "",
            "charset" => isset($conf->charset) ? $conf->charset : "",
            "stats" => isset($stats) ? $stats : "",
            "module" => $widgets,
            "lastcomments" => isset($lastcomments) ? $lastcomments : ""
        ));

    echo $tpl_main->render();
?>
