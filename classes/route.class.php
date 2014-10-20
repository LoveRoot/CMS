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

        $url_path = parse_url($_SERVER['REQUEST_URI']);

        if (isset($url_path["query"])) {
            $routes = explode('&', trim($url_path["query"], '&'));
            $route = array();
            if (is_array($routes) && empty($routes[0])) {
                unset($routes[0]);
            }
            
            if (!empty($routes)) {
                foreach ($routes as $url) {
                    $expl = explode("=", $url);
                    $route[$expl[0]] = $expl[1];
                }
                
                if (count($route) > 3) {
                    Route::ErrorPage404();
                }

                // получаем имя контроллера
                if (!empty($route["component"])) {
                    $controller_name = $route["component"];
                }

                // получаем имя экшена
                if (!empty($route["action"])) {
                    $action_name = $route["action"];
                }

                if (!empty($expl[0]) && count($route) > 2) {
                    self::$params["param"] = isset($_REQUEST) ? $_REQUEST : "";
                } else {
                    self::$params["param"] = array();
                }
            }
        } else {
            $expl = explode("/", $url_path["path"]);
            $getParam = Model::SelectItems("url", array("module,action,p_id"),"url='{$expl[1]}'");
            if ($getParam == true) {
                $controller_name = $getParam["module"];
                $action_name = $getParam["action"];
                self::$params["param"]["id"] = $getParam["p_id"];
            } else {
                if ($getParam == false && $_SERVER["REQUEST_URI"] !== "/") {
                    Route::ErrorPage404();
                }
            }
        }

        $model_name = 'model_' . $controller_name;
        $controller_name = 'controller_' . $controller_name;
        $action_name = $action_name . '_action';

        $model_file = strtolower($model_name) . '.php';
        $model_path = "models/" . $model_file;
        if (file_exists($model_path)) {
            include "models/" . $model_file;
        }

        $controller_file = strtolower($controller_name) . '.php';
        $controller_path = "controllers/" . $controller_file;
        if (file_exists($controller_path)) {
            include "controllers/" . $controller_file;
        } else {
           Route::ErrorPage404();
        }

        $controller = new $controller_name();
        $action = $action_name;

        if (method_exists($controller, $action)) {
            @$controller->$action($data = array(), self::$params["param"]);
        } else {
            Route::ErrorPage404();
        }
    }

    public static function ErrorPage404() {
        header("HTTP/1.0 404 Not Found");
        header("Location: /?component=404&action=index");
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