<?php
    class model_authorize extends Model {
        public function __construct() {

        }

				public function UsrBanned() {
					echo "Данный пользователь был заблокирован администратором сайта";
				}

				public function AuthorizeFailed() {
					echo "Неверная пара логин или пароль";
				}

				public function Logout() {
					setcookie("user", $usr["login"], time() - 15001,"/");
					header("Location: ".$_SERVER["HTTP_REFERER"]);
				}

				public function AuthorizeSuccess($usr) {
					setcookie("user", $usr["login"], time() + 15000,"/");
					header("Location: ".$_SERVER["HTTP_REFERER"]);
				}

				public function GetAuthorize($login="", $password="") {
						$salt = Model::SelectItems("users", array("salt"), "login='".$login."'");
            $hash = crypt($_POST["password"], $salt["salt"]);

						$result = Model::SelectItems("users", array("*"),"login='{$login}' and password='{$hash}'");

						if ($result == true) {
							if ($result["status"] == 1) {
								$this->AuthorizeSuccess($result);
							}	else {
								$this->UsrBanned($result);
							}

						}	else {
							$this->AuthorizeFailed($result);
						}
				}

    }
 ?>