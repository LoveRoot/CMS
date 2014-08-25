<?php

    require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/classes/module.class.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/classes/core.class.php");

    $moduleNav = new moduleList();

    $templ = new Qtemplate($_SERVER["DOCUMENT_ROOT"] . "/admin/template/", "module");
    $templ->assign_vars(array("template" => $tpl,
                              "options" => isset($moduleNav->options) ? $moduleNav->options : "",
                              "pages" => isset($moduleNav->pages) ? $moduleNav->pages : "",
                              "mailing" => isset($moduleNav->mailing) ? $moduleNav->mailing : "",
                              "gallery" => isset($moduleNav->gallery) ? $moduleNav->gallery : "",
                              "slider" => isset($moduleNav->slider) ? $moduleNav->slider : "",
                              "users" => isset($moduleNav->users) ? $moduleNav->users : "",
                              "users-group" => isset($moduleNav->permissions) ? $moduleNav->permissions : "",
                              "email-send" => isset($moduleNav->email_send) ? $moduleNav->email_send : "",
                              "application" => isset($moduleNav->application) ? $moduleNav->application : "",
                              "stats" => isset($moduleNav->stats) ? $moduleNav->stats : "",
                              "events" => isset($moduleNav->events) ? $moduleNav->events : "",
    ));
    $widgets = $templ->render();
?>