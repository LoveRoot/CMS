<?php

if (isset($_REQUEST["ajaxSubmit"])) {
    require_once($_SERVER["DOCUMENT_ROOT"] . "/classes/core.class.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/classes/mysqliDB.class.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/classes/mailing.class.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/libs/phpQuery/phpQuery.php");
    require_once ($_SERVER["DOCUMENT_ROOT"] . "/libs/pagination.class.php");

    $m_usr = new MailingUsers();
    $gr = new MailingGroups();

    switch ($_REQUEST["ajaxSubmit"]) {
        case "create_catalog":
            $gr->AddGroup($_POST["content"]);
        break;

        case "regroup":
            $m_usr->UsersMove(intval($_POST["group"]), intval($_POST["item"]));
        break;

        case "view_catalog":
            $m_usr->ViewCatalog(intval($_POST["content"]));
        break;

        case "remove_catalog":
            $gr->RemoveCatalog(intval($_POST["content"]));
        break;

        case "mailing_submited":
            require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/module/mailing/mailing_submited.php");
        break;
    }
}
?>