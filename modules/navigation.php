<?php
   $obj = core::GetFactory("controllers/","controller_navigation");
   $obj->index_action("",Route::$params["param"]["id"]);
?>

