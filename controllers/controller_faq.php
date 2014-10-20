<?php

    class controller_faq extends Controller
    {
        public function __construct()
        {
            
            $this->model = new model_faq();
        }
        
        public function index_action(&$data=array(), &$vParams = array()) {
            parent::__construct($vParams["id"]);
            $p_id = intval($vParams["id"]);
            $this->data["items"] = $this->model->GetResult($p_id);

            $this->view->GetTemplate("faq.phtml","main.phtml", $this->data);
            
        }
    }
    