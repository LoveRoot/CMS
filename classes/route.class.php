<?php

class Route {

    public static $module;
    public static $action;
    public static $params;

    public static function I() {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function ParseUrl($url) {

        try {
            $array = array();
            $url = parse_url($url);

            if ($url["path"] == "/") {
                $explode_url = explode("&", $url["query"]);
                foreach($explode_url as $i => $query) {
                    $list = list($module, $action) = explode("=", $explode_url[$i]);
                    $array[$list[0]] = $list[1];
                }

                if (count($list) > 1) {
                    if (count($explode_url) > 3) {
                        throw new Exception();
                    }

                    self::$module = $array["module"];
                    self::$action = $array["action"];
                }
            }
                else {

            }

        } catch (Exception $e) {
						header("HTTP/1.0 404 Not Found");
						self::$module = "404";
						self::$action = "index";
        }
    }

		public static function PageNotFound() {
				header("HTTP/1.0 404 Not Found");
				header("Location: /?module=404&action=index");
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