<?php

class view {
  /**
     * компилирует шаблон на основуе параметров, результат возвращает в виде строки
     * @param string $__fname
     * путь к шаблону
     * @param array $vars
     * массив параметров
     * @return string
     * строковыое представление шаблона
     */
    static public function template($__fname, $vars = array()) {
        $__fname = trim($__fname);
        if (file_exists($__fname)) {
            // Перехватываем выходной поток.
            ob_start();
            // Запускаем файл как программу на PHP.
            extract($vars, EXTR_OVERWRITE);

            include($__fname); // Получаем перехваченный текст.

            $text = ob_get_contents();
            ob_end_clean();
            return $text;
        } echo "'$__fname'шаблон не найден ";
    }

}

?>