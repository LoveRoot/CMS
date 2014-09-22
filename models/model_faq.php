<?php

    class model_faq extends Model
    {
        public function __construct()
        {
            
        }
        
        public function GetResult($id) {
            $result = new Pagination("SELECT * From faq where p_id = '".$id."'",
                                     "SELECT id From faq where p_id = '".$id."'", 10);
            return $result;
        }
    }
    