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

					$active = $cat["status"] == 0 ? "invisible" :"";

					$this->pages .= "<a href='javascript:;' class='{$cat["page_type"]} {$active}' onclick='open_property(event, this, ".$cat["id"].")' data-itemid = '{$cat["id"]}' data-catalog='{$cat["is_catalog"]}'>".$cat["name"]."</a>";

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
						$selected = isset($_GET["p_id"]) && $razdel["id"] == $_GET["p_id"]?"selected='selected'":"";
						$this->pages .= "<option value='{$razdel["id"]}' style='margin-left:{$level}px' {$selected}>{$razdel["name"]}</option>";

						$level = $level + 15;

            $this->GetRazdel($razdel["id"], $level);

            $level = $level - 15;
					}
				}
				return $this->pages;
		}

	}
