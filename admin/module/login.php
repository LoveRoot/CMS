<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/classes/login.class.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/admin/classes/secure_panel.class.php");

	$login = new login();
        
        if ($_POST)
        $login->__Authorize($_POST["login"], $_POST["password"]);
        
        if ($login->status == 1)
        {
            $result = DB::I()->__QueryString("SELECT groups.name FROM users, groups 
                                                                 where groups.id = users.groups and
                                                                       users.login='".$_COOKIE["user"]."'");

            $login_tpl = new Qtemplate($_SERVER["DOCUMENT_ROOT"] . "/admin/template/", "login_success");
            $login_tpl->assign_vars(array("user" => $_COOKIE["user"],
                                          "time-stamp" => date("d-m-Y"),
                                          "group" => $result["name"]));
            $autorize = $login_tpl->render();
        }
        
        
?>