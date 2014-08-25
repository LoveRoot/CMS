  <form action="{location}" method="POST">
    <div id="maincont">
        <div class="form_row">	
            <div class="label">Название статьи</div>
            <div class="row"><input type="text" name="title" style="width:100%;" value="{title}" /></div>	
        </div>

        <div class="form_row">
            <div class="label">Выберите категорию</div>
            <div class="row"><select name="page" style="width:190px;">{pages}</select></div>								
        </div>

        <div class="form_row">
            <div class="label">Краткий вывод статьи на странице</div>
            <div class="row"><textarea name="shortarticle" rows="22" style="width:83%;" class="tiny">{shortnews}</textarea></div>				
        </div>

        <div class="form_row">
            <div class="label">Вывод полного описания на странице</div>
            <div class="row"><textarea name="fullarticle" rows="22" style="width:83%;" class="tiny">{fullnews}</textarea></div>				
        </div>

        <div class="form_row">
            <input id="status" type="checkbox" name="status" {status-checked} />
            <label for="status">Разместить запись сразу / Отправить запись на дополнительное рассмотрение.</label>
        </div>

        <div class="form_row">
            <input id="main" type="checkbox" name="main" {main-checked} />
            <label for="main">Разместить запись на главной странице / Скрыть запись на главной странице.</label>
        </div>

        <div class="form_row">
            <input id="prioritet" type="checkbox" name="prioritet" {prioritet-checked} />
            <label for="prioritet">Отметить как важное (Приоритетные всегда находятся выше остальных)</label>
        </div>
    </div>
        
     <div id="advanced">
        <div class="form_row">
            <div class="tags_row">
                <div class="label">Теги, добавить поле <a href="javascript:" class="add_tag"><img src="/admin/engine/images/add.png"></a></div>
                <div class="row">
                    {tags}
                </div>	
            </div>
        </div>
    </div>	
                
    <div id="upload">
        <div class="form_row">
            <p>Фотография краткой новости</p>
            <div class="row"><input type="file" name="file_short[]" /></div>
            <a href="javascript:;" id="add_foto_rows_short">Добавить ещё поля</a>
        </div>

        <div class="form_row">
            <p>Фотография полной новости</p>
            <div class="row"><input type="file" name="file_full[]" /></div>
            <a href="javascript:;" id="add_foto_rows_full">Добавить ещё поля</a>
        </div>
    </div> 
        
    <div id="seo">
         <div class="form_row">
            <div class="label">Seo заголовок новости</div>
            <div class="row"><input type="text" name="seotitle" style="width:500px;" value="{seotitle}" /></div>					
        </div>
        
        <div class="form_row">
            <div class="label">Описание статьи</div>
            <div class="row"><textarea name="desc" style="width:500px; height:110px;">{description}</textarea></div>					
        </div>

        <div class="form_row">
            <div class="label">Ключевые слова для статьи, через запятую</div>
            <div class="row"><textarea name="keyw" style="width:500px; height:110px;">{keywords}</textarea></div>						
        </div>
    </div>

    <div class="form_row">
        <input type="submit" name="submit" value="Применить" />
    </div>
</form>  
  