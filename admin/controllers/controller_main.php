<?php
	class controller_main extends Controller {
		public function __construct() {
			parent::__construct();
			$this->model = new model_main();
		}

		public function logout_action() {
			setcookie("user","", time() - 10000000);
			header("Location: /admin.php");
		}

		public function index_action(&$data="", &$vParams = array()) {
 			if (isset($_COOKIE["user"]) && !empty($_COOKIE["user"])) {
				$data['title'] = "Панель управления сайтом";
				$this->view->GetTemplate("index_content.phtml","main.phtml", $data);
			}	else {
				$data['title'] = "Панель управления сайтом - Авторизация";
				$this->view->GetTemplate("","authorize.phtml", $data);
			}

		}
	}
?>
