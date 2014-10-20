<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_pages
 *
 * @author s.novoseletskiy
 */
class model_pages extends Model {

    public $pages;

    public function __construct() {
        $this->category = $this->Category();
    }

    public function AddPage($array) {

        $add = Model::InsertItems("pages", array(
                    "name" => $array["name"],
                    "h1" => $array["h1"],
                    "short_content" => $array["short_text"],
                    "status" => 1,
                    "is_catalog" => 1,
                    "page_type" => $array["type"],
                    "title" => $array["title"],
                    "keywords" => $array["keywords"],
                    "description" => $array["description"],
                    "template" => "default",
                    "p_id" => $array["p_id"]
        ));

        if ($add == true && !empty($array["url"])) {
            $add_url = Model::InsertItems("url", array("url" => $array["url"].".html", "module" => $array["type"], "action" => "index", "p_id" => $add));
        }

        if ($add == true) {
            Model::Redirect301("/admin.php?component=pages&action=index");
        }
    }

    public function UpdatePage($array) {
        $update = Model::UpdateItem("pages", "id={$array["id"]}", array(
                                             "name" => $array["name"],
                                             "h1" => $array["h1"],
                                             "short_content" => $array["short_text"],
                                             "status" => $array["status"],
                                             "title" => $array["title"],
                                             "keywords" => $array["keywords"],
                                             "description" => $array["description"],
                                             "template" => "default",
        ));
        if ($update == true && !empty($array["url"])) {
              $add_url = Model::InsertItems("url", array("url" => $array["url"].".html", "module" => $array["type"], "action" => "index", "p_id" => $array["id"]));
              if ($add_url == false) {
                  $update_url = Model::UpdateItem("url", "p_id = {$array["id"]}", array("url" => $array["url"].".html"));
              }
        }

        if ($update == true) {
            Model::Redirect301("/admin.php?component=pages&action=index");
        }
    }

    public function GetDataPage($id) {
        $result = Model::QueryString("SELECT p.*, u.url FROM pages p LEFT JOIN url u ON p.id = u.p_id WHERE p.id = {$id}");
        return $result;
    }

    public function GetDataElements($id=1) {
        $result = Pagination::SetPagination("SELECT name, status, id FROM pages WHERE p_id = {$id} and is_catalog = 0",
                                            "SELECT id FROM pages WHERE p_id = {$id} and is_catalog = 0", 15);
        return $result;
    }

    public function Delete($p_id = 0) {
        $sql = Model::DeleteItem("pages", "id='{$p_id}' and system = 0");
				$del_url = Model::DeleteItem("url", "p_id='{$p_id}'");
        if (isset($this->category[$p_id])) {
            foreach ($this->category[$p_id] as $object) {
                $sql = Model::DeleteItem("pages", "id='" . $object["id"] . "' and system = 0");
								$del_url = Model::DeleteItem("url", "p_id='{$p_id}'");
                $this->Delete($object["id"]);
            }
        } else {
            Model::Redirect301($_SERVER["HTTP_REFERER"]);
        }
    }

    public function Category() {
        $result = Model::QueryString("Select id, p_id, name, status, page_type, is_catalog, system From pages WHERE is_catalog = 1 ORDER By sort");

        if ($result == true) {
            $this->tree_cat = array();
            do {
                if (!$result["id"])
                    continue;
                $this->tree_cat[$result["p_id"]][] = $result;
            } while ($result = mysqli_fetch_assoc(Model::$query));
            return $this->tree_cat;
        } else {
            return false;
        }
    }

    public function GetPages($p_id = 0) {
        if (isset($this->category[$p_id])) {

            $this->pages .= "<ul>";

            foreach ($this->category[$p_id] as $cat) {

                $bold = $cat["p_id"] == 0 ? 'bold' : 'normal';

                $this->pages .= "<li>";

                $active = $cat["status"] == 0 ? "invisible" : "";

                $this->pages .= "<a href='javascript:;' class='{$cat["page_type"]} {$active}' onclick='open_property(event, this, " . $cat["id"] . ")' data-itemid = '{$cat["id"]}' data-catalog='{$cat["is_catalog"]}'>" . $cat["name"] . "</a>";

                $this->GetPages($cat["id"]);

                $this->pages .= "</li>";
            }
            $this->pages .= "</ul>";
        }
        return $this->pages;
    }

    public function GetRazdel($p_id = 0, $level = 0) {
        if (isset($this->category[$p_id])) {

            foreach ($this->category[$p_id] as $razdel) {
                $selected = isset($_GET["p_id"]) && $razdel["id"] == $_GET["p_id"] ? "selected='selected'" : "";
                $this->pages .= "<option value='{$razdel["id"]}' style='margin-left:{$level}px' {$selected}>{$razdel["name"]}</option>";

                $level = $level + 15;

                $this->GetRazdel($razdel["id"], $level);

                $level = $level - 15;
            }
        }
        return $this->pages;
    }

}
