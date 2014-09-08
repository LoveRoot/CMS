function unload_page() {
	var coord = get_center_coord("#load_page");
	$("#shadow").show();
	$("body").append("<img id='load_page' src='/admin/engine/images/page/load_page.gif' style='position:absolute; left:"+coord.left+"px; top:"+coord.top+coord.scroll+"px;' />");
}

function close(obj) {
	$(obj).remove();
}

function get_center_coord(obj) {
    var p_left = ($(window).width() - $(obj).width()) / 2;
    var p_top = ($(window).height() - $(obj).height()) / 2;

    $data = {"left": p_left,
						 "top": p_top,
						 "scroll": $(window).scrollTop()
						};

    return $data;
}

$(function() {
		var coord = get_center_coord("#login_admin");
		$("#login_admin").css({"left":coord.left+"px","top":coord.top+coord.scroll+"px"});

		window.onbeforeunload = function (event) { unload_page(); }

		$("#right-col").tabs();
});