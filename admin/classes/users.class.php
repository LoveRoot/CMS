<?php

    class Users extends core {

        public function __construct() {
            parent::__construct();
        }

        public function Validation($data = "") {
            if (!preg_match("/^([А-яа-яa-z0-9]){4,20}/i", $data["adm_login"]))
               $this->error($this->message[] = "<li>Поле логин должен быть заполнено от 4 до 12 символов. Разрешённые символы (a-z а-я 0-9)</li>");
            if (!preg_match("/^([А-яа-яa-z0-9]){6,12}/i", $data["adm_password"]))
               $this->error($this->message[] = "<li>Поле пароль обязателен к заполнению от 6 до 12 символов. Разрешённые символы (a-z а-я 0-9)</li>");
            
            if ($data["adm_password"] !== $data["adm_repeat_password"]) {
               $this->error($this->message[] = "<li>К сожалению ваш пароль непрошёл на подтверждение</li>");
            }
            
            if (empty($data["adm_email"])) {
                $this->error($this->message[] = "<li>Поле Почтовый ящик обязателен к заполнению</li>");
            }
            
            if (empty($this->message)) {
                return $valid = 1;
            } else {
                return $valid = 0;
            }
            
        }

    }

    class UsrList extends users {

        public function __construct() {
            parent::__construct();
        }

        public function GetUserList() {
            $this->usr_array = new paginationAjax("SELECT id, login, status FROM users", 
                                                  "SELECT id FROM users");
            return $this->usr_array;
        }

    }

    class UsrAdd extends users {

        public function __construct() {
            parent::__construct();

            if (isset($_POST["f_submit"])) {
                $valid = $this->Validation($_POST);

                if ($valid == 1) {
                    $this->UsrAdd($_POST);
                } else {
                   echo $this->GetMessageError($this->error());
                }
            }
        }

        private function UsrAdd($data) {
            
            $salt = uniqid(rand());
            
            $char = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            
            $genCode = SHA1(str_shuffle($char));

            $password = crypt($data["adm_password"], $salt);
            
            $insert_key = DB::I()->__InsertItems("users", array(
                                                         "login" => $data["adm_login"],
                                                         "password" => $password,
                                                         "email" => $data["adm_email"],
                                                         "groups" => $data["group"],
                                                         "is_reg" => time(),
                                                         "security" => $salt,
                                                         "salt" => $genCode,
                                                         "status" => 1
                                                      ));
            $sql = DB::I()->__InsertItems("user_properties", array(
                                                                    "name" => $data["adm_name"],
                                                                    "patronymic" => $data["adm_old_name"],
                                                                    "lastname" => $data["adm_family"],
                                                                    "city" => "",
                                                                    "country" => "",
                                                                    "phone" => $data["adm_phone"],
                                                                    "description" => $data["adm_usr_info"],
                                                                    "p_id" => $insert_key
                                                                  ));
        }

    }

    class UsrEdit extends users {

        public function __construct() {
            parent::__construct();
        }

    }

    class SearchUsers extends users {

        public $where;

        public function __construct($type = "", $data = "") {
            switch ($type) {
                case "high_search":
                    return $this->HighSearch($data);
                break;
                default:
                    return $this->LowSearch($data);
            }
        }

        public function HighSearch($data = "") {
            switch ($data["var"]) {
                case "login":
                    $this->where = "login LIKE '%{$data["data"]}%'";
                break;

                case "active":
                    $this->where = "status=1";
                break;

                case "no_active":
                    $this->where = "status=0";
                break;

                case "email":
                    $this->where = "email LIKE '%{$data["data"]}%'";
                break;

                default:
            }

            $this->usr = new paginationAjax("Select * From users WHERE {$this->where}", "Select id From users WHERE {$this->where}')");
        }

        public function LowSearch($data = "") {

            switch ($data["type"]) {
                case "fulltext":
                    $this->where = "login LIKE '%{$data["forname"]}%'";
                    break;
                default:
                    $this->where = "login='{$data["forname"]}'";
            }

            $this->usr = new paginationAjax("Select * From users WHERE {$this->where}", "Select id From users WHERE {$this->where}')");
        }

    }

?>