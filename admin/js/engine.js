function get_center_coord(obj) {
    var p_left = ($(window).width() - $(obj).width()) / 2;
    var p_top = ($(window).height() - $(obj).height()) / 2;

    $data = {"left": p_left,
        "top": p_top,
        "scroll": $(window).scrollTop()
    };

    return $data;
}

function Delete(table, item, id) {
    var c = confirm("Вы действительно хотите удалить " + item)

    if (c == true) {
        document.location.href = document.location.href;
    }
    else {
        return false;
    }
}

function ajax_submit(url, data, view) {
    var forms = $("form").serialize();
    var coord = get_center_coord("#ajax_icon");
    $.ajax({
        url: url,
        type: "GET",
        data: "ajaxSubmit=" + data+"&"+forms,
        beforeSend: function() {
            $("#shadow").fadeIn(300);
            $("body").after("<section id='ajax_icon' style='left:" + coord.left + "px; top:" + coord.top + "px'><img id='ajax' src='/admin/engine/images/load_page.gif'  /></section>");
        },
        success: function(html) {
            $("#shadow").fadeOut(300);
            $("#ajax_icon").remove();
            $(view).html(html);
        }
    });
}

function delete_obj(name, location)
{
    var c = confirm("Внимание !!!\nВместе с текущей страницей, будут удалены её подстраницы\nУдалить страницу - " + name + " ?");

    if (c == true)
    {
        if (location !== "")
            document.location.href = location;
        else
            return true;
    }
    else
    {
        return false;
    }
}

function defend_group(obj)
{
    if (obj.value == "custom")
    {
        $("#defend_page").show();
    }
        else
    {
        $("#defend_page").hide();
    }
}

function download_slider(obj) 
{
    $("input#Download").click();
    $("input#Download").change(function() {
        var id = $("Form#slider").attr("article");
        var loc = location.search.split("?");

        $("#slider").ajaxForm({
            target: "#img_preview",
            type: "POST",
            url: "/admin/module/slider/ajax.php",
            cache: false,
            data: {ajaxSubmit: 'upload', content: id},
            beforeSend: function(data)
            {
                $("#img_preview").html("<img src='/javascript/ajax.gif' title='Загрузка...' alt='Загрузка...'>&nbsp;Загрузка...");
            },
            success: function(data)
            {
                $.post("/admin/module/slider/ajax.php", "ajaxSubmit=GetImages&content="+id+"", function(data) {
                    $("#img_preview").fadeIn(300).html(data);
                });
            }
        }).submit();
        return false;
    });
}

function slider_ajax(obj)
{
    var page = $(obj).attr("page");
    var loc = decodeURIComponent(location.search.substr(1));

    $.post("/admin/module/slider/photo.php", loc+"&page="+page, function(data) {
        $("#photo #img_preview").html(data);
    });
}

function RemoveBlock(block)
{
    $(block).remove();
}


function gallery_save()
{
    $(".sel").each(function() {

        $("#final_form").ajaxForm({
            target: "#content",
            url: "/admin/module/gallery/final.php",
            data: {param: "save", n: $(this).attr("name")},
            beforeSend: function(data) {
                $("#content").append("<img src='/javascript/ajax.gif' style='margin:0 auto;' /> <span>Немного подождите !!!</span>");
            },
            success: function(data) {

            }
        }).submit();
    });
}

function checkAll(obj)
{
    'use strict';
    var input_items = obj.form.getElementsByTagName("input"),
            item;
    for (item in input_items) {
        if (input_items.hasOwnProperty(item)) {
            if (input_items[item].type === "checkbox") {
                if (obj.checked) {
                    input_items[item].checked = true;

                } else {
                    input_items[item].checked = false;

                }
            }
        }
    }
}

function login_form()
{
	 var winAdmincenter = ($(window).width() - $("#login_admin").width()) / 2;
   var winAdmintop = ($(window).height() - $("#login_admin").height()) / 2;

   $("#login_admin").css({"position":"absolute", "left":+winAdmincenter+"px","top":+winAdmintop + $(window).scrollTop() +"px"});
}

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
               $("body").after("<section id='ajax_icon' style='left:" + coord.left + "px; top:" + coord.top + "px'><img id='ajax' src='/admin/engine/images/load_page.gif'/></section>");
            },
            success: function(html) {
                $("#ajax_icon").remove();
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

$(function()
{
    // Инициализация функций

    login_form();

    $("#modal_window").hide();

    $(".design-box input[type='radio']:checked").each(function() {
        $(this).parent().css("border","3px solid #A31010");
    });

    //Предварительный просмотр

    $("input[name='preview']").click(function() {
        var script = "/admin/module/preview.php";
        var title = $("input[name='title']").val();
        var shortnews = $("textarea[name='shortnews']").val();
        var fullnews = $("textarea[name='fullnews']").val();

        win = window.open(script, 'Пробный просмотр', 'width=700, height=500');
        win.document.body.innerHTML = "<h1>" + title + "</h1>" + "<p>" + shortnews + "</p>" + "<h1>" + title + "</h1>" + "<p>" + fullnews + "</p>";
    });

    $('form input[type="checkbox"]').bind('click', function() {
        var box = $('input[type="checkbox"]:checked').length;

        if (box > 0)
        {
            $("#action").css("display", "block");
        }
        else
        {
            $("#action").css("display", "none");
        }
    });

    $(".module-block").hover(function() {
        $(this).stop().animate({"opacity": "0.5"}, 600);

    }, function() {
        $(this).stop().animate({"opacity": "1"}, 600);

    });

    $(".getlink").click(function() {
        var link = $(this).attr("value");
        prompt('Ваша ссылка', link);
    });

    // Права пользователя //

    var section = $(".prompt").attr("section");
    $(".prompt[value=" + section + "]").attr("checked", "checked");

    // --Права пользователя--  //

    // Редактирование групп учётных записей //

    var PermGroupVol = $(".permissions").attr("section");

    $(".permissions[section='1']").each(function() {
        $(this).attr("checked", "checked");
    });

    // --Редактирование групп учётных записей--  //

    if($("#page_password").is(":checked")) {
           $("div#form").css({"display": "block", "margin": "10px 0 0"}).slideDown("slow");
    }

    $("#page_password").click(function() {
       if($("#page_password").is(":checked")) {
           $("div#form").css({"display": "block", "margin": "10px 0 0"}).slideDown("slow");
       }
        else {
           $("div#form").css({"display": "none", "margin": "10px 0 0"});
        }
    });

    //ajax -start-

    $(".bookmark").on("click", function() {
        var article = $(this).attr('article');
        var value = $(this).attr('value');

        if (value == 1)
        {
            var value = 0;
        }
        else
        {
            var value = 1;
        }


        $.ajax
                ({
                    url: '/admin/module/post/bookmark.php',
                    type: 'POST',
                    data: 'value=' + value + '&id=' + article + '',
                    beforeSend: function() {
                        $("div#" + article).html('<img src="/javascript/ajax.gif">');
                    },
                    success: function(data) {
                        $("div#" + article).html(data);
                    }
                });
    });

    $("#download_ajax").click(function() {
        var cat = $("#category").attr("value");
        var resid = $("#category").attr("id");

        $("#download").ajaxForm({
            target: "#content",
            type: "POST",
            url: "/admin/module/gallery/upload.php",
            data: {category: cat, id: resid},
            beforeSend: function(data) {
                $("#content").append("<img src='/javascript/ajax.gif' style='margin:0 auto;' /> <span>Загрузка !!!</span>");
            },
            success: function(data) {
            }
        }).submit();
    });




    $("input[name='file']").click(function(e)
    {
        var id = $("Form").attr("id");

        $("Form").ajaxForm({
            target: "div#content",
            type: "POST",
            url: "/admin/module/slider/ajax/ajax.Form.php?download&collection=" + id + "",
            beforeSend: function(data)
            {
                $("div#content").html("<img src='/javascript/ajax.gif' title='Загрузка...' alt='Загрузка...'>&nbsp;Загрузка...");
            },
            success: function(data)
            {

            }
        }).submit();
        return false;
    });

    //Ротатор
    //Опции

    $("#img_preview input[name='select']").bind('click', function(e)
    {
        var box = $(this + ':checked').length;

        if (box > 0)
        {
            $("#img_preview div#action").css("display", "block");
        }
        else
        {
            $("#img_preview div#action").css("display", "none");
        }
    });

    $("#img_preview .img_preview").each(function() {
        var imgVisible = $(this).attr("hide");

        if (imgVisible == 1)
        {
            $(this).animate({opacity: 0.4}, 400);
        }
    });


    // Опции //


    // Значек удаления

    $(".imgRemove").on("hover", function()
    {
        $(this).css("cursor", "pointer");

    });

    $(".imgRemove").on("click", function() {
        var c = confirm("Вы действительно хотите удалить эту фотографию?");
        var article = $(this).attr("article");
        var loc = window.location.search;

        if (c == true)
        {
            $.ajax({
                url: '/admin/module/slider/photo.php',
                type: 'GET',
                data: 'method=delete&article=' + article + loc,
                beforeSend: function() {
                    $("#bg-content #photo").fadeOut(300)
                },
                success: function(data)
                {
                    $("#bg-content #photo").fadeIn(300).html(data);
                }
            });
        }
        else
        {
            return false;
        }
    });

    // -- Значек удаления --

    // -- Слайдер -- //

    //ajax -end-

    //widjets

    $("form input[type='checkbox']").each(function()
    {
        var action = $(this).attr("action");

        if ($(this).attr("action") == "on")
        {
            $(this).attr("checked", "checked");
        }
    });

    //-widjets-

    //comments


    //-comments-

    //downloader
    if ($("#water_on_off").is(":checked"))
    {
        $("#control-water").show();
    }
    else
    {
        $("#control-water").hide();
    }

    $("#water_on_off").click(function() {
        if ($("#water_on_off").is(":checked") == true)
        {
            $("#control-water").show();
        }
        else
        {
            $("#control-water").hide();
            $("#water_type_text").hide();
            $("#water_type_img").hide();
        }
    });

    if ($("#i_water_type input:radio[value='text']").is(":checked") == true)
    {
        $("#water_type_text").show();
    }
    else
    {
        $("#water_type_img").hide();
    }

    if ($("#i_water_type input:radio[value='image']").is(":checked") == true)
    {
        $("#water_type_img").show();
    }
    else
    {
        $("#water_type_text").hide();
    }
    $("#water_text").click(function()
    {

        if ($("#water_text").is(":checked") == true)
        {
            $("#water_type_text").show();
            $("#water_type_img").hide();
        }
    });

    $("#water_image").click(function()
    {

        if ($("#water_image").is(":checked") == true)
        {
            $("#water_type_img").show();
            $("#water_type_text").hide();
        }

    });

    //-downloader-

    //control -end-


    //Показ дополнительных ссылок в меню


    $("#navigation .section-nav a").each(function() {
        var id = $(this).attr("id");
        var menu = $(this).attr("class");

        if (menu == "active") {
            $(".slide."+id).css("display","block");
        }
    });


		// Навигация в левом меню (скрытие / раскрытие)

    $("#navigation a.slide").click(function() {
        var id = $(this).attr("id");
        $(".addons."+id).slideToggle();
    });

		// Конец

		//Draggable

        $("#modal_window").draggable({handle: "#top-section",
                                      cursor: "move",
                                      containment: "#container"
        });

    //Drag and Drop

    // Сортировка страниц

    $("#content #draganddrop ul").sortable({
        items:"li",
        placeholder: "placeholder",
	opacity: 0.6,
	delay: 200,
        tolerance: "pointer",
        update:function(event, ui) {
              var d = $(this).sortable('toArray').toString();
              var item = $(this).attr("id");

              var secret = "type=sort&item="+item;
              $.post("/admin/engine/ajax.controller.php?ajax=1", secret+"&data="+d, onAjaxSuccess);
              function onAjaxSuccess(data) {

              }
          }
    });

    //Сортировка новостей

    $("table#list-item tbody").sortable({
          items:"tr.index",
          placeholder: "sortplaceholder",
          opacity: 0.6,
          delay: 200,
          cursor: "pointer",
          update:function(event, ui) {
              var d = $(this).sortable('toArray').toString();
              var secret = "type=sort&item=post";
              $.post("/admin/engine/ajax.controller.php?ajax=1", secret+"&data="+d, onAjaxSuccess);
              function onAjaxSuccess(data) {

              }
          }
     });

     if($("#select_page_defend").val() == "custom")
     {
         $("#defend_page").show();
     }

    //Выделение ссылок в навигации -- end --

    // Новости и статьи

    // Добавить теги

    $("a.add_tag").click(function() {
        $("<div class='rowAddTags'><input type='text' name='tags[]' value='' style='width:180px;' />&nbsp;&nbsp;&nbsp;<a href='javascript:' class='delete_tag_row'><img src='/admin/engine/images/remove_row.png' title='Удалить'></a></div>").fadeIn(400).appendTo(".tags_row .row");
    });

		//Удаляем теги

    $("a.delete_tag_row").on('click', function() {
        $(this.parentNode).remove();
    });

    // -- Добавить теги --

    $("#right-col").tabs();

});
