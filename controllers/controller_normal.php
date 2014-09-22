<?php

    class controller_normal extends Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->model = new model_normal();
        }
        
        public function index_action() {
            $this->view->GetTemplate("html_page.phtml","main.phtml", $this->data);
        }
    }
    