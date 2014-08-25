<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/admin/classes/configure.class.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/classes/core.class.php");
	
	$tpl = new Qtemplate($_SERVER["DOCUMENT_ROOT"]."/admin/module/conf/template/","comments");
	
	$data = new comments();
	
	$ActiveComments = $data->getActiveComments();
	
	$commentsGuest= $data->getCommentsGuest();
	
	$CommentsGuestMod = $data->getCommentsGuestMod();
	
	$commentsModAll = $data->getCommentsModAll();
	
	$commentsNav = $data->getCommentsNav();
	
	$tpl->assign_vars(array("active-comments" => $ActiveComments, "comments-guest" => $commentsGuest, "CommentsGuestMod" => $CommentsGuestMod,
							"commentsModAll" => $commentsModAll, "comments_num_rows" => $commentsNav));
	
	echo $content .= $tpl->render();

?>

