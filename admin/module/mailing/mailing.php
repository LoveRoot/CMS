<?php

    require_once (admin . "classes/mailing.class.php");
    require_once ("libs/pagination.class.php");

    $mailing = new MailingGroups();

    $doc = phpQuery::newDocument("<section id='mailing-box'><form action=\"\" type=\"POST\"></form></section>");

    $doc["#mailing-box form"]->append("<section id=\"groups-list\"><header><h1>Группы подписчиков <a href=\"javascript:;\" onclick=\"add_mailing_group();\"><img src=\"/admin/engine/images/add.png\" /></a></h1></header></section>");
    $doc["#mailing-box form"]->append("<section id=\"users-list\"><header><h1>Подписчики</h1></header></section>");

    $doc["#groups-list"]->append("<section id=\"gr\">
                                        <ul class=\"drop\">
                                            <li data-id_group=\"0\"><a href=\"javascript:;\" onclick=\"change_catalog(this);\">Все</a></li>"
                                                ."<section id=\"gr_list\">" . $mailing->m_groups . "</section>" .
                                        "</ul>
                                 </section>");
    $doc["#users-list"]->append("<section id=\"ul\"><ul></ul></section>");

    do {
        $doc["#ul ul"]->append("<li id=".$mailing->mails->result["id"].">
                                    <input type=\"checkbox\" id=\"sel".$mailing->mails->result["id"]."\" onclick=\"count_checkbox();\" name=\"sel[]\" value=" . $mailing->mails->result["id"] . " />
                                    <label for=\"sel" . $mailing->mails->result["id"] . "\">" . $mailing->mails->result["email"] . "</label>
                                </li>");
    } while ($mailing->mails->result = mysqli_fetch_assoc($mailing->mails->sql));

    $doc["#mailing-box"]->append("<section class=\"form_row\"><section style=\"float:left; width:200px;\" id=\"sel_count\"></section><input style=\"float:right; display:none;\" id=\"next_page\" type=\"button\" name=\"next\" value=\"Продолжить\" onclick=\"mailing_form();\"></section>");

    $doc["#users-list"]->append($mailing->mails->navigation("admin.php?component=mailing&page="));

    $content .= $doc;
?>
