<?php

	class Route {

		public static $module;
		public static $models;
		public static $action;
		public static $params;

		public static function I() {
			if (!(self::$instance instanceof self)) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		public static function ParseUrl($url) {
				// контроллер и действие по умолчанию
        $controller_name = 'main';
        $action_name = 'index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        // получаем имя контроллера
        if ( !empty($routes[1]) )
        {
            $controller_name = $routes[1];
        }

        // получаем имя экшена
        if ( !empty($routes[2]) )
        {
            $action_name = $routes[2];
        }

				if ( !empty($routes[3]) )
        {
            $_GET["id"] = $routes[3];
        }

        // добавляем префиксы
        $model_name = 'model_'.$controller_name;
        $controller_name = 'controller_'.$controller_name;
        $action_name = $action_name.'_action';

        // подцепляем файл с классом модели (файла модели может и не быть)

        $model_file = strtolower($model_name).'.php';
        $model_path = "models/".$model_file;
        if(file_exists($model_path))
        {
            include "models/".$model_file;
        }

        // подцепляем файл с классом контроллера
        $controller_file = strtolower($controller_name).'.php';
        $controller_path = "controllers/".$controller_file;
        if(file_exists($controller_path))
        {
            include "controllers/".$controller_file;
        }
        else
        {
						Route::ErrorPage404();
        }

        $controller = new $controller_name();
        $action = $action_name;

        if(method_exists($controller, $action))
        {
            $controller->$action();
        }
        else
        {
            Route::ErrorPage404();
        }

		}

		public static function ErrorPage404() {
			header("HTTP/1.0 404 Not Found");
			header("Location: /404/index/");
			die();
		}

		public static function GetParam($param) {
			return self::$$param;
		}

		private function __construct() {

		}

		private function __wakeup() {

		}

		private function __clone() {

		}

	}

?>