<?php
    class slider extends core {

        public $access = 1;

        public function __construct() {
            parent::__construct();
        }

        public function __checked() {
            $strlenName = strlen($_POST["name"]);

            if ($strlenName < 5)
                $this->error($this->message[] = "<li>Имя коллекции не должно быть меньше 5 символов</li>");
            
            foreach ($_POST["category"] as $link) {
                $pages .= $link . ",";
            }

            $this->pages = substr($pages, 0, -1);

            if (!empty($this->message)) {
                $this->access = 0;
                echo $this->error();
            }
        }

        public function __Removal($obj="") 
        {
            if (!empty($obj)) 
            {
               if (!is_array($obj))
               $obj = array($obj);

               foreach($obj as $items)
               {
                   $id_coll = intval($items);

                   $this->s_img_small = glob($_SERVER["DOCUMENT_ROOT"]."/upload/slider/collection/{$id_coll}/*.{jpg,png}", GLOB_BRACE);
                   $this->s_img_big = glob($_SERVER["DOCUMENT_ROOT"]."/upload/slider/collection/{$id_coll}/original/*.{jpg,png}", GLOB_BRACE);
                   
                   $this->img = array_merge($this->s_img_small, $this->s_img_big);
                   
                   foreach($this->img as $items) {
                       unlink($items);
                   }

                   $this->collDelete = mysqli_query($this->link, "Delete From slidercollection where id ='".$id_coll."'");
                   
                }

                if ($this->collDelete) {
                     setcookie("success", "Выбранная коллекция успешно удалена", time() + 1);
                     header("Location: /admin.php?component=slider&c=all");
                }
                   else {  
                       $this->message = $this->GetTemplate("SystemMessage", array("SystemMessage" => 
                                                                                  "Произошла ошибка:&nbsp;".mysqli_error($this->link).",&nbsp;невозможно удалить коллекцию"));
                }
            }
        }

    }

    class addCol extends slider {

        public function __construct() {
            parent::__construct();

            if ($_POST) {
                parent::__checked();

                if ($this->access == 1) {
                    
                    $this->sql = $this->__InsertItems("slidercollection", array(
                                                                                 "name" => $_POST["name"],
                                                                                 "category" => $this->pages,
                                                                                 "description" => $_POST["description"],
                                                                                 "status" => 1
                                                                                ));

                    if ($this->sql) {
                        setcookie("success", "Коллекция " . $_POST["name"] . "&nbsp;успешно добавлена...", time() + 1);
                        header("Location: /admin.php?component=slider&c=all");
                    } else {
                        $this->message = $this->GetTemplate("SystemMessage", array("SystemMessage" => "Произошла ошибка:&nbsp;".mysqli_error($this->link)));
                    }
                }
            }
        }

    }

    class editCol extends slider 
    {

        public function __construct() {
            parent::__construct();
            
            $this->result = DB::I()->__SelectItems("slidercollection", array("*"), "id=".intval($_GET["edit"]));
        }

        public function __InsertSliderImage($name="", $path="", $collection="") 
        {
            $result = DB::I()->__SelectItems("slider",array("*"), "name='".$name."' and collection='".$collection."'");

            if (!$result) {
                
                $insert = DB::I()->__InsertItems("slider", array(
                                                                  "name" => $name,
                                                                  "src" => $path,
                                                                  "collection" => $collection,
                                                                  "status" => 1
                                                                ));
            }
        }

        public function __UpdateSliderImage($title, $category, $description, $id) {
            foreach ($category as $link) {
                $cat .= $link . ",";
            }

            $cat = substr($cat, 0, -1);
            
            $this->__UpdateItem("slidercollection", "id=".$id, array(
                                                                "name" => $title,
                                                                "category" => $cat,
                                                                "description" => $description
                                                               ));
  

            if ($this->result == true) {
                header("Location: /admin.php?component=slider&c=all");
                setcookie("success", "Ваша коллекция " . "<strong>'" . $title . "'</strong>" . " успешно обновлена...", time() + 1);
            } else {
                echo $this->GetMessage("ShowAlert", array("caption" => "<h1>К сожалению</h1>", "ShowAlert" => "Произошла критическая ошибка ошибка:<br />".mysqli_error($this->link)));
            }
        }

        public function ImgRemove($id) {
            $this->sql = mysqli_query($this->link, "Delete From slider where id='" . $id . "'");
        }

    }

    class showCol extends slider {

        public function __construct() {
            parent::__construct();
            parent::__Removal();
        }

    }
    
    class ShowImages extends slider {
        public function __construct($path) {
            $this->__GetImgFromDir($path);
        }
        
        public function __GetImgFromDir($path) {
           $this->get_img = scandir($_SERVER["DOCUMENT_ROOT"].$path);
           return $this->get_img;
        }
    }

?>