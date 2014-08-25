<?php

    class model_main extends Model
    {

        public function __construct()
        {
            
        }

        public function GetContent($id)
        {
            $result = Model::SelectItems("pages", array("*"), "id=$id");
            return $result;
        }

    }
    