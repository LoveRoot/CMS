<?php
    if (isset($_GET["component"]) && !isset($_GET["model"])) 
    {
        switch ($_GET["component"]) 
        {
            case "options":
                $tabs .= "<li><a href=\"#general\">Основные</a></li>";
                $tabs .= "<li><a href=\"#defend\">Защита</a></li>";
                $tabs .= "<li><a href=\"#advanced\">Виджеты</a></li>";
                $tabs .= "<li><a href=\"#comments\">Комментарии</a></li>";
                $tabs .= "<li><a href=\"#event\">События</a></li>";
                $tabs .= "<li><a href=\"#slider\">Слайдер</a></li>";
                $tabs .= "<li><a href=\"#gallerys\">Галерея</a></li>";
                $tabs .= "<li><a href=\"#downloader\">Загрузка файлов</a></li>";
                $tabs .= "<li id=\"last\"><a href=\"#db\">База данных</a></li>";
                break;

            case "referer":
                $tabs .= "<li><a href=\"#referer\">Общее</a></li>";
                $tabs .= "<li><a href=\"#referer\">Ключевые слова</a></li>";
            break;

            case "users":
		$tabs = "<li><a href=\"#users\">Пользователи</a></li>";
                $tabs .= "<li><a href=\"#low-search\">Обычный поиск</a></li>";
                $tabs .= "<li><a href=\"#search\">Расширенный поиск</a></li>";
            break;


            case "mailing":
                $tabs = "<li><a href=\"#mailing-box\">Рассылка</a></li>";
                $tabs .= "<li><a href=\"#journal\">Отчёт</a></li>";
            break;
        }
    }
    

    if (isset($_GET["model"])) {
        switch ($_GET["model"]) {
           
            case "article":
                $tabs = "<li><a href=\"#maincont\">Содержимое</a></li>";
                $tabs .= "<li><a href=\"#general\">Основные</a></li>";
                $tabs .= "<li><a href=\"#context\">Контент</a></li>";
                $tabs .= "<li><a href=\"#secure\">Безопасность</a></li>";
                $tabs .= "<li><a href=\"#photo\">Логотип</a></li>";
                $tabs .= "<li><a href=\"#design\">Дизайн страницы</a></li>";
                $tabs .= "<li><a href=\"#seo\">Seo настройки</a></li>";
            break;

            case "editarticle":
                $tabs = "<li><a href=\"#maincont\">Основные</a></li>";
                $tabs .= "<li><a href=\"#advanced\">Теги</a></li>";
                $tabs .= "<li><a href=\"#upload\">Файлы</a></li>";
                $tabs .= "<li><a href=\"#seo\">Seo настройки</a></li>";
            break;

            case "addarticle":
                $tabs = "<li><a href=\"#maincont\">Основные</a></li>";
                $tabs .= "<li><a href=\"#advanced\">Теги</a></li>";
                $tabs .= "<li><a href=\"#upload\">Файлы</a></li>";
                $tabs .= "<li><a href=\"#seo\">Seo настройки</a></li>";
            break;

            case "gallery":
                $tabs = "<li><a href=\"#maincont\">Содержимое</a></li>";
                $tabs .= "<li><a href=\"#general\">Основные</a></li>";
                $tabs .= "<li><a href=\"#context\">Контент</a></li>";
                $tabs .= "<li><a href=\"#secure\">Безопасность</a></li>";
                $tabs .= "<li><a href=\"#seo\">Seo настройки</a></li>";
                $tabs .= "<li><a href=\"#design\">Дизайн страницы</a></li>";
                break;

            case "main":
                $tabs = "<li><a href=\"#maincont\">Содержимое</a></li>";
                $tabs .= "<li><a href=\"#general\">Основные</a></li>";
                $tabs .= "<li><a href=\"#template\">Шаблоны</a></li>";
                break;

            case "faq":
                $tabs = "<li><a href=\"#maincont\">Содержимое</a></li>";
                $tabs .= "<li><a href=\"#general\">Основные</a></li>";
                $tabs .= "<li><a href=\"#forms\">Форма</a></li>";
                $tabs .= "<li><a href=\"#context\">Контент</a></li>";
                $tabs .= "<li><a href=\"#secure\">Безопасность</a></li>";
                $tabs .= "<li><a href=\"#template\">Шаблоны</a></li>";
                $tabs .= "<li><a href=\"#seo\">Seo настройки</a></li>";
                break;

            case "editfaq":
                $tabs = "<li><a href=\"#maincont\">Основные</a></li>";
                $tabs .= "<li><a href=\"#control\">Настройки</a></li>";
            break;
           
            case "addfaq":
                $tabs = "<li><a href=\"#maincont\">Основные</a></li>";
                $tabs .= "<li><a href=\"#control\">Настройки</a></li>";
            break;
       
            case "normal":
                $tabs = "<li><a href=\"#context\">Содержимое</a></li>";
                $tabs .= "<li><a href=\"#general\">Основные</a></li>";
                $tabs .= "<li><a href=\"#secure\">Безопасность</a></li>";
                $tabs .= "<li><a href=\"#template\">Шаблоны</a></li>";
                $tabs .= "<li><a href=\"#seo\">Seo настройки</a></li>";
            break;

            case "editslider":
                $tabs .= "<li><a href=\"#general\">Основные</a></li>";
                $tabs .= "<li><a href=\"#photo\">Содержимое</a></li>";
            break;

            case "addpage":
                $tabs .= "<li><a href=\"#maincont\">Основные</a></li>";
                $tabs .= "<li><a href=\"#context\">Контент</a></li>";
                $tabs .= "<li><a href=\"#logotype\">Логотип</a></li>";
                $tabs .= "<li><a href=\"#advanced\">Дополнительно</a></li>";
                $tabs .= "<li><a href=\"#template\">Шаблоны</a></li>";
                $tabs .= "<li><a href=\"#seo\">Seo настройки</a></li>";
            break;
            
            case "addusers":
                $tabs = "<li><a href=\"#maincont\">Основное содержимое</a></li>";
                $tabs .= "<li><a href=\"#advanced\">Дополнительная информация</a></li>";
            break;

            case "editusers":
                $tabs = "<li><a href=\"#maincont\">Основное содержимое</a></li>";
                $tabs .= "<li><a href=\"#advanced\">Дополнительная информация</a></li>";
            break;

            case "editgroups":
                $tabs = "<li><a href=\"#maincont\">Группа</a></li>";
                $tabs .= "<li><a href=\"#site\">Сайт</a></li>";
		$tabs .= "<li><a href=\"#admin\">Панель администрирования</a></li>";
            break;
        }
    }
?>
