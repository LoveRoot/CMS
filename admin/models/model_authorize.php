<?php

class model_authorize extends Model {

    public function __construct() {
        
    }

    public function Security($arr) {

        if ($_SERVER["REQUEST_URI"] == "/admin.php") {
            if (empty($arr)) {
                $this->Logout();
            }
        } else {
            if (isset($arr["admin"][$_GET["component"]]) && $arr["admin"][$_GET["component"]]["status"] !== "on") {
                
                $this->Logout();
            }
        }
    }

    public function UsrBanned() {
        core::GetSystemError("Данный пользователь был заблокирован администратором сайта");
    }

    public function AuthorizeFailed() {
        core::GetSystemError("Неверная пара логин или пароль");
    }

    public function Logout() {
        setcookie("user", $usr["login"], time() - 15001, "/");
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

    public function AuthorizeSuccess($usr) {
        setcookie("user", $usr["login"], time() + 15000, "/");
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

    public function Authorize($login = "", $password = "") {
        $salt = Model::SelectItems("users", array("salt"), "login='" . $login . "'");
        $hash = crypt($_POST["password"], $salt["salt"]);

        $result = Model::SelectItems("users", array("*"), "login='{$login}' and password='{$hash}'");

        if ($result == true) {
            if ($result["status"] == 1) {
                $this->AuthorizeSuccess($result);
            } else {
                $this->UsrBanned($result);
            }
        } else {
            $this->AuthorizeFailed($result);
        }
    }

    public function WhoIsUser($usr) {
        $result = Model::QueryString("SELECT groups.name, groups.permissions, users.login FROM users, groups
                                      where groups.id = users.groups and users.login='" . core::Vanish($usr) . "'");
        if ($result == true) {
            return $result;
        } else {
            return null;
        }
    }

}
?>

