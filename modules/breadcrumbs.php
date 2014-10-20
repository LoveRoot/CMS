<?php
   $obj = core::GetFactory("controllers/","controller_breadcrumbs");
   $obj->index_action(Route::$params['param']['id']);
?>
