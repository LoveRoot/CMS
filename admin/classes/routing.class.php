<?php
    class router
    {
        public function __construct($url="/")
        {
            if($url !== "/")
            {
                $url = explode("/", $_SERVER["REQUEST_URI"]);
                $this->route = array();
                foreach($url as $val)
                {
                    if (!empty($val))
                    {
                        $this->route[] = trim($val);
                    }
                } 
            }
        }
    }
?>