<?php

class model_tabs extends Model {

    public $tabs;

    public function __construct() {
        
    }

    public function options() {
        return $this->tabs = array("index" => array(
                                                     0 => array("id" => "#maincont", "name" => "Параметры"),
                                                     1 => array("id" => "#defend", "name" => "Защита")
                                                    )
                                  );
    }

    public function pages() {
        return $this->tabs = array("index" => array(
                                                    0 => array("id" => "#maincont", "name" => "Список страниц"),
                                                   ),
                                   "add" => array(
                                                   0 => array("id" => "#maincont", "name" => "Основное"),
                                                   1 => array("id" => "#advanced", "name" => "Дополнительно"),
                                                   2 => array("id" => "#seo", "name" => "SEO")
                                                 )
                                  );
    }

}
