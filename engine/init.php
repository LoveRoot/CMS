<?php
    date_default_timezone_set('Europe/Moscow');
    require_once("libs/pagination.class.php");
    echo Route::ParseUrl($_SERVER['REQUEST_URI']);
?>