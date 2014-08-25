<?php
	$gr = new editgroups(intval($_GET["id"]));

	$permissions = unserialize($gr->edit["permissions"]);

	$templ = new QTemplate(admin."template/groups/", "edit_groups");
		$templ->assign_vars(array("name" => $gr->edit["name"],
                                          "gr-name" => isset($_POST["gr_name"]) ? core::I()->__Vanish($_POST["gr_name"]):$gr->edit["name"]));
	$content .= $templ->render();

?>

