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

    private static function DBCONNECT(&$error = "") {
        try {
            self::$link = @mysqli_connect(self::DBConfig("HOST"), /* Адрес базы */ self::DBConfig("DBLOGIN"), /* Имя пользователя */ self::DBConfig("DBPASS"), /* Пароль от базы */ self::DBConfig("DBNAME")); /* Имя базы */

            if (!self::$link) {
                throw new Exception("Ошибка при подключении к базе данных&nbsp;" . self::DBConfig("DBNAME") . "<br />Возможно вы неверно указали сведения о базе данных в файле engine/mysql_DBConfig.ini");
            }

            self::$select_db = mysqli_select_db(self::$link, self::DBConfig("DBNAME"));

            if (!self::$select_db) {
                throw new Exception("Ошибка при выборе базы данных&nbsp;" . self::DBConfig("DBNAME"));
            }

            mysqli_set_charset(self::$link, "utf8");
        } catch (Exception $e) {
            die(self::MysqliCriticalError($e->getMessage(), $e->getFile(), $e->getLine()));
        }
    }

    /* Обработка критических ошибок
     *
     */

    private static function MysqliCriticalError($string, $file = "", $line_str = "") {

        if (@mkdir(ROOT_PATH . "/logs")) {

            $log_dir = ROOT_PATH . "/logs/err_logs.txt";

            if (!file_exists(ROOT_PATH . "/logs/err_logs.txt")) {
                $fp = fopen($log_dir, "w");
                $str = "Файл создан:\t" . date("d-m-Y") . "\n\n";
                fwrite($fp, $str);
                fwrite($fp, date("d-m-Y") . "\r\n" . "Ошибка:\t" . $string . "\r\n" . "Файл:\t" . $file . "\r\n" . "Строка:\t" . $line_str . "\r\n");
                fclose($fp);
            } else {
                $fp = fopen($log_dir, "a");
                fwrite($fp, date("d-m-Y") . "\r\n" . "Ошибка:\t" . $string . "\r\n" . "Файл:\t" . $file . "\r\n" . "Строка:\t" . $line_str . "\r\n");
                fclose($fp);
            }
        }

        echo core::GetSystemError("Произошла критическая ошибка при запросе к базе данных:&nbsp;" . $string);
    }

    /*
     * 301 редирект
     */

    public static function Redirect301($url) {
        header("HTTP/1.0 301 Moved Permanently");
        header("Location: {$url}");
    }

    /*
     * Собрать URL
     */

    public static function CombineUrl($module = "", $action = "", $param = array()) {
        $params = "";
        if (empty($module))
            $module = "main";
        if (empty($action))
            $module = "index";

        if (!empty($param)) {
            foreach ($param as $p => $value) {
                $params .= "&{$p}={$value}";
            }
        }

        $url = Model::SelectItems("url", array("url"), "p_id={$param["id"]}");


        if ($module == "main" && $action == "index") {
            return "/";
        } else {
            if ($url == true) {
                return "/{$url["url"]}";
            }  else {
                return $_SERVER["PHP_SELF"] . "?component={$module}&action={$action}{$params}";
            }

        }
    }

    /*
     * Собрать URL для admin
     */

    public static function CombineUrlByAdmin($module = "", $action = "", $params = array()) {
				$param = "";

        if (empty($module))
            $module = "main";
        if (empty($action))
            $module = "index";

        if (!empty($params)) {
            foreach ($params as $p => $value) {
                $param .= "&{$p}={$value}";
            }
        }

        if ($module == "main" && $action == "index") {
            return "/";
        } else {
            return $_SERVER["PHP_SELF"]."?component={$module}&action={$action}{$param}";
        }
    }

    /* Настройки сайта
     *
     */

    public static function DBConfig($pos = "") {
        self::$result = parse_ini_file(ROOT_PATH . "/engine/mysql_config.ini");
        return self::$result[$pos];
    }

    public static function Config($str = "") {
        $conf = self::SelectItems("config", array("config"), "id=1");
        if ($conf == true) {
            $deconf = unserialize($conf["config"]);
            if ((isset($str)) && (!empty($str))) {
                return @$deconf["params"]["{$str}"];
            } else {
                die("Передан пустой параметр __FILE__");
            }
        } else {
            self::MysqliCriticalError(mysqli_error(self::$link), __DIR__ . "/" . __FILE__, __LINE__);
        }
    }

    /* Строковой запрос
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

    /* Добавление в ДБ
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

		/*
		 * Удаление из ДБ
		 */

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