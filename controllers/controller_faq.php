<?php

    class controller_faq extends Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->model = new model_faq();
        }
        
        public function index_action() {
            $this->view->GetTemplate("faq.phtml","main.phtml", $this->data);
        }
    }
    