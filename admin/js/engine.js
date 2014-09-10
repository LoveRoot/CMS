function unload_page() {
	$("#shadow").after("<section id='load_page'></section>");
	var coord = get_center_coord("#load_page");
	$("#load_page").css({"left":""+coord.left+"px","top":""+coord.top+coord.scroll+"px;"}).html("Пожалуйста подождите....<br /><img src='/admin/engine/images/page/load_page.gif'>");
	$("#shadow").show();

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