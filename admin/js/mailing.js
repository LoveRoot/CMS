function drop_init() {
    $("#ul ul li").draggable({cursor: "move",
        revert: "invalid",
        containment: "document",
        helper: "clone"
    });

    $("ul.drop li").droppable({
        accept: "#ul ul li",
        activeClass: "hover",
        drop: function(event, ui) {
            var id = $(ui.draggable[0]).attr("id");
            var id_group = $(this).attr("id");
            console.log(id_group);
            $.post("/admin/module/mailing/ajax.php", "ajaxSubmit=regroup&item=" + id + "&group=" + id_group, function(status) {
                if (status == "success") {
                    $("ul.drop #gr_list li#" + id_group).find("a").click();
                }
                else {
                    return false;
                }

            });
        }
    });
}

/* Рассылки */

function add_mailing_group() {
    var dialog = prompt("Введите имя группы", "");

    if (dialog)
        $.post("/admin/module/mailing/ajax.php", "ajaxSubmit=create_catalog&content=" + dialog, function(data) {
            $("#gr ul #gr_list").html(data);
        });
    else
        return false;
}

function change_catalog(obj) {
    $("#gr ul li").removeClass("active");
    var obj = $(obj);
    var id = obj.data("id_group");
    obj.parent().addClass("active");
    $.post("/admin/module/mailing/ajax.php", "ajaxSubmit=view_catalog&content=" + id, function(data) {
        $("#ul").html("<p>Ищем...</p>");
        $("#ul").html(data);
        drop_init();
    });

}

function remove_catalog(obj) {
    var c = confirm("Вы действительно хотите удалить эту группу ?");
    if (c == true) {
        $.post("/admin/module/mailing/ajax.php", "ajaxSubmit=remove_catalog&content=" + obj, function(status) {
            if (status == "success") {
                $("#gr_list li#" + obj).fadeOut();
            }
        });
    }
}

function mailing_form() {
    var count = $("#ul ul li input[type='checkbox']:checked").length;
    var data_item = $("#mailing-box form").serialize();
    var coord = get_center_coord("#ajax_icon");

    $.ajax({
        url: "/admin/module/mailing/ajax.php",
        type: "POST",
        data: "ajaxSubmit=mailing_submited&" + data_item,
        beforeSend: function() {
            $("shadow").show();
            $("body").after("<section id='ajax_icon' style='left:" + coord.left + "px; top:" + coord.top + "px'><img id='ajax' src='/admin/engine/images/load_page.gif'  /></section>");
        },
        success: function(data) {
            $("shadow").hide();
            $("#ajax_icon").remove();
            $("#mailing-box").html(data);
        }
    });
}

function count_checkbox() {

    var count = $("#content input[type='checkbox']:checked").length;

    if (count > 0) {
        $("#next_page").show();
    }
    else {
        $("#next_page").hide();
    }
}

function send_mailing() {
    var data_item = $("#mailing_form form #mailing_user ul li input:checked").serialize();
    var title_msg = $("#mailing_form form #forms input[type='text']").val();
    var msg = tinyMCE.get('msg').getContent();
    var coord = get_center_coord("#ajax_icon");

    $.ajax({
        url: "/admin/module/mailing/submit.php",
        type: "POST",
        data: data_item + "&title=" + title_msg + "&msg=" + msg,
        beforeSend: function() {
            $("shadow").show();
            $("body").after("<section id='ajax_icon' style='left:" + coord.left + "px; top:" + coord.top + "px'><img id='ajax' src='/admin/engine/images/load_page.gif'  /></section>");
        },
        success: function(data) {
            $("shadow").hide();
            $("#ajax_icon").remove();
            if (data == "success") {
                $("#mailing_form form #forms input[type='text']").val("");
                tinyMCE.get('msg').setContent("");
                alert("Ваша рассылка успешно отправлена.");
                location.href = location.href;
            }
            else {
                $("#status").html(data);
            }
        }
    });
}


$(document).ready(function() {
    $("#ul ul li input[type='checkbox']").click(function() {
        var count = $("#ul ul li input[type='checkbox']:checked").length;
        $("#sel_count").html("Выбрано объектов: " + count);
    })

    count_checkbox();
    drop_init();
});