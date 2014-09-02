<?php

class controller_options extends Controller{
    public function __construct() {
        parent::__construct();
        $this->model = new model_options();
    }
    
    public function index_action() {
        $data['title'] = "Настройка сайта";
        $this->view->GetTemplate("options.phtml","main.phtml", $data);
    }
}

?>
