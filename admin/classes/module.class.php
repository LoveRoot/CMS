<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/admin/classes/secure_panel.class.php");

class moduleList {

    public function __construct() {
        $module = array("options" => array("id" => 1,
                        "caption" => "Настройка сайта",
                        "description" => "Настройте свою систему !",
                        "icon" => "/admin/engine/images/tabs/slide.png",
                        "start" => "start"),
            
                        "pages" => array("id" => 2,
                                         "caption" => "Страницы",
                                         "description" => "Создание или редактирование страниц сайта !",
                                         "icon" => "/admin/engine/images/tabs/slide.png",
                                         "start" => "all",
                                         "addons" => array("Создать страницу" => array("href" => "javascript:;",
                                                           "onclick" => 'popup("Выберете тип страницы","/admin/template/winProperty/add_page.tpl",415)'),
                                                           "Список страниц" => array("href" => "?component=pages&c=all"))),
            
                        "mailing" => array("id" => 9,
                                           "caption" => "Рассылки",
                                           "description" => "Рассылка писем подписчикам",
                                           "icon" => "/admin/engine/images/tabs/slide.png",
                                           "start" => "all",
                                           "addons" => array("Создать рассылку" => array("href" => "?component=mailing"),
                                           "Список рассылок" => array("href" => "?component=mailing"))),

                        "slider" => array("id" => 3,
                                          "caption" => "Ротатор изображений",
                                          "description" => "Создайте своему сайту, презентабельный вид",
                                          "icon" => "/admin/engine/images/tabs/slide.png",
                                          "start" => "all",
                        "addons" => array("Добавить коллекцию" => array("href" => "?component=slider&model=addslider"),
                                          "Список коллекций" => array("href" => "?component=slider"))),
            
                        "users" => array("id" => 4,
                                         "caption" => "Учётные записи",
                                         "description" => "Управление пользователями",
                                         "icon" => "/admin/engine/images/tabs/slide.png",
                                         "addons" => array("Создать учётную запись" => array("href" => "?component=users&model=addusers"),
                                         "Список учётных записей" => array("href" => "?component=users"))),
            
                        "groups" => array("id" => 5,
                                               "caption" => "Группы для учётных записей",
                                               "description" => "Расширяйте или ограничивайте в правах, учётные записи",
                                               "icon" => "/admin/engine/images/tabs/slide.png",
                                               "start" => "all",
                        "addons" => array("Создать группу" => array("href" => "?component=permissions&model=addgroups&c=add"),
                                          "Список групп" => array("href" => "?component=permissions&c=all"))),
            
                        "application" => array("id" => 6,
                                               "caption" => "Заявки",
                                               "description" => "Заявки оставленные посетителями сайта",
                                               "icon" => "/admin/engine/images/tabs/slide.png",
                                               "start" => "all",
                                               "addons" => array()),
            
                        "events" => array("id" => 7,
                                          "caption" => "События",
                                          "description" => "Создание событий на сайте",
                                          "icon" => "/admin/engine/images/tabs/slide.png",
                                          "start" => "all",
                                          "addons" => array()),
            
                        "referer" => array("id" => 8,
                                           "caption" => "Журнал",
                                           "description" => "Журнал статистики",
                                           "icon" => "/admin/engine/images/tabs/slide.png",
                                           "start" => "all",
                                           "addons" => array("" => "")));

        $secureModule = new secure_panel();

        foreach ($module as $i => $items) {
            foreach ($module[$i]["addons"] as $addons => $href) {
                if ($_GET["component"] == $i) {
                    $link .= "<li><a href=" . $href["href"] . " onclick='" . $href["onclick"] . "'>$addons</a></li>";
                }
            }

            $c .= $i . ",";

            $status = $i == $_GET["component"] ? "active" : "";

//            if ($secureModule->activeMod[$i] == 1)
                $this->options .= "<div class=\"section-nav\">
                                                    <a href=\"javascript:;\" class=\"slide " . $module[$i]['id'] . "\" id=" . $module[$i]['id'] . "><img src=" . $module[$i]['icon'] . " alt=" . $module[$i]['caption'] . " /></a>
                                                    <a title='" . $module[$i]['caption'] . "' href='?component=$i' class='$status' id=" . $module[$i]['id'] . ">
                                                     
                                                     <span class=\"caption\">" . $module[$i]['caption'] . "</span><br />
                                                     <span class=\"description\"></span>

                                                  </a>

                                                  <div class=\"addons " . $module[$i]['id'] . "\">
                                                     <ul>
                                                        $link
                                                     </ul>
                                                  </div>
                                              </div>";
        }
    }

}

?>