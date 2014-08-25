<?php

	class controller_article extends Controller {
		public function __construct() {
			parent::__construct();
			$this->model = new model_article();
		}

		public function index_action(&$data = array(), $params=null) {
			$p_id = $_GET["id"];

			$this->data['news'] = $this->model->GetShortNews($p_id);

			$this->view->GetTemplate("system_template/news.phtml","main.phtml", $this->data);
		}
	}
