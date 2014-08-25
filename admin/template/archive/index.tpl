<!doctype html>
	<html>
		<head>
			<meta charset="UTF-8" />
			<title>{title}</title>
			<script src="/javascript/jquery.js"></script>
			<script src="/javascript/jquery.smooth-scroll.min.js"></script>
			<script src="/javascript/jquery-ui-1.8.18.custom.min.js"></script>
			<script src="/admin/java/ajaxform.js"></script>
			<script src="/javascript/lightbox.js"></script>
			<script src="/javascript/tabs.js"></script>
			<script src="/javascript/wysibb/jquery.wysibb.js" charset="utf-8"></script>		
			<script src="/admin/java/engine.js"></script>			
			<script src="/admin/java/options.js" type="text/javascript"></script>	
			<link rel="stylesheet" type="text/css" href="/javascript/wysibb/theme/default/wbbtheme.css" />
			<link rel="stylesheet" type="text/css" href="/admin/template/style/style.css" />
			<link rel="stylesheet" type="text/css" href="/admin/template/style/lightbox.css" />			
		</head>
	<body>
		{message}
		<div id="modal_window">
			<div id="act">
				<div id="title">
				</div>
				<div id="context">
				</div>
			</div>
			<div id="close"></div>
		</div>
		
		<div id="bg_layer"></div>
		
		<div id="container">
			<div id="header">
				<div id="header-container">
					<div id="navigation">
						<ul>
							<li><a href="?a=journal"><img src="/admin/template/images/ico/admin/mainPage.png" alt="Главная" title="Главная" />Главная</a></li>
							{module}
						</ul>
					</div>
				</div>
			</div>

			<div id="content">
				{content}
			</div>
		</div>
		
		<div id="footer">
			{footer}
		</div>
	</body>
</html>