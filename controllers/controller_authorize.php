<?php
	class controller_authorize extends Controller {
		public function __construct() {
			parent::__construct();
			$this->model_authorize = core::GetFactory("models/","model_authorize");

			if (isset($_POST["authorize"])) {
				$login = core::Vanish($_POST["login"]);
				$password = md5($_POST["password"]);

				$data["users"] = $this->model_authorize->GetAuthorize($login, $password);
			}

			if (isset($_GET["do"]) && $_GET["do"] == "logout") {
				$this->model_authorize->Logout();
			}
		}

		public function index_action() {
			if ((!isset($_COOKIE["user"]))) {
				$this->view->GetTemplate("main.phtml","authorize/authorize_form.phtml");
			}	else {
				$this->view->GetTemplate("main.phtml","authorize/authorize_success.phtml");
			}
		}

		function __destruct() {

		}
	}
?>
