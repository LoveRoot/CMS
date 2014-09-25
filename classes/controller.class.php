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
						$this->data['page'] = Model::SelectItems("pages", array("id", "name", "title", "description", "keywords", "short_content", "h1"), "id='".$id."'");

            $this->data['title'] = empty($this->data['page']['title']) ? $this->data['page']['name'] : Model::config("site_name");
            $this->data['description'] = !empty($this->data['page']['description']) ? $this->data['page']['description'] : Model::config("description");
            $this->data['keywords'] = !empty($this->data['page']['keywords']) ? $this->data['page']['keywords'] : Model::config("keywords");

        }

    }

?>