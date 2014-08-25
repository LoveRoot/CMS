<?php

class Gallery extends core {

    public function __construct() {
        parent::__construct();
        $this->resID = DB::I()->__SelectItems("pages",array("id","design"),"id='".intval($_GET["edit"])."'");
    }
}

class Images extends Gallery {

    public function __construct() {
        parent::__construct();
    }

    public function __GetImages($id = 0) {
        if ((!empty($id)) && $id !== 0) {
            $id = intval($id);

            $path = "/upload/images/collection/{$id}/";

            $get_img = scandir($_SERVER["DOCUMENT_ROOT"].$path);

            if (empty($get_img))
            echo "В этой коллекции нет изображений";

            foreach($get_img as $img)
            {
                    if ($img == ".." || $img == ".") continue;

                    if (!is_dir($_SERVER["DOCUMENT_ROOT"].$path.$img))

                     $images .= "<li onmouseover=\"__HoverImg(this);\" data-path=".$img.">
                                    <a rel='lightbox' href='".core::host().$path."original/{$img}"."'>
					<img style=\"width:32px\" src='".core::host().$path.$img."' alt='' title='' />
                                        ".$img."
                                    </a>
                                    <input type=\"checkbox\" name=\"objects[]\" style=\"display:none;\" id='" . $page->result["id"] . "' />
                                </li>";
            }

            echo $images;
        }
    }

		public function __DeleteImage($item = 0, $callback = 0) {
			if (!empty($item) && $item !== 0) {
				if (unlink($_SERVER["DOCUMENT_ROOT"]."/upload/images/collection/".$callback."/".$item)) {
					if (unlink($_SERVER["DOCUMENT_ROOT"]."/upload/images/collection/".$callback."/original/".$item)) {
							$this->__GetImages($callback);
							rmdir($_SERVER["DOCUMENT_ROOT"]."/upload/images/collection/".$callback);
					}
				}

			}
		}

}

class Collection extends Gallery {

    protected $status = 1;

    public function __construct($p_id = 0) {
        parent::__construct();
        $this->category = $this->__GetCollection($p_id);
    }

    public function __CreateCollection($name = "", $p_id = 0, $p_coll=0) {
        $p_id = intval($p_id);
        $nameTrans = mb_convert_case($name, MB_CASE_LOWER, "UTF-8");

        $this->sql = $this->__InsertItems("collection", array(
                                                                "p_id" => $p_id,
                                                                "name" => $name,
                                                                "link" => $this->__GetTranslyte($nameTrans),
                                                                "status" => $this->status,
                                                                "p_coll" => $p_coll
                                                             ));
         if ($this->sql == false) {
            die(mysqli_error($this->link));
        }
           else {
            $this->category = $this->__GetCollection($p_id);
            echo $this->__RenderCollection(0);
        }
    }

    public function __GetCollection($p_id = 0) {
        
        $this->result = DB::I()->__SelectItems("collection",array("*"),"p_id = '".$p_id."'");
        
        if ($this->result == true) {
            $this->tree_cat = array();

            do {
                $this->tree_cat[$this->result["p_coll"]][] = $this->result;
            } while ($this->result = mysqli_fetch_assoc(DB::I()->query));

            return $this->tree_cat;
        } else {
            return false;
        }
    }

    public function __RenderCollection($p_coll = 0, $level = 5) {
        if (isset($this->category[$p_coll])) {
            foreach ($this->category[$p_coll] as $cat) {

                $this->col .= "<li style=\"padding-left:".$level."px;\" id=".$cat["id"].">
				<a class=\"options\"
                                   views=".$_REQUEST["edit"]."/".$cat["link"].".html\"
                                   property = \"type=gallery&id=".$cat["id"]."\"
                                   href=\"javascript:\"><img src=\"/admin/template/images/gallery/dir.png\" /></a>
                                  <a href=\"javascript:;\" onclick=\"__select(" . $cat["id"] . ")\">" . $cat["name"] . "</a>

                                  <div class=\"close\">
                                      <a onclick=\"__delete(".$cat["id"].")\" href=\"javascript:;\"><img src=\"/admin/template/images/gallery/remove.png\" alt=\"X\" /></a>
                                  </div>

                                  <div class=\"add\">
                                      <a onclick=\"__AddCollection('".$cat["p_id"]."','".$cat["id"]."')\" href=\"javascript:;\"><img src=\"/admin/template/images/gallery/add.png\" alt=\"+\" /></a>
                                  </div>
			 </li>";

                $level = $level + 15;

                $this->__RenderCollection($cat["id"], $level);

                $level = $level - 15;
            }
        }
        return "<ul>".$this->col."</ul>";
    }

    public function __DeleteCollection($id = 0) {
        if (!empty($id) && $id !== 0) {
            $id = $id;
            $this->sql = mysqli_query($this->link, "Delete From collection where id='" . intval($id) . "'");
            $this->sqlDel = mysqli_query($this->link, "Select id, name From images where id_collection='" . intval($id) . "'");
            $this->results = mysqli_fetch_assoc($this->sqlDel);
            do {
                $sql = mysqli_query($this->link, "Delete From images where id='" . $this->results["id"] . "'");
                if ($sql == true && !empty($this->results["name"])) {
                    if (unlink($_SERVER["DOCUMENT_ROOT"] . "/upload/images/collection/" . $id . "/" . $this->results["name"])) {
                        if (unlink($_SERVER["DOCUMENT_ROOT"] . "/upload/images/collection/" . $id . "/original/" . $this->results["name"])) {
                            if (@rmdir($_SERVER["DOCUMENT_ROOT"] . "/upload/images/collection/" . $id . "/original")) {
                                @rmdir($_SERVER["DOCUMENT_ROOT"] . "/upload/images/collection/" . $id);
                            }
                        }
                    }
                }
            } while ($this->results = mysqli_fetch_assoc($this->sqlDel));
            if ($sql == false) {
                echo "Произошла ошибка при удалении файла:" . mysqli_error($this->link);
            }
        }
    }

}

?>