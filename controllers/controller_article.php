<?php

    class controller_article extends Controller
    {

        public function __construct()
        {
            parent::__construct();
            $this->model = new model_article();
        }

        public function fullnews_action(&$data = array(), $params = null)
        {
            $p_id = $_GET["id"];
            
            $data = $this->model->ReadNews($p_id);
           
            $this->data['page'] = $data;

            $this->data['title'] = !empty($data["seotitle"]) ? $data["seotitle"] : $data["title"];
            $this->data['description'] = $data["description"];
            $this->data['keywords'] = $data["keywords"];
            
            $this->view->GetTemplate("system_template/article/fullnews.phtml", "main.phtml", $this->data);
        }

        public function index_action(&$data = array(), $params = null)
        {
            $p_id = $_GET["id"];

            $this->data['news'] = $this->model->GetShortNews($p_id);

            $this->view->GetTemplate("system_template/article/list.phtml", "main.phtml", $this->data);
        }

    }
    