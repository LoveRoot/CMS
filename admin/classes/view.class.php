<?php
    class View
    {
        private static $instance;

        public static function I()
        {
            if (!(self::$instance instanceof self))
            {
                self::$instance = new self();
            }
            return self::$instance;
        }

        public function GetTemplate($content_view, $template_view, $data = array())
        {
            if (is_array($data))
            {
                // преобразуем элементы массива в переменные
                extract($data);
            }

            if (file_exists($_SERVER["DOCUMENT_ROOT"]."/admin/template/".$template_view))
            {
                ob_start();
                $include = require $_SERVER["DOCUMENT_ROOT"]."/admin/template/".$template_view;
                $include = ob_get_clean();

                preg_match_all('/\[include="(.*?)"/', $include, $ext[]);

								$include = str_replace('{TEMPLATE}','admin/template', $include);
								$include = str_replace('{ROOT_PATH}','admin', $include);

                if (!empty($ext))
                {
                    foreach ($ext as $i => $inc)
                    {
                        foreach ($inc[1] as $out)
                        {
                            $include = str_replace('[include="'.$out.'"]', core::GetIncludeContents($out), $include);
                        }
                    }
                }

                echo $include;
            } else
            {
                echo "Шаблон {$template_view} не найден в папки admin/template";
            }
        }

        private function __construct()
        {

        }

        private function __wakeup()
        {

        }

        private function __clone()
        {

        }

    }

?>