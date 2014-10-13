<?php

class controller_pages extends Controller {

    public function __construct() {
        parent::__construct();
        $this->model = new model_pages();
    }

    public function add_action(&$data = array(), &$vParams = array()) {
        $data['title'] = "Создание страницы";
        $data['header'] = "Создание страницы";
        $data['option'] = $this->model->GetRazdel();
        $data["params"] = $vParams;

        if (isset($vParams["submit"])) {
           $this->model->AddPages($vParams);
        }

        $this->view->GetTemplate("pages/add_page.phtml", "main.phtml", $data);
    }

		public function property_action(&$data = array(), &$vParams = array()) {
			$data['title'] = "Свойства страницы";
      $data['header'] = "Свойства страницы";
			$data['type'] = $this->model->TypePage($vParams["id"]);

			$this->view->GetTemplate("pages/property_page.phtml", "main.phtml", $data);
		}

		public function delete_action(&$data = array(), &$vParams = array()) {
			if (isset($vParams["id"])) {
				$this->model->Delete($vParams["id"]);
			}
		}

    public function index_action(&$data = array(), &$vParams = array()) {
        $data['title'] = "Список страниц";
        $data['items'] = $this->model->GetPages(0);
        $this->view->GetTemplate("pages/show_elements.phtml", "main.phtml", $data);
    }

}
