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
		public function __construct() {

		}

		public function GetPages() {
				$result = Model::QueryString("Select id, p_id, name, status, is_catalog, page_type, system From pages ORDER By sort");

				if ($result == true) {
					$this->tree_cat = array();
				do {
					$this->tree_cat[$result["p_id"]] = $result;
				} while ($result = mysqli_fetch_assoc(Model::$query));
					return $this->tree_cat;
				} else {
					return false;
				}
		}
	}
