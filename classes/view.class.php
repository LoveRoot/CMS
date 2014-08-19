<?php

class View {

    private static $instance;

    public static function I() {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function GetTemplate($content_view, $template_view, $data = null)
    {
        /*
        if(is_array($data)) {
            // преобразуем элементы массива в переменные
            extract($data);
        }
        */
        if (file_exists("template/".core::Config("template")."/".$template_view)) {
						ob_start();
						$include = require "template/".core::Config("template")."/".$template_view;
						$include = ob_get_clean();

						preg_match_all('/\[include="(.*?)"/', $include, $ext[]);

						if (!empty($ext)) {
								foreach($ext as $i => $inc) {
									foreach ($inc[1] as $out) {
											$include =  str_replace('[include="'.$out.'"]', core::GetIncludeContents($out), $include);
									}
								}
						}
						echo $include;
        }   else {
            echo "Шаблон {$template_view} не найден по адресу ".core::Config("template")."";
        }

    }

    public function Template($path = "", $tpl = "", $param = "", $php_status = 0) {
        $path_combine = $path . $tpl . ".phtml";
        if (file_exists($path_combine)) {
            if ($php_status == 0) {
                return $this->TemplatePhpDisable($path_combine, $param);
            } else {
                return $this->TemplatePhpEnable($path_combine, $param);
            }
        } else {
            return "Шаблон {$tpl} по адресу {$path} не найден";
        }
    }

    /*
     * Загрузка шаблона без подержки PHP
     */

    public function TemplatePhpDisable($path, $param = "") {
        $this->result = file_get_contents($path);
        preg_match_all('/\[include="(.*?)"/', $this->result, $include[]);


        foreach ($param as $tag => $value) {
            $this->result = preg_replace('/{'.$tag.'}/', $value, $this->result);
        }

        foreach($include as $i => $inc) {
            foreach ($inc[1] as $include) {
                $this->result =  str_replace('[include="'.$include.'"]', core::GetIncludeContents($include), $this->result);
            }
        }


     }

    /*
     * Загрузка шаблона c подержкой PHP
     */

    public function TemplatePhpEnable($path, $param="") {

        ob_start();

        $this->result = include $path;

        $this->result = ob_get_clean();

//        if (!empty($param)) {
//            foreach ($param as $tag => $value) {
//                $this->result = preg_replace('/{'.$tag.'}/', $value, $this->result);
//            }
//        }
    }

    public function Render() {
        return $this->result;
    }

    private function __construct() {

    }

    private function __wakeup() {

    }

    private function __clone() {

    }

}

?>