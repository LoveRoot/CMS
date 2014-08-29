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
		console.log(coord.scroll);
		$("#login_admin").css({"left":coord.left+"px","top":coord.top+coord.scroll+"px"});
});