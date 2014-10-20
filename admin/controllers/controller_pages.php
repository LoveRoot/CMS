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
            $this->model->AddPage($vParams);
        }

        $this->view->GetTemplate("pages/add_page.phtml", "main.phtml", $data);
    }

    public function property_action(&$data = array(), &$vParams = array()) {
        $data["data"] = $this->model->GetDataPage($vParams["id"]);
        $data['title'] = "Свойства страницы - {$data["data"]["name"]}";
        $data['header'] = "Свойства страницы - {$data["data"]["name"]}";
        $data['type'] = $data["data"]["page_type"];
        $data['option'] = $this->model->GetRazdel();
        $data["params"] = $vParams;
        
        $url = explode(".", $data["data"]["url"]);
        $data['url'] = $url[0];
        
        if (isset($vParams["submit"])) {
            $this->model->UpdatePage($vParams);
        }

        $this->view->GetTemplate("pages/property_page.phtml", "main.phtml", $data);
    }

    public function elements_action(&$data = array(), &$vParams = array()) {
        $data['data'] = $this->model->GetDataPage($vParams["id"]);
        $data['elements'] = $this->model->GetDataElements($vParams["id"]);
        $data['pagination'] = Pagination::navigation("admin.php?component={$vParams["component"]}&action={$vParams["action"]}&id={$vParams["id"]}&page=");

        $data['title'] = "Элементы страницы - {$data["data"]["name"]}";

        $data['type'] = $data["data"]["page_type"];
        
        $this->view->GetTemplate("pages/elements_page.phtml", "main.phtml", $data);
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
