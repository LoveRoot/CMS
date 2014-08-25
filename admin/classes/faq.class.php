<?php
    class faq extends core
    {
        public $verify = 0;

        public function __construct()
        {
            parent::__construct();
        }

        public function __Verification($arrData)
        {
            if (isset($arrData["title"]) && empty($arrData["title"]))
                $this->error($this->message[] = "<li>Поле текст вопроса не может быть пустым</li>");

            if (isset($arrData["content"]) && empty($arrData["content"]))
                $this->error($this->message[] = "<li>Поле ответ на вопрос не может быть пустым</li>");

            if (isset($arrData["status"]))
                $this->status = 1;

            if (!empty($this->message)) {
                $this->GetMessageError($this->error());
            } 
             else {
                return $this->verify = 1;
            }
        }
    }

    class AddFaq extends faq
    {
        public function __construct()
        {
            parent::__construct();

            if ($_POST) {
                $this->__Verification($_POST);
                
                if($this->verify == 1) {
                    $this->__Add();
                } 
            }
            
        }

        public function __Add()
        {
            $title = strip_tags($_POST["title"]);
            $content = strip_tags($_POST["content"]);
            $page = $_POST["page"];

            if (!empty($_POST["status"]))
            $status = 1;

            $permissions = new __GetPermissions(0);

                if ($this->verify == 1) {
                    $sql = DB::I()->__InsertItems("faq", array(
                    "title" => $title,
                    "content" => $content,
                    "p_id" => $page,
                    "status" => $status));
                if ($sql == true) {
                    setcookie("success", "Запись " . "<strong>'" . $title . "'</strong>" . " успешно добавлен...", time() + 1);
                    header("Location: /admin.php?component=pages&model=faq&edit=" . $page . "");
                }
            }
        }

}

    class EditFaq extends faq
    {
        public $title;
        public $data;

        public function __construct()
        {
            parent::__construct();

            if ($_POST) {
                $this->__Verification($_POST);
                
                $this->title = strip_tags(addslashes($_POST["title"]));
                $this->content = strip_tags(addslashes($_POST["content"]));
                
                if($this->verify == 1) {
                    $this->__Edit();
                }
            }

            $result = DB::I()->__SelectItems("faq", array("title, content, status"), "id='".intval($_GET["edit"])."'");

            $this->title = $result["title"];
            $this->data = $result["content"];
            $this->status = $result["status"];
        }

        public function __Edit()
        {
            $sql = DB::I()->__UpdateItem("faq", "id=" . intval($_GET["edit"]) . "", array("title" => $this->title,
                                                                                          "content" => $this->content,
                                                                                          "p_id" => $_POST["page"],
                                                                                          "status" => $this->status));
            if ($sql == true) {
                setcookie("success", "Вопрос " . "<strong>'" . $this->title . "'</strong>" . " успешно от редактирован...", time() + 1);
                header("Location: /admin.php?component=pages&model=faq&edit=" . $_GET["page"] . "");
            }
        }
    }
?>
