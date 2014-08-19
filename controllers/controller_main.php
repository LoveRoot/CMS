<?php
    class controller_main extends Controller
    {
        public function __construct() {
            parent::__construct();
						$this->model_content = core::GetFactory("models/", "model_main");
        }

        public function index_action(&$data="")
        {
					 $data['title'] = core::Config("title");
					 $data['description'] = core::Config('description');
					 $data['keywords'] = core::Config('keywords');
					 
					 $data['item'] = $this->model_content->GetContent(1);

           $this->view->GetTemplate('index_content.phtml', 'main.phtml', $data);
        }
    }
?>