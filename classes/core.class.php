<?php

    class core
    {
        private static $instance;

        public static function I()
        {
            if (!(self::$instance instanceof self))
            {
                self::$instance = new self();
            }
            return self::$instance;
        }

        public static function GetFactory($path = "", $file = "")
        {
            if (file_exists($path . "{$file}.php"))
            {
                include $path . "{$file}.php";
                $object = new $file();
                return $object;
            } else
            {
                die("Файл {$file} не найден в директории {$path}");
            }
        }

        /*
         * Подгрузка контента
         */

        public static function GetIncludeContents($filename = "")
        {
            if (file_exists($filename))
            {
                ob_start();
                include $filename;
                $contents = ob_get_contents();
                ob_end_clean();
                return $contents;
            } else
            {
                return "Шаблон не найден {$filename}";
            }
        }

        /*
         * Системное сообщение об ошибке
         */

        public static function GetSystemError($string, $cookie = 0)
        {
						if ($cookie == 0) {
							 echo "<section id='system_message_error'><span>{$string}</span><span id='close'><a href=javascript:close('#system_message_error')>X</a></span></section>";
						}	else {
							setcookie("message", $string, time() + 1);
						}
        }

				/*
				 * Загрузка JS скриптов
				 */

				public static function AddFileScriptJs($src="") {
					$script = "<script type='text/javascript' src='{$src}'></script>";
					echo $script."\n";
				}

        /*
         * Очистка входных данных типа string
         */

        public static function Vanish($string = "")
        {
            return addslashes(htmlspecialchars($string));
        }

        /*
         * debug
         */

        public static function PrintPre($str)
        {
            echo "<pre>";
            var_dump($str);
            echo "</pre>";
        }

        /*
         * Настройки сайта
         */

				public static function Config($string) {
						$config = Model::Config($string);
						return $config;
				}

				public static function ParseUrl($url="") {
					$path = parse_url($url);
					return $path['path'];
				}

				/* Рассириализация */

				public static function UnSerialize($string) {
					return unserialize($string);
				}



        private function __construct()
        {

        }

        private function __wakeup()
        {

        }

        private function __clone()
        {

        }

    }

?>