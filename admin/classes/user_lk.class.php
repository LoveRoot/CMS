<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/classes/core.class.php");

class user_lk extends core {

    public $access = 1, $error;

    public function __construct() {
        parent::__construct();
        
        $this->__SelectItems("users", array("login","email", "avatar", "real_name", 
                                            "city", "country", "other", "security"), "login='" . $this->route[1] . "' and security = '" . $_COOKIE["session"] . "'");

        if ($this->result == false) {
            $this->access = 0;
            return $this->error = $this->GetTemplate("ShowAlert", array("caption" =>"<h1>К сожалению</h1>" ,"ShowAlert" => "У вас нет доступа к этой странице !"));
        }
    }

    public function data_profile() {
        
    }

    public function avatar() {
        
    }

    public function advanced() {
        
    }

}

?>