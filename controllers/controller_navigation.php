<?php

    class controller_navigation extends Controller
    {

        public function __construct()
        {
            parent::__construct();
            $this->model = core::GetFactory("models/", "model_navigation");
        }

        public function index_action()
        {
            $nav_auto = core::Config("rend_cat_auto");

            $this->data['nav'] = $this->model->GetResult(0);

            $this->view->GetTemplate("main.phtml", "system_template/navigation_auto.phtml", $this->data);

//				if (trim($nav_auto) == "on") {
//					$this->view->GetTemplate("main.phtml","system_template/navigation_manual.phtml", $this->data);
//				}	else {
//
//					$this->view->GetTemplate("main.phtml","system_template/navigation_auto.phtml", $this->data);
//				}
        }

    }
    