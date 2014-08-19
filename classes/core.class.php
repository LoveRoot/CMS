<?php

class core {

    private static $instance;

    public static function I() {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function GetFactory($path="", $file="") {
        if (file_exists($path."{$file}.php")) {
            include $path."{$file}.php";
            $object = new $file();
            return $object;
        } else {

					die("Файл {$file} не найден в директории {$path}");
        }
    }

		/*
		 * Подгрузка контента
		 */


    public static function GetIncludeContents($filename="") {
        if(file_exists($filename)) {
            ob_start();
            include $filename;
            $contents = ob_get_contents();
            ob_end_clean();
            return $contents;
        } else {
            return "Шаблон не найден {$filename}";
        }
    }

		public static function Vanish($string="") {
       return addslashes(htmlspecialchars($string));
    }

		/*
		 * debug
		 */

    public static function PrintPre($str) {
        echo "<pre>";
            var_dump($str);
        echo "</pre>";
    }

		/*
		 * Настройки сайта
		 */

    public static function Config($str) {
        $ini = parse_ini_file($_SERVER["DOCUMENT_ROOT"] . "/engine/config.ini");
        return $ini[$str];
    }

    private function __construct() {

    }

    private function __wakeup() {

    }

    private function __clone() {

    }

}

?>