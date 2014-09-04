<?php

	class model_tabs extends Model {
		public $tabs;

		public function __construct() {

		}

		public function options() {
			return $this->tabs = array("options" => array("id" => "#maincont", "name" => "Параметры"),
																 "defend" => array("id" => "#defend", "name" => "Защита"));
		}
	}
