function close(id) {
    $(id).remove();
}

function faq_page(obj) {
    $(obj).next(".f_block .f_fulltext").toggle();
}

$(function() {
    // -- Вопросы и ответы --
        
        $(".f_block h2").click(function() {
           $(this).nextAll(".f_block .f_fulltext").toggle();
        });
        
});