function close() {
	$("#property").remove();
	$("#shadow").fadeOut(200);
}

function open_property(event, obj, id) {
	$("#property").remove();
	$("#shadow").fadeIn(200);

	var href = decodeURIComponent(location.search.substr(1)).split('&');
	var getComponent = href[0].split("=");

	var name = $(obj).html();
	var id = $(obj).data("itemid");
	var elm_type = $(obj).data("is_catalog");

	var style_property = "position:absolute; z-index:200; min-height:40px; width:340px;  top:"+event.clientY+"px; left:"+event.clientX+"px;";

	$("<section id='property' style='"+style_property+"'><a href='javascript:close();' id='close_window'></a></section>").appendTo("body");
	$("<section id='property-content'></section>").appendTo("#property");
	$("<header><h1 class='inline'>Свойства элемента - "+name+"</h1></header>").appendTo("#property-content");
	$("<ul></ul>").appendTo("#property-content");

	$("<li><a href='javascript:popup(\"Выберите тип страницы\",\"/admin/template/pages/win_property.phtml\", 400, "+id+");'>Добавить страницу / каталог</a></li>").appendTo("#property-content ul");
	$("<li><a href='/admin.php?component="+getComponent[1]+"&action=property&id="+id+"'>Параметры</a></li>").appendTo("#property-content ul");
	$("<li><a href='/admin.php?component="+getComponent[1]+"&action=elements&id="+id+"'>Элементы</a></li>").appendTo("#property-content ul");
	$("<li><a href='/admin.php?component="+getComponent[1]+"&action=delete&id="+id+"'>Удалить</a></li>").appendTo("#property-content ul");

}

$(function() {
	$("#shadow").click(function() {
		$("#property").remove();
		$(this).hide();
	});
});

