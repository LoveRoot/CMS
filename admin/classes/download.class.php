<?php

    include_once($_SERVER["DOCUMENT_ROOT"] . "/admin/classes/gallery.class.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/admin/classes/slider.class.php");

    class Download {

        static $black_list = array("php", "phtml",
                                   "html", "js",
                                   "bmp", "exe");
        public $col = 0;

        public function __construct() {

        }

    }

    class SimpleDownload extends Download
    {
        public function __construct($path="", $path_views="", $imgsize, $view_preview=false)
        {
            
        }
    }

    class MultipleDownload extends Download
    {
        public function __construct($path="", $path_views="", $imgsize, $view_preview=false)
        {

            $this->view_preview = $view_preview;

            if (isset($imgsize) && !empty($imgsize)) {
                $this->thumb_width = $imgsize["thumb"];
                $this->big_width = $imgsize["normal"];
            }

            mkdir($path."/original/", 775);
            mkdir($path."/", 775);

            $this->big_path = $path."/original/";
            $this->thumb_path = $path."/";

            $this->filetype = explode(".", $_FILES["filename"]["name"][$k]);
            $this->imageMime = array("bmp", "jpg", "png", "gif");

             foreach ($_FILES["filename"]["name"] as $k => $v)
             {
                 $this->filetype = explode(".", $_FILES["filename"]["name"][$k]);
                 $this->randName = rand(0, 100);
                 $this->filename = "new_".$this->randName.".".$this->filetype[1];

                 $this->target_thumb_path = $this->thumb_path.$this->filename;
                 $this->target_big_path = $this->big_path.$this->filename;

                 $this->thumb_img_views = $path_views."/".$this->filename;
                 $this->big_img_views = $path_views."/original/".$this->filename;

                 $this->tmp_name = $_FILES['filename']['tmp_name'][$k];

                 if (!in_array($this->filetype[1], self::$black_list)) {
                    if (in_array($this->filetype[1], $this->imageMime))
                       echo $this->__Download($this->thumb_width, $this->big_width, $this->filename);
                 }
             }
        }

        public function __Download($thumb_width, $big_width, $filename)
        {
            if (move_uploaded_file($this->tmp_name, $this->target_thumb_path))
            {
                switch ($this->filetype[1]) {
                    case "bmp":
                        $this->im = imagecreatefrombmp($this->target_thumb_path);
                        break;

                    case "png":
                        $this->im = imagecreatefrompng($this->target_thumb_path);
                        break;

                    case "gif":
                        $this->im = imagecreatefromgif($this->target_thumb_path);
                        break;

                    default:
                        $this->im = imagecreatefromjpeg($this->target_thumb_path);
                }

                // Нормальный размер

                list($this->width, $this->height) = GetImageSize($this->target_thumb_path);

                $this->koe = $this->width / $big_width;

                $this->new_h = ceil($this->height / $this->koe);

                $this->image_mask = imagecreatetruecolor($big_width, $this->new_h);

                imagecopyresampled($this->image_mask, $this->im, 0, 0, 0, 0, $big_width, $this->new_h, $this->width, $this->height);

                if ($this->filetype[1] == "png")
                Imagepng($this->image_mask, $this->target_big_path);
                else
                Imagejpeg($this->image_mask, $this->target_big_path);

                // Миниатюра

                $this->thumb_koe = $this->width / $thumb_width;

                $this->thumb_new_h = ceil($this->height / $this->thumb_koe);

                $this->thumb_image_mask = imagecreatetruecolor($thumb_width, $this->thumb_new_h);
                $this->thumb_color = imagecolorallocate($this->thumb_image_mask, 0, 0, 0, 0);
                imagecolortransparent($this->thumb_image_mask, $this->thumb_color);

                imagecopyresampled($this->thumb_image_mask, $this->im, 0, 0, 0, 0, $thumb_width, $this->thumb_new_h, $this->width, $this->height);

                if ($this->filetype[1] == "png")
                Imagepng($this->thumb_image_mask, $this->target_thumb_path);
                else
                Imagejpeg($this->thumb_image_mask, $this->target_thumb_path);


                if ($this->view_preview == 1)
                $this->__Finished($this->thumb_img_views, $this->big_img_views, $filename);
            }
        }

        private function __Finished($thumb, $big, $filename)
        {
            echo "<div class=\"imgBox\">";
            echo "<p>Название: " . $filename . "</p>";

            echo "<div class=\"img\">
                        <a rel=\"lightbox\" href=" . $big . "><img src=" . $thumb . " /></a>
                  </div>";
            echo "</div>";
        }
    }

    class DownloadSlider extends Download
    {
        public function __construct($path, $thumb_width = 240, $big_width = 600, $col = 0)
        {

            $this->col = intval($col);

            if (!empty($_FILES))
            {
                @mkdir($path . "/collection", 775);
                @mkdir($path . "/collection/" . $col, 775);
                @mkdir($path . "/collection/" . $col . "/original/", 775);

                $this->path = $path . "/collection/".$this->col."/";
                $this->path_original = $path."/collection/".$this->col."/original/";
                $this->filetype = explode(".", $_FILES["filename"]["name"][$k]);
                $this->imageMime = array("bmp", "jpg", "png", "gif");

                foreach ($_FILES["filename"]["name"] as $k => $v)
                {
                    $this->filetype = explode(".", $_FILES["filename"]["name"][$k]);
                    $this->randName = rand(0, 100);
                    $this->filename = "new_".$this->randName.".".$this->filetype[1];
                    $this->target = $this->path.$this->filename;

                    $this->img_views = "http://" . $_SERVER["HTTP_HOST"] . "/upload/slider/collection/".$this->col."/".$this->filename;
                    $this->img_views_big = "http://" . $_SERVER["HTTP_HOST"] . "/upload/slider/collection/".$this->col."/original/".$this->filename;
                    $this->target_original = $this->path_original.$this->filename;
                    $this->tmp_name = $_FILES['filename']['tmp_name'][$k];
                    $this->filetype = explode(".", $_FILES["filename"]["name"][$k]);

                    if (!in_array($this->filetype[1], self::$black_list)) {
                        if (in_array($this->filetype[1], $this->imageMime))
                            echo $this->__Download($thumb_width, $big_width, $this->filename);
                    }
                }
            }
        }

        public function __Download($thumb_width, $big_width, $filename)
        {
             if (move_uploaded_file($this->tmp_name, $this->target))
            {

                switch ($this->filetype[1]) {
                    case "bmp":
                        $this->im = @imagecreatefrombmp($this->target);
                        break;

                    case "png":
                        $this->im = @imagecreatefrompng($this->target);
                        break;

                    case "gif":
                        $this->im = @imagecreatefromgif($this->target);
                        break;

                    default:
                        $this->im = @imagecreatefromjpeg($this->target);
                }

                // РЈРІРµР»РёС‡РµРЅРёРµ
                $sizeImg = GetImageSize($this->target);

                $this->img_w = $sizeImg[0];
                $this->img_h = $sizeImg[1];

                $this->koe = $this->img_w / $big_width;

                $this->new_h = @ceil($this->img_h / $this->koe);

                $this->image_mask = @imagecreatetruecolor($big_width, $this->new_h);
                $this->color = @imagecolorallocate($this->image_mask, 0, 0, 0, 0);
                @imagecolortransparent($this->image_mask, $this->color);

                @imagecopyresampled($this->image_mask, $this->im, 0, 0, 0, 0, $big_width, $this->new_h, $this->img_w, $this->img_h);

                if ($this->filetype[1] == "png")
                Imagepng($this->image_mask, $this->target_original);
                else
                Imagejpeg($this->image_mask, $this->target_original);

                // РјРёРЅРёР°С‚СЋСЂР°
                $thumb_sizeImg = GetImageSize($this->target);

                $this->thumb_img_w = $thumb_sizeImg[0];
                $this->thumb_img_h = $thumb_sizeImg[1];

                $this->thumb_koe = $this->thumb_img_w / $thumb_width;

                $this->thumb_new_h = @ceil($this->thumb_img_h / $this->thumb_koe);

                $this->thumb_image_mask = @imagecreatetruecolor($thumb_width, $this->thumb_new_h);
                $this->thumb_color = @imagecolorallocate($this->thumb_image_mask, 0, 0, 0, 0);
                @imagecolortransparent($this->thumb_image_mask, $this->thumb_color);

                @imagecopyresampled($this->thumb_image_mask, $this->im, 0, 0, 0, 0, $thumb_width, $this->thumb_new_h, $this->thumb_img_w, $this->thumb_img_h);

                if ($this->filetype[1] == "png")
                Imagepng($this->thumb_image_mask, $this->target);
                else
                Imagejpeg($this->thumb_image_mask, $this->target);

                $this->__Finished($this->img_views, $filename);
            }
        }

        private function __Finished($views, $filename)
        {
            $insert = new editCol();
            $insert->__InsertSliderImage($filename, $path="", $this->col);
        }
    }


    class DownloadLogo extends Download
    {
        public function __construct($path, $height=120,  $id = 0)
        {
            $this->id = intval($id);

             if (!empty($_FILES))
             {
                mkdir($path."/logo", 775);
                mkdir($path."/logo/".$this->id, 775);

                $this->path = $path."/logo/".$this->id."/";
                $this->filetype = explode(".", $_FILES["filename"]["name"]);
                $this->imageMime = array("bmp", "jpg", "png", "gif");
                $this->randName = rand(0, 100);
                $this->filename = "logo".".".$this->filetype[1];
                $this->tmp_name = $_FILES['filename']['tmp_name'];
                $this->target = $this->path.$this->filename;
                $this->img_views = "http://".$_SERVER["HTTP_HOST"]."/upload/pages/logo/".$this->id."/".$this->filename;


                if (!in_array($this->filetype[1], self::$black_list)) {
                    if (in_array($this->filetype[1], $this->imageMime))
                      echo $this->__Download($height, $this->filename);
                }
             }
        }

        public function __Download($height, $filename)
        {
            if (move_uploaded_file($this->tmp_name, $this->target)) {
                switch ($this->filetype[1]) {
                    case "bmp":
                        $this->im = @imagecreatefrombmp($this->target);
                        break;

                    case "png":
                        $this->im = @imagecreatefrompng($this->target);
                        break;

                    case "gif":
                        $this->im = @imagecreatefromgif($this->target);
                        break;

                    default:
                        $this->im = @imagecreatefromjpeg($this->target);
                }

                // миниатюра
                $thumb_sizeImg = GetImageSize($this->target);

                $this->thumb_img_w = $thumb_sizeImg[0];
                $this->thumb_img_h = $thumb_sizeImg[1];

                $this->thumb_koe = $this->thumb_img_h / $height;

                $this->thumb_new_w = @ceil($this->thumb_img_w / $this->thumb_koe);

                $this->thumb_image_mask = @imagecreatetruecolor($this->thumb_new_w, $height);
                $this->thumb_color = @imagecolorallocate($this->thumb_image_mask, 0, 0, 0, 0);
                @imagecolortransparent($this->thumb_image_mask, $this->thumb_color);

                @imagecopyresampled($this->thumb_image_mask, $this->im, 0, 0, 0, 0, $this->thumb_new_w, $height, $this->thumb_img_w, $this->thumb_img_h);

                if ($this->filetype[1] == "png")
                Imagepng($this->thumb_image_mask, $this->target);
                else
                Imagejpeg($this->thumb_image_mask, $this->target);

                $this->__Finished($this->img_views, $filename);
            }
        }

        final function __Finished($items, $name = "")
        {
            echo "<img src=".$items." alt=\"\" title=\"\" /><div><a onclick=\"__DeleteLogo('$this->target')\" href=\"javascript:\">Удалить</a></div>";
        }
    }

    final class SaveGallery extends Gallery {

        public function __construct($arrTitle, $arrAlt, $arrName, $col = 0) {
            parent::__construct();

            foreach ($arrTitle as $key => $val) {
                $this->sql = mysqli_query($this->link, "Insert into images(name, alt, title, id_collection)
							Values('" . $arrName[$key] . "','" . $arrAlt[$key] . "','" . $val . "','" . $col . "')");
            }

            if ($this->sql) {
                echo "<h2>Успех:</h2><div id=\"empty\">Ваша галерея успешно сохранена...<br />Перейти <a href=\"javascript:\" onclick=\"__select(" . $col . ")\">к галереи</a> || <a style=\"background:none !important; padding:0 !important; display:inline !important;\" id=\"AddImages\" href=\"javascript:\" onclick=\"AddImages();\">загрузить ещё</a></div>";
            } else {
                echo "<h2>Произошла ошибка:</h2>" . "<div id=\"empty\">" . mysqli_error($this->link) . "</div>";
            }
        }
    }

?>