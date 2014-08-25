function __delete(obj)
{
    var c = confirm("Внимание !\nВместе с коллекцией будут удалены изображения, если таковые имеются\nВы действительно хотите удалить коллекцию?");
    if (c)
    {
        var elm = $("#ShowColl ul li:last-child").index();
        $("#ShowColl ul li#" + obj).remove();
        $("#ShowColl ul li").eq(elm - 1).addClass("change");

        $.post("/admin/module/pages/gallery/ajax.php", "ajaxSubmit=delete_collection&content=" + obj, function(data) {
            $("#images div#objects ul").html(data);
        });

        if ($("#ShowColl").find("ul li").length == 0)
        {
            var id = $("#create_collection").attr("art");
            $("#ShowColl").html("<div id=\"empty\">На текущий момент у вас нет не одной коллекции, <a onclick='__AddCollection("+id+");' href='javascript:;'>создайте коллекцию</a></div>");
            $("#AddImages").hide();
        }
        else
        {
            $("#ShowColl ul li.change a:nth-child(2)").click();
        }
    }
}

function __DeleteLogo(obj)
{
    var c = confirm("Вы действительно хотите удалить эту картинки(у) ?");
    if (c)
    {
        $.post("/admin/module/pages/gallery/ajax.php", "ajaxSubmit=delete_logo&content=" + obj, function(data) {
            $("#FormWinProp #logo").html(data);
        });
    }
}

function __DeleteImg(obj)
{
    var callback = $("#AddImages").attr("col");
    var page = $("#page").attr("page");
    console.log(obj);

    var c = confirm("Вы действительно хотите удалить эту картинки(у) ?");
    if (c)
    {
        $.post("/admin/module/pages/gallery/ajax.php", "ajaxSubmit=delete_image&content=" + obj + "&callback=" + callback + "&page=" + page, function(data) {
            $("#images div#objects ul").html(data);
        });
    }
}

function __select(obj)
{
    var id = obj;
    $("#ShowColl ul li").removeClass("change");
    $("#ShowColl ul li#" + id).addClass("change");
    $("#AddImages").show();
    $("div.progress").hide();

    $.post("/admin/module/pages/gallery/ajax.php", "ajaxSubmit=show_gallery&content=" + id, function(data) {
        $("#images #objects ul").html(data);
        $("#inp").html("<input id=\"file\" type=\"file\" name=\"filename[]\" style=\"display:none;\" multiple />");
        $("#AddImages").attr("col", id);
    });
}

function pagination(obj)
{
    var page = $(obj).attr("page");
    var id = $("#AddImages").attr("col");

    $.post("/admin/module/pages/gallery/ajax.php", "ajaxSubmit=show_gallery&content=" + id + "&page=" + page, function(data) {
        $("#images #objects ul").html(data);
    });
}

function __selectImage(obj)
{
    var status = $(obj).attr("class");

    if (status == "select")
    {
        $("#objects ul li input[type='checkbox']").removeAttr("checked");
        $(obj).removeClass("select");
        $("#objects ul li a img").css("border", "2px solid #fff");
        $("div#opt").remove();
    }
    else
    {
        var img = $("#objects ul li input[type='checkbox']").attr("id");

        $(obj).addClass("select");
        $("#objects ul li input[type='checkbox']").attr("checked", "checked");
        $("#objects ul li a img").css("border", "2px solid gold");
        $("<div id='opt' style='position:absolute; z-index:999; border:1px solid black; background:#fff; padding:10px;'><a href='javascript:;' onclick='__DeleteImg(" + img + ");' >Удлаить записи</a></div>").appendTo(obj);
    }

}

function __HoverImg(obj)
{
    var img_w = $(obj).width();
    var item = $(obj).data("path");

    $("div#img_options").remove();
    $("<div id='img_options' style='position:absolute; right:10px; top:10px; z-index:9999;'><a href=javascript:__DeleteImg('"+item+"'); style='padding:0px 9px; background:url(/admin/template/images/gallery/remove.png) no-repeat right center;'></a></div>").appendTo(obj);



}

function SaveGallery()
{
    var arrTitle = $("input[name='title']").fieldValue();
    var arrAlt = $("input[name='alt']").fieldValue();
    var arrName = $("input[name='name']").fieldValue();
    var id = $("#AddImages").attr("col");
    $("div.progress").hide();

    $("Form#SaveGallery").ajaxForm(
            {
                type: "POST",
                url: "/admin/module/pages/gallery/ajax.php",
                data: {ajaxSubmit: 'save_gallery', content: arrTitle, content2: arrAlt, content3: arrName, col: id},
                beforeSend: function(data)
                {
                    $("#images div#objects ul").html("<img style='vertical-align:middle;' src='/javascript/ajax.gif' title='Сохраняем...' alt=''/>&nbsp;Сохраняем...");
                },
                success: function(data)
                {
                    $("#images div#objects ul").html(data);
                }
            }).submit();

}

function AddCollectionLogo(obj)
{
    $("input#fileLogo").click();

    $("input#fileLogo").change(function() {

         $("#FormWinProp").ajaxForm(
         {
            type: "POST",
            url: "/admin/module/pages/gallery/ajax.php",
            cache:false,
            data: {ajaxSubmit: 'upload_collection_logo', content: obj},
           beforeSend: function(data)
           {
             $("#FormWinProp #logo").html("<img style='vertical-align:middle;' src='/javascript/ajax.gif' title='Загрузка...' alt=''/>&nbsp;Идёт загрузка...");
           },

           success: function(data)
           {
              $("#FormWinProp #logo").html(data);
           }
        }).submit();
        return false;
     });
}

function __AddImages()
{
    $("input#file").click();
    var id = $("#AddImages").attr("col");
    var bar = $('.bar');
    var percent = $('.percent');
    var status = $('#status');

    $("input#file").change(function() {
        $("#AddImages").hide();
        $("div.progress").show();

        $("Form#form").ajaxForm(
                {
                    type: "POST",
                    url: "/admin/module/pages/gallery/ajax.php",
                    cache:false,
                    data: {ajaxSubmit: 'upload_gallery', content: id},
                    beforeSend: function(data)
                    {
                        status.empty();
                        var percentVal = '0%';
                        bar.width(percentVal)
                        percent.html(percentVal);
                        $("#images div#objects ul").html("<img style='vertical-align:middle;' src='/javascript/ajax.gif' title='Загрузка...' alt=''/>&nbsp;Идёт загрузка...");
                    },
                    uploadProgress: function(event, position, total, percentComplete) {
                        var percentVal = percentComplete + '%';
                        bar.width(percentVal)
                        percent.html(percentVal);
                    },
                    success: function(data)
                    {
                        var percentVal = '100%';
                        bar.width(percentVal)
                        percent.html(percentVal);
                        $("#images #objects ul").html("<Form id='SaveGallery' col=" + id + "><div><input class='SaveGallery' type='button' value='Сохранить' onclick='SaveGallery();' /></div>" + data + "<div style='clear: both;'><input class='SaveGallery' type='button' value='Сохранить' onclick='SaveGallery();' /></div></Form>");
                    },
                    complete: function(xhr) {
                        status.html(xhr.responseText);
                    }
                }).submit();
        return false;
    });
}

function __AddCollection(obj, p_coll)
{
    var dialog = prompt("Введите имя коллекции", "");
    var hrefdata = decodeURIComponent(location.search.substr(1));

    if (dialog)
        $.post("/admin/module/pages/gallery/ajax.php", "ajaxSubmit=create_collection&content="+dialog+"&id="+obj+"&p_coll="+p_coll+hrefdata, function(data) {
            var elm = $("#ShowColl ul li.change").index();
            $("#ShowColl").html(data);
            var item = $("#ShowColl ul li").eq(elm).addClass("change");
            $("#ShowColl ul li.change a:nth-child(2)").click();
        });
    else
        return false;
}

$(function()
{
    var add = $("#AddImages").attr("col");



//    $("#ShowColl ul li").hover(function() {
//       $(this).find("div.add").show();
//    }, function() {
//        $(this).find("div.add").hide();
//    });

});
