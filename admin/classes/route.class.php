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
            $controller_name = 'main';
            $action_name = 'index';
						
            $routes = explode('&', $_SERVER["QUERY_STRING"]);
            $route = array();

						if (in_array("", $routes))
						unset($routes);

            if (!empty($routes)) {
                foreach ($routes as $url) {
                    $expl = explode("=", $url);
                    $route[] = $expl[1];
                }

                // получаем имя контроллера
                if (!empty($route[0])) {
                    $controller_name = $route[0];
                }

                // получаем имя экшена
                if (!empty($route[1])) {
                    $action_name = $route[1];
                }

                if (!empty($route[2])) {
                    $_GET["id"] = $route[2];
                }
            }

            $model_name = 'model_' . $controller_name;
            $controller_name = 'controller_' . $controller_name;
            $action_name = $action_name . '_action';

            $model_file = strtolower($model_name) . '.php';
            $model_path = "admin/models/" . $model_file;
            if (file_exists($model_path)) {
                include "admin/models/" . $model_file;
            }

            $controller_file = strtolower($controller_name) . '.php';
            $controller_path = "admin/controllers/" . $controller_file;
            if (file_exists($controller_path)) {
                include "admin/controllers/" . $controller_file;
            } else {
                Route::ErrorPage404();
            }

            $controller = new $controller_name();
            $action = $action_name;

            if (method_exists($controller, $action)) {
                $controller->$action();
            } else {
                Route::ErrorPage404();
            }
        }

        public static function ErrorPage404() {
            header("HTTP/1.0 404 Not Found");
            header("Location: /admin.php?component=404&action=index");
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
