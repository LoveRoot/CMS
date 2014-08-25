<?php

class MailingGroups extends DB {

    public function __construct() {
        parent::__construct();
        $this->m_groups .= $this->GetMailingGroups();
        $this->GetAllMailingUsers();
    }

    public function AddGroup($data) {
        $this->__InsertItems("mailing_groups", array(
            "name" => mysql_escape_string($data)
        ));
        echo $this->GetMailingGroups();
    }

    public function GetMailingGroups() {
        $content = "";
        $data = $this->__SelectItems("mailing_groups", array("*"));
        do {
            $templ = new QTemplate($_SERVER["DOCUMENT_ROOT"] . "/admin/template/mailing/", "groups");
            $templ->assign_vars(array("id" => $data["id"], "name" => $data["name"]));
            $content .= $templ->render();
        } while ($data = mysqli_fetch_assoc($this->query));

        return $content;
    }

    public function RemoveCatalog($item) {
        $remove = $this->__DeleteRows("mailing_groups", "id='{$item}'");
        if ($remove == true) {
            echo "success";
        }
    }

    public function GetAllMailingUsers() {
        $this->mails = new pagination("SELECT id, email, status From mailing", "SELECT id, email, status From mailing", 10);
    }

}

class MailingUsers extends DB {

    public function __constrcut() {
        parent::__construct();
    }

    public function UsersMove($g_id = 0, $id = 0) {
        $result = $this->__UpdateItem("mailing", "id='" . $id . "'", array("id_group" => $g_id));
        if ($result == true) {
            echo "success";
        }
    }

    public function ViewCatalog($id) {
        if ($id !== 0)
            $where = "where id_group='" . $id . "'";
        else
            $where = "";

        $mails = new pagination("SELECT id, email, status From mailing {$where}", "SELECT id, email, status From mailing {$where}", 10);
        echo $this->CatalogView($mails);
    }

    public function CatalogView($array) {
        $this->array = $array;
        if ($this->array->result == true) {
            $this->list = "<ul>";
            do {
                $this->list .= "<li id=".$this->array->result["id"] . " class=\"ui-draggable\">
                                    <input type=\"checkbox\" name=\"sel[]\" id=\"sel".$this->array->result["id"]."\" onclick=\"count_checkbox();\" value=".$this->array->result["id"]." />
                                    <label for=\"sel".$this->array->result["id"] . "\">" . $this->array->result["email"]."</label>
				</li>";
            } while ($this->array->result = mysqli_fetch_assoc($this->array->sql));
            $this->list .= "</ul>";

            return $this->list;
        } else {
            return "В данной группе подписчики не обнаружены";
        }
    }

    public function GetUsersById($arr_id) {
        $this->users = $this->__SelectItems("mailing", array("*"), "id IN ({$arr_id})");
        do {
            $this->data .= "<li>" .
                    "<input type=\"checkbox\" name=\"sel[]\" id=\"sel" . $this->users["id"] . "\" value=" . $this->users["email"] . " checked />" .
                    "<label for=\"sel" . $this->users["id"] . "\">" . $this->users["email"] . "</label>" .
                    "</li>";
        } while ($this->users = mysqli_fetch_assoc($this->query));

        return $this->data;
    }

}

class MailSend extends core {

    public $title;
    public $message;
    public $object;

    public function __construct($title = "", $message = "", $object = "") {
        $this->title = $title;
        $this->message = $message;
        $this->object = $object;

        $this->Validation($this->title, $this->message, $this->object);
    }

    public function Validation($title, $message, $object) {
        $this->message = array();

        if (!preg_match("/^([А-яа-яa-z0-9])/i", $title))
            $this->error($this->message[] = "<li>Заголовок рассылки содержит недопустимые символы</li>");

        if (empty($message))
            $this->error($this->message[] = "<li>Поле сообщение недолжно быть пустым</li>");

        if (!empty($this->message)) {
            $this->Abort($this->error());
        } else {
            $this->Send($title, $message, $object);
        }
    }

    public function Abort($error) {
//        echo $this->GetTemplate("ShowAlert", array("caption" => "<h1>Внимание !</h1>", "ShowAlert" => $error));
          echo $this->GetMessageError($error);
    }

    public function Send($title, $message, $object) {

        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";
        foreach ($object as $item) {
            $send = MailSender::I()->SendMailing($item, $title, $message);
//						$send = mail($item, $title, $message, $headers);
        }
        echo "success";
//	echo $this->GetTemplate("ShowAlert", array("caption" => "<h1>Поздравялем !</h1>", "ShowAlert" => "<p>Ваше сообщение успешно отправлено.</p>"));
    }

}

?>
