$(document).ready(function()
{
    var href = document.location.href;
    $("<div class='option' style=\"display:none;\"><input type=\"submit\" action=\"delete\" value=\"Удалить\"></div>").appendTo("body");

    $("#content a.options").on('click', function(e)
    {
        $('#shadow').css("display", "block");

        var titleText = $(this).attr('.tooltip');
        var edition = $(this).attr('edition');
        var del = $(this).attr('delete');
        var values = $(this).attr('values');
        var views = $(this).attr('views');
        var propertyVal = $(this).attr('property');

        if (views)
        {
            var views = '<a href="' + views + '" id="views" target="_blank">Пробный просмотр</a>';
        }
        else
        {
            var views = '';
        }

        if (del)
        {
            var del = '<a href="javascript:;" class="delete" onclick=delete_obj("' + values + '","' + del + '");>Удалить</a>';
        }
        else
        {
            var del = '';
        }

        if (edition)
        {
            var edition = '<a href="' + edition + '" id="edit">Редактировать</a>';
        }
        else
        {
            var edition = '';
        }

        if (propertyVal)
        {
            var property = '<a href="javascript:" id="property">Свойства</a>';
        }
        else
        {
            var property = '';
        }

        $('<div class="tooltip"><div class="cap"><div class="title"><h1>Опции</h1></div><div class="close"><a href="javascript:" class="close_w"><img src="/admin/engine/images/close_small.png"></a></div></div><div class="job_content"><ul><li>' + edition + '</li><li>' + views + '</li><li>' + del + '</li><li>' + property + '</li></ul></div></div>').text(titleText).appendTo('body').css('top', (e.pageY + 10) + 'px').css('left', (e.pageX + 10) + 'px').fadeIn('100');

        //При клике на крестик, скрывает

        $(".tooltip a.close_w").click(function() {
            $('.tooltip').fadeOut("slow").remove();
            $('#shadow').css("display", "none");
        });


        //При клике в любую область, скрывает

        $("#shadow").click(function() {
            $('#shadow').fadeOut(200);
            $(".tooltip").remove();
        });

        //Свойство

        $("a#property").click(function()
        {
            $("<div id='property'>\n\
                                <div class='cap'>\n\
                                    <div class='title'><h1>Свойства</h1></div>\n\
                                    <div class='close'><a href='javascript:' class='close_w'>\n\
                                        <img src='/admin/engine/images/close_small.png'></a>\n\
                                    </div>\n\
                                </div>\n\
                                <div class='job_content'></div>").appendTo(".tooltip .cap");

            $.ajax({
                url: '/admin/engine/winProperty.php',
                cache: false,
                type: 'GET',
                data: propertyVal,
                beforeSend: function() {
                },
                success: function(data)
                {
                    $("div#property .job_content").html(data);
                }
            });

            $(".tooltip div#property .job_content #WinProp").live("click", function()
            {
                var Val = $("#FormWinProp").attr("value");
                var winPropData = $("#FormWinProp").serialize();

                $.ajax({
                    url: '/admin/engine/winProperty.php',
                    type: 'GET',
                    data: Val + '&' + winPropData,
                    beforeSend: function()
                    {
                        $("div#property .job_content #echo").html("<img src='/javascript/ajax.gif' style='margin:0 auto;' />&nbsp;Сохраняем!");
                    },
                    success: function(data)
                    {
                        if (data == "success")
                            document.location.href = document.location.href;
                        else
                            $("#echo").html(data);
                    }
                });
            });


            $(".tooltip div#property a.close_w").click(function() {
                $('.tooltip div#property').remove();
                $(".tooltip").removeClass("disable");
            });
        });

        // -- Свойство --


    });

    $('.addons').on('click', function(e)
    {
        var box = $('.addons:checked').length;

        if (box > 0)
        {
            $("div#setParametrs").fadeIn("400");
        }
        else
        {
            $("div#setParametrs").fadeOut("400");
        }
    });

    $(".option input[type='submit']").click(function() {
        var action = "&action=" + $(this).attr("action");

        $("form").ajaxForm({
            url: href + action,
            type: 'POST',
            beforeSend: function(data) {
                $("#content").html("<img src='/javascript/ajax.gif' style='margin:0 auto;' /> <span>Загрузка !!!</span>");
            },
            success: function(data) {
                $("body").html(data);
            }
        }).submit();

    });


});
