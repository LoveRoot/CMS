<h1>Добавить / Редактировать вопрос</h1>

<Form action="{location}" method="POST">
    <div id="maincont">
        <div class="form_row">
            <div class="label">Текст вопроса:</div>
            <div class="row"><input type="text" name="title" style="width:97%;" value="{title}" /></div>
        </div>

        <div class="form_row">
            <div class="label">Страницы:</div>
            <div class="row"><select name="page">{pages}</select></div>
        </div>

        <div class="form_row">
            <div class="label">Ответ на вопрос:</div>
            <div class="row"><textarea name="content" style="width:97%; height:400px;" class="tiny">{content}</textarea></div>
        </div>
    </div>

    <div id="control">
        <div class="form_row">
             <div class="row">
                 <input type="checkbox" name="status" id="status" {status} />
                 <label for="status">Разместить запись сразу / Отправить запись на дополнительное рассмотрение.</label>
             </div>
         </div>
    </div>


    <div class="form_row">
        <div class="row"><input type="submit" name="submit" value="Отправить" /></div>
    </div>
</Form>