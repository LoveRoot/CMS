<?php
	class html {
		public function __construct() {

		}

		public function link($name="", $property) {
			foreach($property as $pr => $key) {
				$combine .= "{$pr}='{$key}'";
			}

			return '<a '.$combine.'>'.$name.'</a>';
		}
	}
?>