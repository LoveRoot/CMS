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
			$result = Model::QueryString("Select id, p_id, name, status, is_catalog, page_type, system From pages ORDER By sort");

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

					if ($cat["is_catalog"] == 1) {
							$this->pages .= "<a href='javascript:;' class='{$cat["page_type"]}' onclick='open_property(this)'>".$cat["name"]."</a>";

							if ($cat["page_type"] !== "main" && $cat["page_type"] !== "html") {
								$this->pages .= "<a href='javascript:;'>Элементы страницы</a>";
							}
					}

					$this->GetPages($cat["id"]);

					$this->pages .= "</li>";

				}
				$this->pages .= "</ul>";
			}
			return $this->pages;
		}

	}
