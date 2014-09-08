<?php

class model_options extends Model {
		public $template;

    public function __construct() {

    }

		public function SaveConf($conf) {
			$ser = serialize($conf);
			$result = Model::UpdateItem("config", "id=1", array("config" => "{$ser}"));
			return $result;
		}

		public function GetTemplate($path) {
			$template = scandir($path);

			foreach ($template as $dir) {
					if ($dir == ".." || $dir == ".")
						continue;
					if (is_dir($path.$dir)) {
						$template .= "<option value=\"{$dir}\">{$dir}</option>";
					}
			}

			return $template;
		}

    public function GetConfig() {
        $res = Model::SelectItems("config", array("config"),"id=1");
				$result = unserialize($res["config"]);
				return $result;
    }
}

?>
