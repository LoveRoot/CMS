<?php
		$temp_id = "";

		foreach($_POST["sel"] as $item) {
			$temp_id .= $item.",";
		}

		$users = $m_usr->GetUsersById(substr($temp_id, 0, -1));

		$templ = new QTemplate($_SERVER["DOCUMENT_ROOT"]."/admin/template/mailing/","mailing_submited");
			$templ->assign_vars(array("users" => $users));
		echo $templ->render();
?>