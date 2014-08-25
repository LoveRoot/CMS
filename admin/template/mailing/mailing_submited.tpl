<script src="/js/jquery.js"></script>
<script src="/js/tinymce/tinymce.min.js"></script>

<section id="mailing_form">
    <section id="status"></section>
    <form action="POST">
        <section id="mailing_user">
            <header><h2>Для подписчиков:</h2></header>
            <ul>
                {users}
            </ul>
        </section>

        <section id="forms" style="float:right; width:75%;">
            <section class="form_row">
                <input type="text" name="title" style="width:100%;" />
            </section>

            <section class="form_row">
                <textarea name="message" style="width:100%; height:320px;" id="msg"></textarea>
            </section>

            <section class="form_row">
                <input type="button" value="Начать отправку" onclick="send_mailing();" />
            </section>
        </section>



    </form>
</section>

<script type="text/javascript">
    tinymce.init({
        selector: "textarea#msg",
        theme: "modern",
        plugins: [
            "advlist autolink lists link image code",
            "insertdatetime media nonbreaking ", "textcolor"
        ],
        toolbar1: "styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image | forecolor backcolor",
        image_advtab: true,
        templates: [
    {title: 'Test template 1', content: 'Test 1'},
    {title: 'Test template 2', content: 'Test 2'}
        ]
    });


</script>