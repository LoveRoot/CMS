<?php
		ob_start();
		error_reporting(E_ALL);
		require_once("classes/core.class.php");
		require_once("classes/model.class.php");
		require_once("admin/classes/controller.class.php");
		require_once("admin/classes/view.class.php");
		require_once("admin/classes/route.class.php");

		$model = Model::I();

		require_once("admin/engine/init.php");
		ob_get_contents();
?>
