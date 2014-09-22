<?php

	class controller_pages extends Controller {
		public function __construct() {
			parent::__construct();
			$this->model = new model_pages();
		}

		public function add_action(&$data=array(), &$vParams = array()) {
			$data['title'] = "Создание страницы";
			$data['header'] = "Создание страницы";
			$this->view->GetTemplate("pages/add_page.phtml","main.phtml", $data);
		}

		public function index_action(&$data=array(), &$vParams = array()) {
			$data['title'] = "Список страниц";
			$data['items'] = $this->model->GetPages(0);
			$this->view->GetTemplate("pages/show_elements.phtml","main.phtml", $data);
		}
	}
