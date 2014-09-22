<?php
    class Controller
    {
        public $model;
        public $view;

        public function __construct()
        {
            $this->view = View::I();
            $id = isset($_GET["id"]) ? $_GET["id"] : 1;
        }
    }

?>