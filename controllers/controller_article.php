<?php

    class controller_article extends Controller
    {

        public function __construct()
        {      
            $this->model = new model_article();
        }

        public function fullnews_action(&$data = array(), $vParams = array())
        {
            $data = $this->model->ReadNews($vParams["id"]);

            $this->data['page'] = $data;

            $this->data['title'] = !empty($data["seotitle"]) ? $data["seotitle"] : $data["title"];
            $this->data['description'] = $data["description"];
            $this->data['keywords'] = $data["keywords"];

            $this->view->GetTemplate("system_template/article/fullnews.phtml", "main.phtml", $this->data);
        }

        public function index_action(&$data = array(), $vParams = array())
        {
            parent::__construct($vParams["id"]);
            $list_news = $this->model->GetNews($vParams["id"]);
            $this->data['news'] = $list_news;

            $this->view->GetTemplate("system_template/article/list.phtml", "main.phtml", $this->data);
        }

    }
