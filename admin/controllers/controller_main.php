<?php
	class controller_main extends Controller {
		public function __construct() {
			parent::__construct();
			$this->model = new model_main();
		}

		public function index_action(&$data="") {
			$data['title'] = "Панель управления сайтом";
			$this->view->GetTemplate("index_content.phtml","main.phtml", $data);
		}
	}
?>
