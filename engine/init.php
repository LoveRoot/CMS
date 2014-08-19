<?php

    if ($_SERVER['REQUEST_URI'] != '/') {
				if (isset($_GET)) {

					 if (!empty($_GET["module"]) && !empty($_GET["action"])) {
						  Route::ParseUrl($_SERVER['REQUEST_URI']);
							$controller = "controller_".Route::GetParam("module");
							$models = "model_".Route::GetParam("module");
							$action = Route::GetParam("action")."_action";
							$params = Route::GetParam("params");

							$obj = core::GetFactory("controllers/",$controller);
							$model = core::GetFactory("models/",$models);
							$obj->$action();
					 }
				}

    }

		$obj = core::GetFactory("controllers/","controller_main");
        $obj->index_action();

?>