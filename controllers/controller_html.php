<?php

    class controller_html extends Controller
    {
        public function __construct()
        {
            $this->model = new model_html();
        }

        public function index_action(&$data = array(), &$vParams = array()) {
						parent::__construct($vParams["id"]);
            $this->view->GetTemplate("html_page.phtml","main.phtml", $this->data);
        }
    }
