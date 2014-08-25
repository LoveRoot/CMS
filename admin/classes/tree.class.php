<?php

class tree extends core {

    public $status;
    public $password;

    public function __construct() {
        parent::__construct();

        switch ($_GET["c"]) {
            case "hidden":
                $this->status = 0;
                break;

            default:
                $this->status = 1;
        }

        $this->category = $this->__GetCategory();
    }

    public function __GetCategory() 
    {

        $this->sql = mysqli_query($this->link, "Select * From pages where status='".$this->status."'");
        $this->result = mysqli_fetch_assoc($this->sql);

        if ($this->result == true) {
            $this->tree_cat = array();

            do {
                $this->tree_cat[$this->result["p_id"]][] = $this->result;
            } while ($this->result = mysqli_fetch_assoc($this->sql));

            return $this->tree_cat;
        } else {
            return false;
        }
    }
}

class faqTree extends tree
{
    public function __construct()
    {
         parent::__construct();
         $this->__GetCategory();
    }

    public function __GetCategory() {

        $this->sql = mysqli_query($this->link, "Select * From pages where status='".$this->status."' and type='faq'");
        $this->result = mysqli_fetch_assoc($this->sql);

        if ($this->result == true) {
            $this->tree_cat = array();

            do {
                $this->tree_cat[$this->result["p_id"]][] = $this->result;
            } while ($this->result = mysqli_fetch_assoc($this->sql));

            return $this->tree_cat;
        } else {
            return false;
        }
    }

    public function __GetTreeSelect($p_id, $level, $link) {
        if (isset($this->category[$p_id])) {

            foreach ($this->category[$p_id] as $cat) {

                $bold = $cat["p_id"] == 0 ? 'bold':'normal';
                
                
                $sel_pages = $_GET["edit"] == $cat["link"] ? "selected='selected'" : '';
                $this->cats .= "<option $sel_pages value=".$cat["link"]." style='padding-left:".$level."px; font-weight:".$bold."'>".$cat["title"]."</option>";

                $level = $level + 15;

                $this->__GetTreeSelect($cat["id"], $level, $link);

                $level = $level - 15;
            }
        }
        return $this->cats;
    }
}

class SliderTree extends tree
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __GetTreeMultiSelect($p_id, $level) {

        if (isset($this->category[$p_id])) {

            foreach ($this->category[$p_id] as $cat) {
                $get_this_page = mysqli_query($this->link, "Select sc.category From slidercollection as sc where sc.id = " . intval($_GET['edit']) . "");
                $res = mysqli_fetch_assoc($get_this_page);

                $expl = explode(",", $res["category"]);

                $sel_pages_main = in_array("/", $expl) ? "selected='selected'" : '';
                $sel_pages = in_array($cat["link"], $expl) ? "selected='selected'" : '';

                $this->cats .= "<option " . $sel_pages . "value=" . $cat["id"] . " style='padding-left:" . $level . "px'>" . $cat["title"] . "</option>";

                $level = $level + 15;

                $this->__GetTreeMultiSelect($cat["id"], $level);

                $level = $level - 15;
            }
        }
        return $this->cats;

    }
}

class CategoryTree extends tree
{
    public function __construct()
    {
        parent::__construct();
    }

     public function __GetCategory($type="news") {

        $this->sql = mysqli_query($this->link, "Select * From pages ORDER BY sort");
        $this->result = mysqli_fetch_assoc($this->sql);

        if ($this->result == true) {
            $this->tree_cat = array();

            do {
                $this->tree_cat[$this->result["p_id"]][] = $this->result;
            } while ($this->result = mysqli_fetch_assoc($this->sql));

            return $this->tree_cat;
        } else {
            return false;
        }
    }

    public function __GetTreeSelect($p_id = 0, $level = 0, $link = "") {
        if (isset($this->category[$p_id])) {

            foreach ($this->category[$p_id] as $cat) {

                $bold = $cat["p_id"] == 1 || $cat["p_id"] == 0 ? 'bold':'normal';

                $this->cats .= "<option value=".$cat["id"]." style='padding-left:".$level."px; font-weight:".$bold."'>".$cat["title"]."</option>";

                $level = $level + 15;

                $this->__GetTreeSelect($cat["id"], $level, $link);

                $level = $level - 15;
            }
        }
        return $this->cats;
    }

    public function __GetTree($p_id, $level, $link)
    {
        if (isset($this->category[$p_id]))
	{
            echo "<ul id=\"pages\">";
            
                foreach ($this->category[$p_id] as $cat)
                {
                    $url = "/".$cat["link"].".html";
                    $status = $cat['status'] == 0 ? "hide":"";

                    $type = $cat["type"];

                    echo "<li id=".$cat["id"].">";
                        echo "<a values=".$cat['title']." href=\"javascript:\" class=\"options $status $type\"
                                                      views='".$url."'
                                                      delete='?".$_SERVER["QUERY_STRING"]."&delete=".$cat["id"]."'
                                                      edition='?component=pages&model=".$cat["type"]."&edit=".$cat["link"]."'
                                                      property='type=pages&id=".$cat["id"] . "'>".substr($cat["title"], 0, 40)."</a>";

                        $level = $level + 15;

                        $this->__GetTree($cat["id"], $level, $link);
                    echo "</li>";
                    $level = $level - 15;
                }
            echo "</ul>";
        }
    }

    protected function __DeleteTree($p_id)
    {
         if (isset($this->category[$p_id]))
         {
            foreach ($this->category[$p_id] as $object)
            {
                $sql = mysqli_query($this->link,"Delete From pages where id='".$object["id"]."' and main = 0");

                $this->__DeleteTree($object["id"]);
            }
         }

         if ($sql == true)
         {
             setcookie("success", "Страницы ".$name." успешно удалены...", time() + 1);
             header("Location: " . $_SERVER["HTTP_REFERER"] . "");
         }
           else {
             setcookie("success", "К сожалению вы не можете удалить главную страницу", time() + 1);
             header("Location: ".$_SERVER["HTTP_REFERER"]."");
         }
    }
}

class ArticleTree extends tree {
    public function __construct()
    {
        parent::__construct();
        $this->category = $this->__GetCategory();
    }

    public function __GetCategory() {

        $this->sql = mysqli_query($this->link, "Select * From pages where status='1' and type='article'");
        $this->result = mysqli_fetch_assoc($this->sql);

        if ($this->result == true) {
            $this->tree_cat = array();

            do {
                $this->tree_cat[$this->result["p_id"]][] = $this->result;
            } while ($this->result = mysqli_fetch_assoc($this->sql));

            return $this->tree_cat;

        } else {
            return false;
        }
    }

    public function __GetTreeSelect($p_id = 0, $level = 0, $link = "") {
        if (isset($this->category[$p_id])) {

            foreach ($this->category[$p_id] as $cat) {
                $get_this_page = mysqli_query($this->link, "Select p.title, post.i_category From pages as p, post where p.link = post.i_category and
                                                                                                                                post.id = ".intval($_GET['edit'])."");
                $res = mysqli_fetch_assoc($get_this_page);


                $sel_pages = $cat["title"] == $res["title"] ? "selected='selected'" : '';

                $bold = $cat["p_id"] == 1 || $cat["p_id"] == 0 ? 'bold':'normal';

                $this->cats .= "<option ".$sel_pages." value=".$cat["link"]." style='padding-left:".$level."px; font-weight:".$bold."'>".$cat["title"]."</option>";

                $level = $level + 15;

                $this->__GetTreeSelect($cat["id"], $level, $link);

                $level = $level - 15;
            }
        }
        return $this->cats;
    }

     public function __GetTreeMultiSelect($p_id, $level, $link) {
        if (isset($this->category[$p_id])) {

            foreach ($this->category[$p_id] as $cat) {
                $get_this_page = mysqli_query($this->link, "Select p.title, post.i_category From pages as p, post where p.link = post.i_category and
                                                                                                                                       post.id = " . intval($_GET['edit']) . "");
                $res = mysqli_fetch_assoc($get_this_page);

                $expl = explode(",", $cat["link"]);

                $sel_pages = $cat["title"] == $res["title"] ? "selected='selected'" : '';

                $this->cats .= "<option ".$sel_pages."value=".$cat["link"]." style='padding-left:" . $level . "px'>" . $cat["title"] . "</option>";

                $level = $level + 15;

                $this->__GetTreeMultiSelect($cat["id"], $level, $link);

                $level = $level - 15;
            }
        }
        return $this->cats;
    }

}

?>