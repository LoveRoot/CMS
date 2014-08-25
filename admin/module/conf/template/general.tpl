<h1>Основные настройки</h1>

<div class="form_row">
    <div class="label">Название сайта</div>
    <div class="row"><input type="text" name="title" value="{title}" style="width:620px;"></div>			
</div>

<div class="form_row">
    <div class="label">Хлебные крошки</div>
    <div class="row"><input type="text" name="name" style="width:620px;" value="{name-site}"></div>		
</div>

<div class="form_row">
    <div class="label">Почтовый ящик</div>
    <div class="row"><input type="text" name="email" value="{email}" style="width:620px;"></div>			
</div>

<div class="form_row">
    <div class="label">Описание сайта</div>
    <div class="row"><textarea name="description" style="width:620px; height:70px;">{description}</textarea></div>		
</div>

<div class="form_row">			
    <div class="label">Ключевые слова</div>
    <div class="row"><textarea name="keywords" style="width:620px; height:70px;">{keywords}</textarea></div>		
</div>

<div class="form_row">
    <div class="label">Шаблон сайта</div>
    <div class="row"><select name="template" style="width:200px;">{template}</select></div>		
</div>

    <div class="form_row">
        <div class="row">
            <div class="checkbox">
                <input id="breadcrumbs" type="checkbox" name="breadcrumbs" action="{breadcrumbs-status}" />
                <label for="breadcrumbs">Выводить хлебные крошки, для вывода разместите тег {breadcrumbs} в теле страницы.</label>
            </div>
        </div>
     </div>  
    <div class="form_row">
        <div class="row">
            <div class="checkbox">
                <input id="rend_cat_auto" type="checkbox" name="rend_cat_auto" action="{auto-category}" />
                <label for="rend_cat_auto">Выводить категории автоматически, для вывода разместите тег {category} в теле страницы.</label>
            </div>  
        </div>
    </div>
    <div class="form_row">
        <div class="row">
            <div class="checkbox">
                <input id="reconstruction" type="checkbox" name="reconstruction" action="{site-stop}" /> 
                <label for="reconstruction">Отключить сайт на реконструкцию (Сайт будет доступен только вам).</label>
            </div>
        </div>
    </div>

