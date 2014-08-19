<?php
	class controller_authorize extends Controller {
		public function __construct() {
			parent::__construct();
			$this->model_authorize = core::GetFactory("models/","model_authorize");
		}

		public function index_action() {
			if (!isset($_COOKIE["user"]) || !isset($_SESSION["user"])) {
					$this->view->GetTemplate("main.phtml","authorize/authorize_form.phtml");
			}

			$data["users"] = $this->model_authorize->GetAuthorize();
		}

		function __destruct() {

		}
	}
?>
