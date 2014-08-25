<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/admin/classes/slider.class.php");
	
	$core = new slider();
	$slider = new editCol();

	if ($_FILES)
	{	
		@mkdir($_SERVER["DOCUMENT_ROOT"]."/upload/slider/", 0775);
		@mkdir($_SERVER["DOCUMENT_ROOT"]."/upload/slider/collection".$_POST["collection"], 0775);
		@mkdir($_SERVER["DOCUMENT_ROOT"]."/upload/slider/collection".$_POST["collection"]."/".date("d-m-Y"), 0775);
		
		foreach($_FILES["filename"]["name"] as $k => $v)
		{		
			$path = $_SERVER["DOCUMENT_ROOT"]."/upload/slider/collection".$_POST["collection"]."/".date("d-m-Y")."/".$_FILES["filename"]["name"][$k];
						
			$path_insert = "/upload/slider/collection".$_POST["collection"]."/".date("d-m-Y")."/".$_FILES["filename"]["name"][$k];
					
			$max_width = 600;
			$max_height = 260;
			
			if(preg_match('/[.](jpg)|(gif)|(png)$/',$_FILES["filename"]["name"][$k]))
			{
				if (move_uploaded_file($_FILES["filename"]["tmp_name"][$k], $path))
				{
					if(preg_match('/[.](jpg)$/', $_FILES["filename"]["name"][$k]))
					{
						$im = imagecreatefromjpeg($path);
						@chmod($path, 0777);
					}
						else if(preg_match('/[.](gif)$/', $_FILES["filename"]["name"][$k]))
					{	
						$im = imagecreatefromgif($path);
						@chmod($path, 0777);
					}			
						else if(preg_match('/[.](png)$/', $_FILES["filename"]["name"][$k]))
					{
						$im = imagecreatefrompng($path);
						@chmod($path, 0777);
					}
					
					$sizeImg = GetImageSize($_SERVER["DOCUMENT_ROOT"]."/upload/slider/collection".$_POST["collection"]."/".date("d-m-Y")."/".$_FILES["filename"]["name"][$k]);
			
					$img_w = $sizeImg[0];
					$img_h = $sizeImg[1];
								
					$koe = $img_w / 460;		
					$new_h = ceil($img_h / $koe);
							
					$image_mask = @imagecreatetruecolor(600, $new_h);
					$color = @imagecolorallocate($image_mask, 0, 0, 0, 0);
					@imagecolortransparent($image_mask, $color); 

					@imagecopyresampled($image_mask, $im, 0, 0, 0, 0, 600, $new_h, $img_w, $img_h);
					@Imagepng($image_mask, $path);
					
					$slider->__InsertSliderImage($_FILES["filename"]["name"][$k], $path_insert, $_GET["collection"]);
				}
			}
		}
	}
?>