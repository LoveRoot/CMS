<?php

    require_once($_SERVER["DOCUMENT_ROOT"] . "/classes/core.class.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/classes/mysqliDB.class.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/libs/paginationAjax.class.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/libs/htmlentities.class.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/classes/users.class.php");

    $html = new html();

    switch ($_GET["ajaxSubmit"])
    {
        case "high_search":
            $search = new SearchUsers("high_search", $_GET);
        break;

        default:
            $search = new SearchUsers("low_search", $_GET);
    }

    $content = "<h1 class='inline'>Результаты поиска</h1>";

    if ($search->usr->result == true)
    {

        do
        {
            $content .= "<li>".$html->link($search->usr->result["login"], array("href" => "javascript:;",
                                                                                  "class" => "options",
                                                                                  "onclick" => "open_window_property()",
                                                                                  "edition" => "?component=users&model=edit&edit=".$search->usr->result["id"],
                                                                                  "delete" => "?component=users&model=delete&delete=".$search->usr->result["id"],
                                                                                  "values" => $search->usr->result["login"]
                                            ))."</li>";
        } while ($search->usr->result = mysqli_fetch_assoc($search->usr->query));
    } else
    {
        $content .= "К сожалению мы не смоги от искать пользователей согласно вашему запросу.";
    }

    echo $content;
?>