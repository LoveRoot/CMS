<?php

class controller_404 extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index_action($data = array(), $vParams = array()) {

        $data['title'] = "Ошибка: Страница не найдена Page 404 NotFound";
        $this->view->GetTemplate("404.phtml", "main.phtml", $data);
    }

}

?>
