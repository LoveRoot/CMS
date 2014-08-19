<?php
		
    if ($_SERVER['REQUEST_URI'] != '/') {
        Route::ParseUrl($_SERVER['REQUEST_URI']);

        $controller = "controller_".Route::GetParam("module");
				$models = "model_".Route::GetParam("module");
        $action = Route::GetParam("action")."_action";
        $params = Route::GetParam("params");

        $obj = core::GetFactory("controllers/",$controller);
				$model = core::GetFactory("models/",$models);
        $obj->$action();

        if (isset($obj->title) && !empty($obj->title))
        $title = $obj->title;
        if (isset($obj->description) && !empty($obj->description))
        $description = $obj->description;
        if (isset($obj->keywords) && !empty($obj->keywords))
        $keywords = $obj->keywords;
    } else {
        $obj = core::GetFactory("controllers/","controller_main");
        $obj->index_action();
    }

?>