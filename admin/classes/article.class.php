<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/classes/secure_panel.class.php");

class article extends core {

    private $perms = 1, $protect = "true";
    public $status, $main = "checked", $prioritet = "checked", $arr, $form = 1;

    public function __construct() {
        parent::__construct();
    }

    protected function ajax() {
        if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
            $id = $_REQUEST["id"];
        }
    }

    public function __Validation() {
        $this->status = 0;

        if ($_POST["status"] == "on")
            $this->status = 1;
        if ($_POST["main"] == "on")
            $this->main = 1;
        if ($_POST["prioritet"] == "on")
            $this->prioritet = 1;
        if (empty($_POST["title"]))
            $this->error($this->message[] = "<li>Заголовок не может быть пустым</li>");
        if (empty($_POST["shortarticle"]))
            $this->error($this->message[] = "<li>Краткая запись должна быть заполнена</li>");

        if (!empty($_POST["urls"])) {
            if (!preg_match("#http://[a-z0-9]+[_.]+[a-z]#i", $_POST["urls"]))
            $this->error($this->message[] = "<li>Не правильно заполнена ссылка на источник пример http://success.ru</li>");
        }

        if (!empty($this->message)) {
           $this->GetMessageError($this->error());
        } else {
            $this->protect = "false";
        }
    }

    public function add() {

        if ($_POST) {
            $this->__Validation();

            if ($this->protect == "false") 
            {

                $article_add = DB::I()->__InsertItems("article", array("title" => trim($_POST["title"]), 
                                                                    "seotitle" => $_POST["seotitle"],
                                                                    "rewrite_url" => $this->__GetTranslyte(trim($_POST["title"])),
                                                                    "author" => $_COOKIE["user"], 
                                                                    "date" => date("d.m.Y"), 
                                                                    "shortnews" => $_POST["shortarticle"], 
                                                                    "fullnews" => $_POST["fullarticle"], 
                                                                    "keywords" => $_POST["keywords"], 
                                                                    "description" => $_POST["description"], 
                                                                    "status" => $this->status,
                                                                    "main" => $this->main, 
                                                                    "prioritet" => $this->prioritet, 
                                                                    "p_id" => $_POST["page"]                              
                ));
                
                foreach ($_POST["tags"] as $tag) {
                   DB::I()->__InsertItems("tags", array(
                                                        "name" => $tag,
                                                        "p_id" => $article_add
                                                     ));
                }
                
                if ($article_add !== null) {
                    setcookie("success", "Ваша статья " . "<strong>'".$_POST["title"] . "'</strong>" . " успешно добавлена на сайте...", time() + 1);
                    header("Location: /admin.php?component=pages&model=article&edit=".$_GET['page']."");
                } 
            }
        }
    }

    

    public function __delete($obj) {
        if (!empty($obj)) 
        {
            $this->permissions = new __GetPermissions("Select news_delete From secure_admin, users, groups
                                                       where 
                                                       users.login = '" . $_COOKIE["user"] . "' and
                                                       users.security = '" . $_COOKIE["session"] . "' and
                                                       groups.id = users.groups and
                                                       secure_admin.id_key = users.groups");
            if ($this->permissions->protect == 0) {
                $sql = DB::I()->__DeleteItem("article","id='".$obj."'");
                $sql = DB::I()->__DeleteItem("comments","id_post='".$obj."'");
                $sql = DB::I()->__DeleteItem("tags","p_id='".$obj."'");

                if ($sql == true)
                    setcookie("success", "Статья успешно удалена...", time() + 1);  
            } else {
                setcookie("success", "У вас нет прав на удаление этой записи", time() + 1);                
            }
            header("Location: " . $_SERVER["HTTP_REFERER"] . "");
        }
    }
}

class add_article extends article {

    public function __construct() {
        parent::__construct();
        
       $this->permissions = new __GetPermissions("Select post_add From secure_admin, users, groups
                                                  where 
                                                  users.login = '" . $_COOKIE["user"] . "' and
                                                  users.security = '" . $_COOKIE["session"] . "' and
                                                  groups.id = users.groups and
                                                  secure_admin.id_key = users.groups");   
        parent::add();
    }
}

class edit_article extends article {

    public function __construct() 
    {
        parent::__construct();

        if (!empty($_POST)){
            $this->EditArticle($_GET["edit"]);
        }
        
        $this->resultQuery = DB::I()->__SelectItems("article", array(title, seotitle, shortnews, fullnews, description, keywords, main, status, prioritet), "id='".intval($_GET["edit"])."'");       
        $this->resultTags = DB::I()->__QueryString("SELECT t.name From tags as t, article as a, pages as p WHERE t.p_id = '".intval($_GET["edit"])."' and a.p_id = p.id");

        if ((!intval($_GET["edit"]) || (!$this->resultQuery))) {
            echo "Произошла неожиданная ошибка.<br />Возможно у вас нет прав для редактирования статьи." . mysqli_error($this->link);
            $this->form = 0;
        }
            else 
        {
            if ($this->resultQuery["status"] == 1)
                $this->status = "checked";
            if ($this->resultQuery["main"] == 0)
                $this->main = "";
            if ($this->resultQuery["prioritet"] == 0)
                $this->prioritet = "";
            
            if ($this->resultTags !== null) {
                $this->arr_tags = array();
                
                do {
                    $this->arr_tags[] = $this->resultTags["name"]; 
                }while($this->resultTags = mysqli_fetch_assoc($this->query));
                
                foreach (array_unique($this->arr_tags) as $tags) {
                    $this->tags .= "<div class='rowAddTags'><input type='text' name='tags[]' value='".$tags."' style='width:180px;' />&nbsp;&nbsp;
                                        <a href='javascript:' class='delete_tag_row'>
                                        <img src='/admin/engine/images/remove_row.png' title='Удалить поле' alt='Удалить поле'>
                                     </a></div>";
                }
            }    
        }
    }
    
    public function __Validation() 
    {
        $this->status = 0;

        if ($_POST["status"] == "on")
            $this->status = 1;
        if ($_POST["main"] == "on")
            $this->main = 1;
        if ($_POST["prioritet"] == "on")
            $this->prioritet = 1;
        if (empty($_POST["title"]))
            $this->error($this->message[] = "<li>Заголовок не может быть пустым</li>");
        if (empty($_POST["shortarticle"]))
            $this->error($this->message[] = "<li>Краткая запись должна быть заполнена</li>");

        if (!empty($_POST["urls"])) {
            if (!preg_match("#http://[a-z0-9]+[_.]+[a-z]#i", $_POST["urls"]))
            $this->error($this->message[] = "<li>Не правильно заполнена ссылка на источник пример http://success.ru</li>");
        }

        if (!empty($this->message)) {
           $this->GetMessageError($this->error());
        } else {
            $this->protect = "false";
        }
    }
    
    public function EditArticle($id)  
    {
            
        $this->__Validation();

        if ($this->protect == "false") {

            $delete_tags = DB::I()->__QueryString("DELETE FROM tags WHERE p_id = '".intval($_GET["edit"])."'");

            foreach ($_POST["tags"] as $tag) {
                $ins_tags = DB::I()->__InsertItems("tags", array("name" => $this->__LowerCaseString($tag), "p_id" => intval($_GET["edit"])));
            }

            $link = $_POST["page"];

            $sql = DB::I()->__UpdateItem("article", "id='" . intval($id) . "'", array(
                "title" => addslashes($_POST["title"]),
                "seotitle" => addslashes($_POST["seotitle"]),
                "rewrite_url" => $this->__GetTranslyte(trim($_POST["title"])),
                "main" => $this->main,
                "prioritet" => $this->prioritet,
                "shortnews" => $_POST["shortarticle"],
                "fullnews" => $_POST["fullarticle"],
                "status" => $this->status,
                "description" => addslashes($_POST["desc"]),
                "keywords" => addslashes($_POST["keyw"]),
                "p_id" => $link
            ));

            if ($sql == true) {
                setcookie("success", "Ваша статья " . "<strong>'" . $_POST["title"] . "'</strong>" . " успешно от редактирована", time() + 1);
                header("Location: /admin.php?component=pages&model=article&edit=" . $_GET['page'] . "");
            } else {
                
            }
        }
    }

}

class show_article extends article {

    public function __construct() {
        parent::__construct();
        parent::ajax();
    }
}

?>