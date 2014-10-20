<?php

class controller_navigation extends Controller {

    public function __construct() {

        $this->model = core::GetFactory("models/", "model_navigation");
    }

    public function index_action($data=array(), &$vParams = array()) {
        if ($vParams["id"] !== null) {
            $id = $vParams["id"];
        }   else {
            $id = 1;
        }
        parent::__construct($id);

        $nav_auto = "on";

        $this->data['nav'] = $this->model->TopNavigation(0);

        $this->view->GetTemplate("main.phtml", "system_template/navigation_auto.phtml", $this->data);

    }

}
