<?php

    class controller_main extends Controller
    {

        public function __construct()
        {
            parent::__construct();
            $this->model = new model_main();
        }

        public function index_action(&$data = array())
        {
            $id = isset($_GET["id"]) ? intval($_GET["id"]) : 1;

            if ($_SERVER["REQUEST_URI"] == "/")
            {
                $this->view->GetTemplate('index_content.phtml', 'main.phtml', $this->data);
            } else
            {
                $this->view->GetTemplate('', 'main.phtml', $this->data);
            }
        }

    }

?>