<?php

    class Controller
    {
        public $model;
        public $view;
        
        public function __construct() {
            $this->view = View::I();
        }
    }
?>    