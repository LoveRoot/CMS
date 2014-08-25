<?php

    if ($_REQUEST["ajax"]) {
        require_once($_SERVER["DOCUMENT_ROOT"] . "/classes/routing.class.php");
        require_once($_SERVER["DOCUMENT_ROOT"] . "/classes/mysqliDB.class.php");
        $db = new DB();

        switch ($_POST["type"]) {
            case "sort":
                 $expl = explode(",", $_POST["data"]);

                 foreach ($expl as $sort => $item) {
                      $sql = mysqli_query($db->link, "Update ".$_POST["item"]." set sort='" . $sort . "' where id='" . $item . "'") or die(mysqli_error($db->link));
                 }
            break;
        }
    }
?>