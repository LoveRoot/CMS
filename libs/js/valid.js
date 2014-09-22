function form_uslugi() {
		var count_check = $("#zakaz_uslugi-box input['checkbox']:checked").length;

		$("#zakaz_uslugi-box form input.required").each(function(e) {
				var length = $(this).val().length;
				if (!length) {
					$(this).focus();
					$(this).css("border","2px solid red");
					$(this).after("<p style='text-align:right; font-size:60%;'>Это поле обязательно для заполнения</p>");
					e.preventDefault();
				}
					else {
						$(this).css("border","2px solid green");
						$(this).next("p").remove();
				}
		});
}