<h1 class="inline">Новая страница</h1>

<form action="{location}" action="" method="POST">
    <div id="maincont">
        <div class="form_row">
            <div class="label">Имя категории:</div>
            <div class="row"><input type="text" name="name" style="width:200px;" value="{title}"></div>
        </div>

        <div class="form_row">
            <div class="label">Урл ссылка:</div>
            <div class="row"><input type="text" name="altname" style="width:200px;" value="{altname}"></div>
        </div>

         <div class="form_row">
            <div class="label">Страница:</div>
            <div class="row">
		<select name="page" style="width:200px;">
                    <option value="0">---</option>
                    {pages}
		</select>
            </div>
        </div>

        <div class="form_row">
            <div class="label">Записей на страницу:</div>
            <div class="row"><input type="number" name="num_row" style="width:200px;" value="{pagination}"></div>
        </div>
    </div>

    <div id="context">
        <div class="form_row">
            <div class="label">Заголовок H1:</div>
            <div class="row"><input type="text" name="h1" style="width:100%;" value="{h1}" /></div>
        </div>

        <div class="form_row">
            <div class="label">Содержимое:</div>
            <div class="row"><textarea name="content" class="tiny" style="height:400px;" />{context}</textarea></div>
        </div>
    </div>

    <div id="logotype">
         <div class="form_row">
              <div class="loadimage">
                   <div class="label">Логотип:</div>
                   <div><img src="{logo}" alt="" title="" /></div>
                   <input type="file" name="filename" />
               </div>
         </div>
    </div>

    <div id="advanced">
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
               <div class="row">
                   <input id="status" type="checkbox" name="status" />
                   <label for="status">Скрывать страницу</label>
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
             <div class="label">Описание для категории:</div>
             <div class="row"><textarea name="desc" rows="5" cols="60">{description}</textarea></div>
        </div>

        <div class="form_row">
            <div class="label">Ключевые слова для категории:</div>
            <div class="row"><textarea name="keyw" rows="5" cols="60">{keywords}</textarea></div>
        </div>
    </div>

    <div class="form_row">
        <input type="submit" name="submit" value="Отправить">
    </div>
</Form>