var conf = {
						focus:true,
						border_focus:true,
						border_size:"1px",
						border_color:"red"
					 };

function property_script(obj) {
		if (conf.focus === true)
		$(obj).focus();

		if (conf.border_focus === true)
		$(obj).css({"border":""+conf.border_size+"#"+conf.border_color+" !important"});
}

function reg_valid(type) {
	var text = /[a-z0-9-_.\/]/i;

	switch(type) {
		case "text":
			return text;
		break;
	}
}

function input_text(obj, eventForm) {
	var length = $(obj).val().length;
	var type_row = $(obj).data("valid");
	var reg = reg_valid(type_row);

	$(obj).next("p.desc").remove();

	if (reg.test($(obj).val()) === false) {
		property_script(obj);
		$(obj).after("<p class='desc'>Это поле обязательно для заполнения, возможно в ваше тексте содержатся запрещённые символы.</p>");
		eventForm.preventDefault();
	}
}

$(function () {
	$("Form.valid").submit(function (e) {
		$(this).find("input").each(function() {
			var required = $(this).attr("class");

			if (required == "required") {
					input_text(this, e);
			}
		});
	});
});