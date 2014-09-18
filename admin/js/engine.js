function popup(title, page, width)
{
    var popup_window = $("#modal_window");
    var coord = get_center_coord("#ajax_icon");
    var content = page;

    popup_window.css("top", + coord.top + $(window).scrollTop() + 'px');
    popup_window.css("left", + coord.left + 'px');
    popup_window.css("width", width +'px');

    $("#shadow").show();
    $("#title").html("<h1>"+title+"</h1>");

    if (content != "") {
        $.ajax({
            url:content,
            type:"GET",
            cache:false,
            beforeSend: function() {
               $("body").after("<section id='load_page' style='left:" + coord.left + "px; top:" + coord.top + "px'><img id='ajax' src='/admin/engine/images/page/load_page.gif'/></section>");
            },
            success: function(html) {
                $("#load_page").remove();
                $("#modal_window_content").html(html);

            }
        });
    }

    popup_window.fadeIn(500);

    //При клике на иконку, скрывает

    $("#modal_window .close").click(function() {
        $('#shadow').fadeOut(200);
        popup_window.fadeOut(100);
    });

    $("#shadow").click(function () {
        $('#shadow').fadeOut(200);
        popup_window.fadeOut(100);
    });
}

function unload_page() {
	var coord = get_center_coord("#ajax");
	$("body").after("<section id='load_page' style='left:" + coord.left + "px; top:" + coord.top + "px'><img id='ajax' src='/admin/engine/images/page/load_page.gif' alt='Пожалуйста подождите...' /></section>");
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

		$("#right-col ul#tabs").each(function() {
				$("#right-col ").tabs();
		})

});