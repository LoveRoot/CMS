<?php

    class controller_main extends Controller
    {

        public function __construct()
        {
            parent::__construct($id=1);
            $this->model = new model_main();
        }

        public function index_action(&$data = array(), &$vParams = array())
        {            
            if ($_SERVER["REQUEST_URI"] == "/")
            {
                $this->view->GetTemplate('index_content.phtml', 'main.phtml', $this->data);
            } 
                else
            {
                $this->view->GetTemplate('', 'main.phtml', $this->data);
            }
        }

    }

?>