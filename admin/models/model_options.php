<?php

class model_options extends Model {

    public $template;
    public $tpl;
    
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
                $this->tpl .= "<option value=\"{$dir}\">{$dir}</option>";
            }
        }

        return $this->tpl;
    }

    public function GetConfig() {
        $res = Model::SelectItems("config", array("config"), "id=1");
        $result = unserialize($res["config"]);
        return $result;
    }

}

?>
