<?php

    class Controller
    {

        public $model;
        public $view;

        public function __construct()
        {
            $this->view = View::I();

            $id = isset($_GET["id"]) ? $_GET["id"] : 1;

            $this->GetHead(intval($id));
        }

        public function GetHead($id)
        {
            $this->data['page'] = Model::SelectItems("pages", array("id", "title", "seotitle", "description", "keywords", "content", "h1"), "id='" . $id . "'");

            $this->data['title'] = empty($this->data['page']['seotitle']) ? $this->data['page']['title'] : core::Config("title");
            $this->data['description'] = !empty($this->data['page']['description']) ? $this->data['page']['description'] : core::Config('description');
            $this->data['keywords'] = !empty($this->data['page']['keywords']) ? $this->data['page']['keywords'] : core::Config('keywords');
        }

    }

?>