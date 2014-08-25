<?php

    class tree extends Model
    {

        public function __construct($where="") 
        {
            parent::__construct();
 
            $this->where = !empty($where) ? "where ".$where : "";
            
            $this->status = core::I()->__config("rend_cat_auto");
            $this->category = $this->__GetCategory();
        }

        public function __GetCategory() {

            $this->sql = mysqli_query($this->link, "Select id, p_id, link, title, status, type From pages $this->where ORDER By sort");
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

        public function __GetTree($p_id = 1, $level = 0, $count = 0) 
        {
            if (isset($this->category[$p_id])) 
            {

                $this->cats .= "<ul>";

                foreach ($this->category[$p_id] as $cat) {
                    switch ($cat["link"]) {
                        case "/":
                            $url = "/";
                            break;

                        default:
                            $url = "/" . $cat["link"] . ".html";
                    }

                    $deurl = explode("/", $url);
                    $model = explode(".", $this->route[0]);

                    $bold = $cat["p_id"] == 0 ? 'bold' : 'normal';
                    
                    $active = isset($_GET["p_id"]) && $_GET["p_id"] == $cat["id"] || $cat["id"] == $_GET["id"] ? 'active' : '';

                    $this->cats .= "<li>";

                    $this->cats .= "<a class='" . $active . "' href='" . $url . "'>" . $cat["title"] . "</a>";

                    $count++;

                    $this->__GetTree($cat["id"], $level, $count);

                    $this->cats .= "</li>";

                    $count--;
                }
                $this->cats .= "</ul>";
            }
            return $this->cats;
        }

        public function __GetTreeSelect($p_id = 0, $level = 0) {
            if (isset($this->category[$p_id])) {

                foreach ($this->category[$p_id] as $cat) {
                    if ($cat["p_id"] == 0)
                    $font = "font-weight:bold";
                    
                    $sel_pages = isset($_GET["page"]) && intval($_GET["page"]) == $cat["id"] ? "selected='selected'" : '';
                    
                    $this->cats .= "<option $sel_pages value=" . $cat["id"] . " style='padding-left:" . $level . "px;" . $font . "'>" . $cat["title"] . "</option>";

                    $level = $level + 15;

                    $this->__GetTreeSelect($cat["id"], $level);

                    $level = $level - 15;
                }
                return $this->cats;
            }
        }
    }
    
    class CommentTree extends tree {
        public function __construct($id_post = 0) {
            $this->tree_comments = $this->__GetCommentTree($id_post);
        }
        
        public function __GetCommentTree($id_post) 
        {            
            $this->assign = new pagination("SELECT c.*, u.avatar  FROM comments AS c
                                                            INNER JOIN users AS u ON (c.author = u.login)
                                                            WHERE id_post='".intval($id_post)."'",
                                     "SELECT id FROM comments AS c where id_post='".intval($id_post)."'", 1);
            
            $this->id = $this->assign->result["p_id"];
            
            $this->navigation = $this->assign->navigation("http://".$_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI']."?page=");
            
            $this->arr_tree = array();
            
            do
            {
                $this->arr_tree[$this->assign->result["p_id"]][] = $this->assign->result;   
            }
            while($this->assign->result = mysqli_fetch_assoc($this->assign->sql)); 
            
            return $this->arr_tree;

            
        }
        
        public function __RenderComments($p_id=0, $level=0) {
            if (isset($this->tree_comments[$p_id])) 
            {
                foreach($this->tree_comments[$p_id] as $this->items) 
                {  
                   echo  $count_post = $this->items["count_post"];
                    
                     $this->c .= "<div class=\"comments-block\" style=\"padding-left:".$level."px\" id='".$this->items["id"]."'>";
                       
                       $this->c .= "<div class=\"comments-story\">";
                            
                           $this->c .= "<div class=\"comleft\">";
                                
                               $this->c .= "<div class=\"comfoto\"><img src=\"/upload/avatar/".$this->items["author"]."/".$this->items["avatar"]."\" alt=\"Аватар участника\" /></div>";
                                
                               $this->c .= "<div class=\"comuser\">Публикаций: ".$count_post."<br>Комментариев: {count-comm}</div>";
                                
                               $this->c .= "<div class=\"cmoreinfo\">{date} | {ip}</div>";
                               
                           $this->c .= "</div>";    
                            
                           $this->c .= "<div class\"comright\">";  
                            
                                $this->c .= "<h1 class=\"argr\">Комментарий № ".$this->items["id"]."</h1>";
                                    
                                $this->c .= "<div class=\"author_post\" article=".$this->items["author"]."><h2>Автор:&nbsp;".$this->items["author"]."</h2></div>";
                                 
                                $this->c .= "<div class=\"text\">".$this->items["text"]."</div>";
                                 
                                $this->c .= "<div class=\"clr\">";
                                 
                                $this->c .= "</div>";
                                
                           $this->c .= "</div>";  
                    
                       $this->c .= "</div>";
                    
                    $this->c .= "</div>";
                    
                    $level = + 50;
                    
                    $this->__RenderComments($this->items["id"], $level);
                    
                    $level = 0;
                }   

                return $this->c;
            } 
        }
    }
    
    class AdminTree extends tree
    {
        public function __construct($where="") {
            $this->where = $where;
            parent::__construct($this->where);
            $this->category = $this->__GetCategory();                     
        }
        
         public function __GetTree($p_id=0, $level=0, $link="")
        {
            if (isset($this->category[$p_id]))
            {
                $this->pages .= "<ul id=\"pages\">";

                    foreach ($this->category[$p_id] as $cat)
                    {
                        $url = "/".$cat["link"].".html";
                        $status = $cat['status'] == 0 ? "hide":"";

                        $type = $cat["type"];

                        $this->pages .=  "<li id=".$cat["id"].">";
                            $this->pages .=  "<a values=".$cat['title']." href=\"javascript:\" class=\"options $status $type\"
                                                          views='".$url."'
                                                          delete='?".$_SERVER["QUERY_STRING"]."&delete=".$cat["id"]."'
                                                          edition='?component=pages&model=".$cat["type"]."&edit=".$cat["id"]."'
                                                          property='type=pages&id=".$cat["id"] . "'>".substr($cat["title"], 0, 40)."</a>";

                            $level = $level + 15;

                            $this->__GetTree($cat["id"], $level);
                        $this->pages .=  "</li>";
                        $level = $level - 15;
                    }
                $this->pages .=  "</ul>";
            }
            
            return $this->pages;
        }
        
        public function __GetTreeSliderMultiSelect($p_id, $level) 
        {
            if (isset($this->category[$p_id])) {

                foreach ($this->category[$p_id] as $cat) {
                    $get_this_page = mysqli_query($this->link, "Select sc.category From slidercollection as sc where sc.id = " . intval($_GET['edit']) . "");
                    $res = mysqli_fetch_assoc($get_this_page);

                    $expl = explode(",", $res["category"]);

                    $sel_pages_main = in_array("/", $expl) ? "selected='selected'" : '';
                    $sel_pages = in_array($cat["id"], $expl) ? "selected='selected'" : '';

                    $this->cats .= "<option " . $sel_pages . "value=" . $cat["id"] . " style='padding-left:" . $level . "px'>" . $cat["title"] . "</option>";

                    $level = $level + 15;

                    $this->__GetTreeSliderMultiSelect($cat["id"], $level);

                    $level = $level - 15;
                }
            }
            return $this->cats;
        }
        
        protected function __PageDeleteTree($p_id)
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
    
?>
