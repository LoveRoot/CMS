<?php

class model_tabs extends Model {

    public $tabs;

    public function __construct() {

    }

    public function TypePage($id) {
        $result = Model::SelectItems("pages", array("page_type"), "id={$id}");
        return $result["page_type"];
    }

    public function options() {
        return $this->tabs = array
            (
            "index" => array
                (
                "type" => array
                    (
                    "index" => array
                        (
                        0 => array("id" => "#maincont", "name" => "Параметры"),
                        1 => array("id" => "#defend", "name" => "Защита")
                    )
                )
            )
        );
    }

    public function pages() {
        return $this->tabs = array
        (
            "index" => array
                (
                "type" => array
                    (
                        "index" => array
                        (
                            0 => array("id" => "#maincont", "name" => "Список страниц"
                        )
                    )
                )
            ),
            "add" => array
                (
                    "type" => array
                    (
                    "article" => array
                        (
                        0 => array("id" => "#maincont", "name" => "Основное"),
                        1 => array("id" => "#advanced", "name" => "Контент"),
                        2 => array("id" => "#seo", "name" => "SEO")
                    )
                )
            ),
            "property" => array
            (
                "type" => array
                (
                   "article" => array
                   (
                        0 => array("id" => "#maincont", "name" => "Основное"),
                        1 => array("id" => "#advanced", "name" => "Контент"),
                        2 => array("id" => "#seo", "name" => "SEO")
                   ),

									 "html" => array
                   (
                        0 => array("id" => "#maincont", "name" => "Содержимое"),
                        1 => array("id" => "#seo", "name" => "SEO")
                   ),

                   "main" => array
                   (
                        0 => array("id" => "#maincont","name" => "Содержимое"),
                        1 => array("id" => "#seo","name" => "SEO")
                   )
               )
            ),
            "elements" => array
            (
                "type" => array
                (
                    "index" => array
                    (
                        0 => array("id" => "#maincont","name" => "список элементов"),
                        1 => array("id" => "#search","name" => "Поиск записей"),
                    )
                )
            )

        );
    }

    public function users() {
        return $this->tabs = array
            (
            "index" => array
                (
                "type" => array
                    (
                    "index" => array
                    (
                        0 => array("id" => "#maincont", "name" => "Список пользователей"),
                        1 => array("id" => "#fast_search", "name" => "Быстрый поиск"),
                        2 => array("id" => "#advance_search", "name" => "Расширенный поиск"),
                    )
                )
            )
        );
    }

}
