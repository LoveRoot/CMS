<?php
	$gr = new addgroups();

	$templ = new QTemplate(admin."template/groups/", "add_groups");
		$templ->assign_vars(array("gr-name" => isset($_POST["gr_name"])?$_POST["gr_name"]:''));
	$content .= $templ->render();
?>
