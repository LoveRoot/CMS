<div id="general">		
    <div class="form_row">
        <div class="label">Имя страницы:</div>
        <div class="row"><input type="text" name="name" style="width:200px;" value="{title}"></div>
    </div>
    
    <div class="form_row" style="display:none;">
        <div class="label">Урл страницы:</div>
        <div class="row"><input type="text" name="altname" style="width:200px;" value="{altname}"></div>
    </div>
</div>
    
<div id="template">
    <div class="form_row">
        <div class="label">Использовать шаблон</div>

        <div id="show_template">
             <select name="page_template" style="width:180px;">
                 <option value="">Не использовать</option>
                   {page-template}
              </select>
        </div>
    </div>
</div>
