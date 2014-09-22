<?php
	class controller_authorize extends Controller {
		public function __construct() {
			parent::__construct();
			$this->model =  core::GetFactory("admin/models/","model_authorize");
		}

		public function index_action(&$data="") {
			 if (isset($_POST["login"])) {
				 $login = core::Vanish($_POST["user"]);
				 $password = $_POST["password"];
				 $this->model->Authorize($login, $password);
			 }

			 if (isset($_COOKIE["user"])) {
					$check_user = $this->model->WhoIsUser($_COOKIE["user"]);
					if ($check_user == true) {
							$data["user_info"] = $check_user;
							$this->model->Security(core::UnSerialize($check_user["permissions"]));
							$this->view->GetTemplate("main.phtml", "authorize/success.phtml",$data);
					}
						else {
							$this->view->GetTemplate("main.phtml","authorize/authorize.phtml");
					}
			 }	else {
				 if ($_SERVER["REQUEST_URI"] !== "/admin.php")
						header("Location: /admin.php");
						$this->view->GetTemplate("authorize.phtml","authorize/authorize.phtml");
			 }
		}
	}
?>
