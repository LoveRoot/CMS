<?php
    class winProperty
    {
	public function __construct($prop = "")
	{
            $this->result = DB::I()->__QueryString($prop);
	}
    }

     class SaveWinPropPages extends winProperty
     {

        public function __checked($title, $link) {
            if ($_GET)
						{
                if (!preg_match("/^([a-zA-zA-Zа-яА-яА-Я0-9_-])/i", $title))
                    $this->error($this->message[] = "<li>Заголовок должен быть заполнен, допустимые символы: a-z A-z A-Z а-я А-я А-Я 0-9</li>");

                if (!preg_match("/^[a-z-_\/]+$/", $link))
                    $this->error($this->message[] = "<li>Поле url должен быть заполнен, допустимые символы: a-z _ -</li>");
            }
        }

        public function __construct($id, $title, $link, $status) {
            parent::__construct();
            $this->__checked($title, $link);

            if (empty($this->message))
            {
                $sql = DB::I()->__UpdateItem("pages",array(
                                                            "title" => $title,
                                                            "title" => $link,
                                                            "title" => $status,
                                                          ), "id='{$id}'");

                if ($sql == true) {
                   echo "success";
                } else {
                    echo mysqli_error($this->link);
                }
            } else {
                echo "<ul>".$this->error()."</ul>";
            }
        }

    }

    class SaveWinPropFaq extends winProperty {

        public function __construct($id=0, $title="", $link="", $status=0) {
            parent::__construct();
            $this->__checked($title);

            if (empty($this->message)) {
                $sql = DB::I()->__UpdateItem("faq", array(
                                                            "title" => $title,
                                                            "status" => $status
                                                         ),"id='{$id}'");
                if ($sql == true) {
                    echo "success";
                } else {
                    echo mysqli_error($this->link);
                }
            } else {
                echo "<ul>".$this->error()."</ul>";
            }
        }

         public function __checked($title) {
            if ($_GET) {
                if (!preg_match("/^([a-zA-zA-Zа-яА-яА-Я0-9_-])/i", $title))
                $this->error($this->message[] = "<li>Заголовок не может быть пустым</li>");
            }
        }

    }

    class SaveWinPropSlider extends winProperty {

        public function __construct($id, $title, $link, $status) {
            parent::__construct();

            if (empty($title)) {
                echo "Имя коллекции не должно быть пустым";
            } else {
                $sql = DB::I()->__UpdateItem("slider", array(
                                                            "title" => $title,
                                                            "status" => $status
                                                         ),"id='{$id}'");

                if ($sql == true) {
                    echo "success";
                } else {
                    echo mysqli_error($this->link);
                }
            }
        }

    }

    class SaveWinPropArticle extends winProperty {

        public function __checked($title, $link) {
            if ($_GET) {
                if (!preg_match("/^([a-zA-zA-Zа-яА-яА-Я0-9_-])/i", $title))
                    $this->error($this->message[] = "<li>Заголовок должен быть заполнен, допустимые символы: a-z A-z A-Z а-я А-я А-Я 0-9</li>");

                if (!preg_match("/^[a-z0-9-_\/]+$/", $link))
                    $this->error($this->message[] = "<li>Поле url должен быть заполнен, допустимые символы: a-z _ -</li>");
            }
        }

        public function __construct($id, $title, $link, $status) {
            parent::__construct();
            $this->__checked($title, $link);

            if (empty($this->message)) {
                $sql = DB::I()->__UpdateItem("article", array(
                                                            "title" => $title,
                                                            "status" => $status,
                                                            "rewrite_url" => $link
                                                         ),"id='{$id}'");
                if ($sql == true) {
                    echo "success";
                } else {
                    echo mysqli_error($this->link);
                }
            } else {
                echo $this->show_err_WinProperty();
            }
        }

    }

    class SaveWinPropStatic_page extends winProperty {

        public function __checked($title, $link) {
            if ($_GET) {
                if (!preg_match("/^([a-zA-zA-Zа-яА-яА-Я0-9_-])/i", $title))
                    $this->error($this->message[] = "<li>Заголовок должен быть заполнен, допустимые символы: a-z A-z A-Z а-я А-я А-Я 0-9</li>");

                if (!preg_match("/^[a-z-_\/]+$/", $link))
                    $this->error($this->message[] = "<li>Поле url должен быть заполнен, допустимые символы: a-z _ -</li>");
            }
        }

        public function __construct($id, $title, $link, $status) {
            parent::__construct();
            $this->__checked($title, $link);
            
            if (empty($this->message)) {
                 $sql = DB::I()->__UpdateItem("static_page", array(
                                                            "title" => $title,
                                                            "status" => $status,
                                                            "rewrite_url" => $link
                                                         ),"id='{$id}'");
                if ($sql == true) {
                    echo "success";
                } else {
                    echo mysqli_error($this->socket);
                }
            } else {
                echo $this->show_err_WinProperty();
            }
        }
    }

    class SaveWinPropGallery extends winProperty {

        public function __checked($title, $link, $status=0) {
            if ($_GET) {
                if (!preg_match("/^([a-zA-zA-Zа-яА-яА-Я0-9_-])/i", $title))
                    $this->error($this->message[] = "<li>Заголовок должен быть заполнен, допустимые символы: a-z A-z A-Z а-я А-я А-Я 0-9</li>");

                if (!preg_match("/^[a-z-_\/]+$/", $link))
                    $this->error($this->message[] = "<li>Поле url должен быть заполнен, допустимые символы: a-z _ -</li>");
            }
        }

        public function __construct($id, $title, $link, $status) {
            parent::__construct();
            $this->__checked($title, $link);

            if (empty($this->message)) {
                $sql = DB::I()->__UpdateItem("collection", array(
                                                            "name" => $title,
                                                            "link" => $link,
                                                            "status" => $status
                                                         ),"id='{$id}'");
                if ($sql == true) {
                    echo "success";
                } else {
                    echo mysqli_error($this->link);
                }
            } else {
                echo $this->show_err_WinProperty();
            }
        }

    }

?>