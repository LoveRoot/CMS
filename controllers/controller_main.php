<?php
    class controller_main extends Controller
    {
        public function __construct() {
            parent::__construct();
						$this->model = new model_main();
        }

        public function index_action(&$data =  array())
        {
					 $id = isset($_GET["id"]) ? intval($_GET["id"]) : 1;

					 $data['item'] = $this->model->GetContent($id);

					 $data['title'] = empty($data['item']['seotitle']) ? $data['item']['title'] : core::Config("title");
					 $data['description'] = !empty($data['item']['description']) ? $data['item']['description'] : core::Config('description');
					 $data['keywords'] = !empty($data['item']['keywords']) ? $data['item']['keywords'] : core::Config('keywords');

					 $this->view->GetTemplate('index_content.phtml', 'main.phtml', $data);

        }
    }
?>