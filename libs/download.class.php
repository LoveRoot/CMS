<?php
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
        public function __construct()
        {

				}

				public function SingleDownload() {
					 $this->filetype = explode(".", $_FILES["filename"]["name"]);
					 $this->randName = rand(0, 100);
					 $this->filename = "news_".$this->randName.".".$this->filetype[1];

					 $this->target_thumb_path = $this->thumb_path.$this->filename;
					 $this->target_big_path = $this->big_path.$this->filename;

					 $this->tmp_name = $_FILES['filename']['tmp_name'];

					 if (!in_array($this->filetype[1], self::$black_list)) {
							if (in_array($this->filetype[1], $this->imageMime))
								return $this->__Download($this->array["size"]["thumb"],
																				 $this->array["size"]["big"], $this->filename);
					 }
				}

				public function MultipleDownload() {
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
                       return $this->__Download($this->array["size"]["thumb"], $this->array["size"]["big"], $this->filename);
                 }
             }
				}

				public function Download($array)
				{
						$this->array = $array;

						$this->big_path = $_SERVER["DOCUMENT_ROOT"].$this->array["path"]["big"];
            $this->thumb_path = $_SERVER["DOCUMENT_ROOT"].$this->array["path"]["thumb"];

            $this->filetype = explode(".", $_FILES["filename"]["name"]);
            $this->imageMime = array("bmp", "jpg", "png", "gif");

						if($this->array["options"]["multiple"] == 0) {
							return $this->SingleDownload();
						}	else {
							return $this->MultipleDownload();
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

                if ($this->array["options"]["preview"] == 1) {

									return $this->ArrImgPreview($this->array["path"]["thumb"], $this->array["path"]["big"], $filename);
								}

            }
        }

				public function ArrImgPreview($thumb, $big, $filename)
        {
						$this->arrImg = array();
						$this->arrImg["name"] = $filename;
						$this->arrImg["thumb"] = $thumb.$this->filename;
						$this->arrImg["big"] = $big.$this->filename;

						return $this->arrImg;
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
    }



?>