<?php

	class controller_pages extends Controller {
		public function __construct() {
			parent::__construct();
			$this->model = new model_pages();
		}

		public function index_action() {
			$data['title'] = "Список страниц";
			$data['header'] = "Список страниц";
			$data['items'] = $this->model->GetPages(0);
			$this->view->GetTemplate("pages/show_elements.phtml","main.phtml", $data);
		}
	}
