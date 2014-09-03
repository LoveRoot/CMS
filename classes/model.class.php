<?php
    class Model {

        public static $link;
        public static $select_db;
        public static $result;
        public static $query;
        private static $instance;

        private function __construct() {
            self::DBCONNECT();
        }

        public static function I() {
            if (!(self::$instance instanceof self)) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        private static function DBCONNECT(&$error="") {
						try {
							self::$link = @mysqli_connect(self::Config("HOST"), /* Адрес базы */ self::Config("DBLOGIN"), /* Имя пользователя */ self::Config("DBPASS"), /* Пароль от базы */ self::Config("DBNAME")); /* Имя базы */

            if (!self::$link) {
								throw new Exception("Ошибка при подключении к базе данных&nbsp;".self::Config("DBNAME")."<br />Возможно вы неверно указали сведения о базе данных в файле engine/mysql_config.ini");
						}

            self::$select_db = mysqli_select_db(self::$link, self::Config("DBNAME"));

            if (!self::$select_db) {
							throw new Exception("Ошибка при выборе базы данных&nbsp;".self::Config("DBNAME"));
						}

            mysqli_set_charset(self::$link, "utf8");
						} catch (Exception $e) {
								die(self::MysqliCriticalError($e->getMessage(),$e->getFile(),$e->getLine()));
						}

        }

        /* Обработка критических ошибок
         *
         */

        private static function MysqliCriticalError($string, $file = "", $line_str = "") {

            if (@mkdir($_SERVER["DOCUMENT_ROOT"] . "/logs")) {

                $log_dir = $_SERVER["DOCUMENT_ROOT"] . "/logs/err_logs.txt";

                if (!file_exists($_SERVER["DOCUMENT_ROOT"] . "/logs/err_logs.txt")) {
                    $fp = fopen($log_dir, "w");
                    $str = "Файл создан:\t" . date("d-m-Y") . "\n\n";
                    fwrite($fp, $str);
                    fwrite($fp, date("d-m-Y") . "\n" . "Ошибка:\t" . $string . "\n" . "Файл:\t" . $file . "\n" . "Строка:\t" . $line_str . "\n\n");
                    fclose($fp);
                } else {
                    $fp = fopen($log_dir, "a");
                    fwrite($fp, date("d-m-Y") . "\n" . "Ошибка:\t" . $string . "\n" . "Файл:\t" . $file . "\n" . "Строка:\t" . $line_str . "\n\n");
                    fclose($fp);
                }
            }

            core::GetSystemError("Произошла критическая ошибка при запросе к базе данных:&nbsp;".$string);
        }

				/*
				 * Собрать URL
				 */

				public static function CombineUrl($module="",$action="", $param = array()) {
					if (empty($module))
						$module = "main";
					if (empty($action))
						$module = "index";

					if($module == "main" && $action == "index") {
						return "/";
					}	else {
						return "/{$module}/{$action}/{$param['id']}";
					}

				}

        /* Настройки сайта
         *
         */

        public static function Config($pos = "") {
            self::$result = parse_ini_file($_SERVER["DOCUMENT_ROOT"]."/engine/mysql_config.ini");
            return self::$result[$pos];
        }

        /* Простой запрос на выборку из базы
         *
         */

        public static function QueryString($query) {
            self::$query = mysqli_query(self::$link, $query);

            if (self::$query == true && !mysqli_error(self::$link)) {
                return self::$result = mysqli_fetch_assoc(self::$query);
            } else {
                self::MysqliCriticalError(mysqli_error(self::$link), __DIR__ . "/" . __FILE__, __LINE__);
            }
        }

        /* Добавление в базу данных
         *
         */

        public static function InsertItems($table, $params) {
            $rows = "";
            $values = "";

            foreach ($params as $row => $val) {
                $rows .= $row . ",";
                $row = substr($rows, 0, -1);

                $values .= "'$val'" . ",";
                $val = substr($values, 0, -1);
            }

            self::$query = mysqli_query(self::$link, "Insert Into $table(" . $row . ")
                                                         Values(" . $val . ")");

            if (self::$query == false) {
                self::MysqliCriticalError(mysqli_error(self::$link), __DIR__ . "/" . __FILE__, __LINE__);
            } else {
                return mysqli_insert_id(self::$link);
            }
        }

        /* Выборка из базы данных
         *
         */

        public static function SelectItems($table, $params, $where = "") {
            $rows = "";

            if (!empty($where))
                $where = "where " . $where;
            else
                $where = "";

            foreach ($params as $row) {
                $rows .= $row . ",";
                $row = substr($rows, 0, -1);
            }

            self::$query = mysqli_query(self::$link, "Select {$row} From {$table} {$where}");

            if (self::$query == true)
                return self::$result = mysqli_fetch_assoc(self::$query);
            else
                return 0;

            if (self::$query == false) {
                self::MysqliCriticalError(mysqli_error(self::$link), __DIR__ . "/" . __FILE__, __LINE__);
            }
        }

        public function DeleteItem($table, $where) {
            self::$query = mysqli_query(self::$link, "DELETE FROM {$table} WHERE {$where}");

            return self::$query;

            if (self::$query == false) {
                self::MysqliCriticalError(mysqli_error(self::$link), __DIR__ . "/" . __FILE__, __LINE__);
            }
        }

        /* Обновление базы данных
         *
         */

        public static function UpdateItem($table, $where, $params) {
            $rows = "";

            foreach ($params as $row => $val) {

                $rows .= $row . "='" . $val . "',";
                $row = substr($rows, 0, -1);
            }

            return self::$query = mysqli_query(self::$link, "Update $table set $row where $where");

            if (self::$query == false) {
                self::MysqliCriticalError(mysqli_error(self::$link), __DIR__ . "/" . __FILE__, __LINE__);
            }
        }

        private function destruct() {
            mysqli_free_result(self::$query);
            mysqli_close(self::$link);
        }

    }

?>