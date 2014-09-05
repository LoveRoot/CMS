<?php

class model_options extends Model {
    public function __construct() {

    }

		public function GetTemplate($path) {
			$dir = scandir($path);
			return $dir;

		}

    public function GetConfig() {
        $result = Model::SelectItems("config", array("*"));
				return $result;
    }
}

?>
