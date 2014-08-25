<!doctype html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>{title}</title>
				<script src="/javascript/jquery.js"></script>
        <script src="/admin/javascript/engine.js"></script>
        <link rel="stylesheet" type="text/css" href="/admin/template/style/engine.css" />
        <link rel="stylesheet" type="text/css" href="/admin/template/style/style.css" />
    </head>
    <body>
        {message}
        <div id="container">
            <div id="logo" style="width:200px; margin:0 auto;">
                 <a href="/admin/"><img src="/admin/template/images/logo.png" alt="Логотип" title="Логотип" /></a>
             </div>

            <div id="content">
                {content}
            </div>
        </div>
    </body>
</html>