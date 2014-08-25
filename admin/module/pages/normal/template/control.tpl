    
       <div id="context">			
            <div class="form_row">
                <div class="label">Заголовок H1:</div>
                <div class="row"><input type="text" name="h1" style="width:98%;" value="{h1}" /></div>
            </div>

            <div class="form_row">
                <div class="label">Содержимое:</div>
                <div class="row"><textarea name="content" class="tiny" style="height:400px;" />{context}</textarea></div>
            </div>
        </div>     
        
        <div id="general">		
            <div class="form_row">
                <div class="label">Имя страницы:</div>
                <div class="row"><input type="text" name="name" style="width:200px;" value="{title}"></div>
            </div>

            <div class="form_row">
                <div class="label">Урл страницы:</div>
                <div class="row"><input type="text" name="altname" style="width:200px;" value="{altname}"></div>
            </div>
       </div>    
            
        <div id="secure">
             <div class="form_row">
                <div class="label">Доступ к странице</div>
                <div class="row"><select name="viewgroups" id="select_page_defend" onchange="defend_group(this);">{groups}</select></div>
            </div>
            
            <div id="defend_page">
                <select name="defend_page[]" multiple>
                    {list-groups}
                </select>
            </div>

            <div class="form_row">
                <input id="page_password" type="checkbox" />
                <label for="page_password">Защита паролем:</label>
               
                <div id="form" style="display:none;">
                   <div class="label">Пароль от 4 до 8</div>
                   <input type='text' name='password_access' style='width:160px' class='set_pass' value="{password}" />
                </div>
            </div>

            <div class="form_row">
                <div class="checkbox">
                    <div class="row">
                        <input id="active-page" type="checkbox" name="status" {visible} />
                        <label for="active-page">Скрывать страницу.</label>
                    </div>
                </div>
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
        
        <div id="seo">
            <div class="form_row">
                <div class="label">Seo заголовок</div>
                <div class="row"><input type="text" name="seotitle" value="{seotitle}" style="width:500px;" /></div>
            </div>
            
            <div class="form_row">
                <div class="label">Мета тег Description:</div>
                <div class="row"><textarea name="desc" style="width:500px; height:90px;">{description}</textarea></div>
            </div>

            <div class="form_row">
                <div class="label">Мета тег keywords:</div>
                <div class="row"><textarea name="keyw" style="width:500px; height:90px;">{keywords}</textarea></div>
            </div>
        </div>     