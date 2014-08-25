<?php

    class model_navigation extends Model
    {

        public function __construct()
        {
            $this->page = $this->GetArray();
        }

        public function GetArray()
        {
            $result = Model::QueryString("Select id, p_id, link, title, status, type From pages ORDER By sort");

            if ($result == true)
            {
                $this->tree_cat = array();
                do
                {
                    $this->tree_cat[][$result["p_id"]] = $result;
                } while ($result = mysqli_fetch_assoc(Model::$query));
                return $this->tree_cat;
            } else
            {
                return false;
            }
        }

        public function GetResult()
        {
            return $this->page;
        }

    }
    