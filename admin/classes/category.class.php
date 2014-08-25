<?php

class category extends core {

    private $perms = 1, $protect = "true", $hidden = 1, $password_access;
    public $form = 1;

    public function __construct() {
        parent::__construct();
    }

    public function __delete($obj)
    {
        if (!empty($obj))
        {
            $this->permissions = new __GetPermissions("Select pages_delete From secure_admin, users, groups
                                                       where
                                                       users.login = '" . $_COOKIE["user"] . "' and
                                                       users.security = '" . $_COOKIE["session"] . "' and
                                                       groups.id = users.groups and
                                                       secure_admin.id_key = users.groups");
            if ($this->permissions->protect == 0)
            {
                $sql = DB::I()->__QueryString("Delete From pages where id='".$_GET["delete"]."' and main = 0");

                if ($sql == true) {
                   $this->__DeleteTree($obj);
                } else {
                    setcookie("success", "К сожалению произошла ошибка во время удаления страницы.".mysqli_error($this->link)."", time() + 1);
                    header("Location: ".$_SERVER["HTTP_REFERER"]."");
                }
            }
        }
    }
}

class create_category extends category {

    public function __construct() {
        parent::__construct();

        $this->permissions = new __GetPermissions("Select pages_create From secure_admin, users, groups where users.login = '" . $_COOKIE["user"] . "' and
                                                                                                              users.security = '" . $_COOKIE["session"] . "' and
                                                                                                              groups.id = users.groups and
                                                                                                              secure_admin.id_key = users.groups");
    }

    public function __Validation() {
        if ($_POST["submit"]) {
            if (!preg_match("/^([А-яа-яa-z0-9])/i", $_POST["name"]))
                $this->error($this->message[] = "<li>Имя категории обязательна к заполнению или содержит запрещённые символы</li>");

            if (!empty($_POST["seotitle"]) && !preg_match("/^([А-яа-яa-z0-9])/i", $_POST["seotitle"]))
            $this->error($this->message[] = "<li>Текст для seo заголовка должен содержать только разрешённые символы (а-я, a-z, 0-9)</li>");

					  if (!empty($_POST["altname"]) && !preg_match("/^[a-z0-9-_\/]+$/", $_POST["altname"]))
            $this->error($this->message[] = "<li>Ссылка на страницу должна содержить буквы латинского алфавита</li>");

						if (!intval($_POST["num_row"]))
                $this->error($this->message[] = "<li>Поле записей на страницу не должно содержать текст и обязательно к заполнению</li>"); //Не является числом
            if (!empty($_POST["perms"])) {
                $this->hidden = 0;
            } // Устанавливаем права, если флажок отмечен
            $this->password = $_POST["set_pass"];
            if ($_POST["status"] == "on")
                $this->status = 0;
            else
                $this->status = 1;

            if (!empty($this->message)) {
                $this->message = $this->GetTemplate("ShowAlert", array("caption" => "<h1>Внимание !</h1>", "ShowAlert" => $this->error()));
            } else {
                $this->protect = "false";
            }
        }
    }

    public function create()
    {
        if ($_POST) { //Если пришол запрос то обрабатываем
            $this->__Validation(); //проверяем правильность заполненной формы

            if (!empty($_POST["page_template"]))
            $template = $_POST["page_template"];
            else
            $template = "";

            if ($this->protect == "false") { //если ошибок нет, то едим дальше

						if (empty($_POST["altname"]))
						$link = $this->__GetTranslyte($_POST["name"]);
						else
						$link = $_POST["altname"];

						if ($_POST["viewgroups"] !== "custom") {
               $groups = $_POST["viewgroups"];
            }
              else
            {
                $groups = $_POST["defend_page"];

                foreach($groups as $items)
                {
                   $i .= $items.",";
                }
                $groups = substr($i, 0, -1);
            }

						$this->insert = DB::I()->__InsertItems("pages", array("title" => $_POST["name"],
                                                "link" => $link,
                                                "h1" => strip_tags($_POST["h1"]),
                                                "content" => $_POST["content"],
                                                "num_row" => $_POST["num_row"],
                                                "seotitle" => $_POST["seotitle"],
                                                "description" => $_POST["desc"],
                                                "keywords" => $_POST["keyw"],
                                                "viewsgroups" => $groups,
                                                "password" => $this->password,
                                                "status" => $this->status,
                                                "type" => $_GET["type"],
                                                "form" => 0,
                                                "p_id" => $_POST["page"],
                                                "img" => "",
                                                "template" => $template
                                                ));



                if ($this->insert == true) {
                    setcookie("success", "Страница '".$_POST["name"]."' успешно создана....", time() + 1);
                    header("Location: /admin.php?component=pages&c=all");
                } else {
                    if (mysqli_error($this->link))
                    echo $this->GetTemplate("ShowAlert", array("caption" => "<h1>Неожиданная ошибка</h1>", "ShowAlert" => mysqli_error($this->link)));
                }
            }
        }

        mysqli_close($this->link);
    }

}

class edit_category extends category {

    public $protect = "true";
    public $form = 0;

    public function __construct() {
        parent::__construct();
        $this->result = DB::I()->__SelectItems("pages", array("*"), "id='".$_GET["edit"]."'");

        $this->permissions = new __GetPermissions("Select pages_edit From secure_admin, users, groups where users.login = '".$_COOKIE["user"]."' and
                                                                                                            users.security = '".$_COOKIE["session"]."' and
                                                                                                            groups.id = users.groups and
                                                                                                            secure_admin.id_key = users.groups");
        
        $this->EditPage();
    }

    public function __Validation() {

       if (isset($_POST["name"]) && !preg_match("/^([А-яа-яa-z0-9])/i", $_POST["name"]))
       $this->error($this->message[] = "<li>Имя категории обязательна к заполнению или содержит запрещённые символы</li>");

       if (isset($_POST["altname"]) && $_POST["altname"] !== "/" &&!preg_match("/^([a-z0-9])/i", $_POST["altname"]))
       $this->error($this->message[] = "<li>Альтернативное имя обязательна к заполнению и должна содержать только латинские буквы</li>");


       if (!empty($_POST["seotitle"]) && !preg_match("/^([А-яа-яa-z0-9])/i", $_POST["seotitle"]))
       $this->error($this->message[] = "<li>Текст для seo заголовка должен содержать только разрешённые символы (а-я, a-z, 0-9)</li>");

       if (isset($_POST["num_row"]) && !intval($_POST["num_row"]))
       {
         $this->error($this->message[] = "<li>Поле записей на страницу не должно содержать текст и обязательно к заполнению</li>"); //Не является числом
       }

       if (!empty($_POST["perms"])) {
            $this->hidden = 0;
       }

       $this->password = $_POST["set_pass"];

       if ($_POST["status"] == "on") {
            $this->status = 0;
       }
          else
       {
            $this->status = 1;
       }

       if (!empty($this->message)) {
           echo $this->GetTemplate("ShowAlert", array("caption" => "<h1>Произошла ошибка</h1>","ShowAlert" => $this->error()));
        }
            else
        {
           $this->protect = "false";
        }
     }

    public function EditPage()
    {
        if (isset($this->result["hidden"]) && $this->result["hidden"] == 0) {
            $this->checked = "checked";
        }

        if (isset($_POST["savePage"])) {

            $this->__Validation();

            if ($this->protect == "false") {
                $url = $_POST["altname"];

                if (isset($_POST["altname"]) && empty($_POST["altname"]))
                $url = $this->translyte($_POST["altname"]);

                if (isset($_FILES["filename"]))
                $file = new Download($_SERVER["DOCUMENT_ROOT"] . "/upload/category-logo/", 160, 110);

                if (isset($_POST["form"]))
                $this->form = 1;

                if (!empty($_POST["page_template"]))
                $template = $_POST["page_template"];
                else
                $template = "";

                if ($_POST["viewgroups"] !== "custom") {
                   $groups = $_POST["viewgroups"];
                }

                else
                {
                   $groups = $_POST["defend_page"];

                   foreach($groups as $items)
                   {
                       $i .= $items.",";
                   }

                   $groups = substr($i, 0, -1);
                }

                $update = DB::I()->__UpdateItem("pages", "id='".$_GET[edit]."'", array(
                                                                                       "title" => $_POST["name"],
                                                                                       "content" => $_POST["content"],
                                                                                       "link" => $url,
                                                                                       "h1" => strip_tags(mysql_escape_string($_POST["h1"])),
                                                                                       "num_row" => $_POST["num_row"],
                                                                                       "seotitle" => $_POST["seotitle"],
                                                                                       "description" => strip_tags($_POST["desc"]),
                                                                                       "keywords" => strip_tags($_POST["keyw"]),
                                                                                       "viewsgroups" => $groups,
                                                                                       "password" => $this->password,
                                                                                       "img" => $file->path,
                                                                                       "form" => $this->form,
                                                                                       "status" => $this->status,
                                                                                       "template" => $template,
                                                                                       "design" => $_POST["design"],
                                                                                       "tree" => isset($_POST["tree"]) ? 1 : 0
                                                                                      ));

                if ($update == true) {
                    setcookie("success", "Страница '<strong>" . $_POST["name"] . "</strong>' успешно сохранена....", time() + 1);
                    header("Location:  ".$_SERVER["HTTP_REFERER"]."");

                } else {
                    echo core::I()->GetTemplate("ShowError", array(
                                                "ShowError" => "Произошла ошибка&nbsp;" . mysqli_error($this->link) . "",
                                                "caption" => "<h1>Произошла ошибка</h1>"));
                }
            }
        }
    }

}

?>