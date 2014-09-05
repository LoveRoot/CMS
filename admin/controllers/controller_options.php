<?php

class controller_options extends Controller{
    public function __construct() {
        parent::__construct();
        $this->model = new model_options();
    }

    public function index_action(&$data=array(), &$vParams = array()) {
        $data['title'] = "Настройка сайта";
				$data['param'] = $this->model->GetConfig();
				$data['template'] = $this->model->GetTemplate("template/");
        $this->view->GetTemplate("options.phtml","main.phtml", $data);
    }
}

?>
