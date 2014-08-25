<html>
    <head>
        <meta charset="UTF-8" />
        <title>{title}</title>
        <script src="/js/jquery.js"></script>
        <script src="/js/jquery.smooth-scroll.min.js"></script>
        <script src="/js/jquery-ui.js"></script>
        <script src="/engine/module/gallery/default/lightbox.js"></script>
        <script src="/js/tinymce/tinymce.js"></script>
        <script src="/admin/js/ajaxform.js"></script>
	<script src="/admin/js/gallery.js"></script>
        <script src="/admin/js/mailing.js"></script>
        <script src="/admin/js/engine.js"></script>
        <script src="/admin/js/options.js"></script>
        <link rel="stylesheet" type="text/css" href="/admin/template/style/engine.css" />
        <link rel="stylesheet" type="text/css" href="/admin/template/style/style.css" />
        <link rel="stylesheet" type="text/css" href="/admin/template/style/lightbox.css" />

    </head>
    <body>
        <div id="shadow"></div>

        <div id="modal_window">
            <div id="top-section">
                <div id="title"></div>
                <div id="close"><a href="#" class="close"><img src="/admin/engine/images/close_small.png" alt="X" title="Закрыть"></a></div>
            </div>
            <div id="modal_window_content"></div>
        </div>

        {message}

        <div id="container">

            <div id="left-col">
                <div id="logo">
                    <a href="/admin.php"><img src="/admin/template/images/logo.png" alt="Логотип" title="Логотип" />
                    </a>
                </div>

                <div id="navigation">
                    {module}
                </div>
            </div>

            <!--<div id="briefing">
                <div class="header"><h1>Последние комментарии</h1></div>
                {lastcomments}
            </div>-->

            <div id="welcome">
                {autorize}
            </div>
            
            <div id="right-col">
                <div id="tab">
                    <div class="tabs">
                        <ul>
                           {tabs}
                        </ul>
                    </div>﻿
                </div>

                <div id="content">
                    {content}
                </div>
            </div>
        </div>
            
        <script type="text/javascript">
        tinymce.init({
             selector: "textarea.tiny",
						 style_formats: [
								{title: 'Headers', items: [
										{title: 'h1', block: 'h1'},
										{title: 'h2', block: 'h2'},
										{title: 'h3', block: 'h3'},
										{title: 'h4', block: 'h4'},
										{title: 'h5', block: 'h5'},
										{title: 'h6', block: 'h6'}
								]},

								{title: 'Blocks', items: [
										{title: 'p', block: 'p'},
										{title: 'div', block: 'div'},
										{title: 'pre', block: 'pre'}
								]},

								{title: 'Containers', items: [
										{title: 'section', block: 'section', wrapper: true, merge_siblings: false},
										{title: 'article', block: 'article', wrapper: true, merge_siblings: false},
										{title: 'blockquote', block: 'blockquote', wrapper: true},
										{title: 'hgroup', block: 'hgroup', wrapper: true},
										{title: 'aside', block: 'aside', wrapper: true},
										{title: 'figure', block: 'figure', wrapper: true}
								]}
						],

             plugins: [
								"advlist autolink lists link image charmap print preview hr anchor pagebreak",
								"searchreplace wordcount visualblocks visualchars code fullscreen",
								"insertdatetime media nonbreaking save table contextmenu directionality",
								"emoticons template paste textcolor moxiemanager"
						],

						toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
						toolbar2: "print preview media | forecolor backcolor emoticons",
						visualblocks_default_state: true,
						end_container_on_empty_block: true,
						image_advtab: true,
						templates: [
								{title: 'Test template 1', content: 'Test 1'},
								{title: 'Test template 2', content: 'Test 2'}
						]


        });

    </script>
    </body>
</html>