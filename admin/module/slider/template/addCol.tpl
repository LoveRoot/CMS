<h1>Добавление коллекции для ротатора изображений</h1>

<Form action="{SELF}" method="POST">	
    <div id="bg-content">
        <div id="maincont">
            <div class="leftcol">
                <div class="form_row">
                    <div class="label">Название коллекции</div>
                    <div class="row"><input type="text" name="name" style="width:500px;" value="{name}"></div>
                </div>
                <div class="form_row">
                    <div class="label">Описание коллекции</div>
                    <div class="row"><textarea name="description" style="width:500px; height:215px;">{description}</textarea></div>
                </div>
            </div>
            <div class="leftcol">
                 <div class="form_row">
                    <div class="label">Для страниц</div> 
                    <div class="row"><select name="category[]" id="category" style="width:200px; height:290px;" multiple>{category}</select></div>	
                </div>
            </div>
        </div>
    </div>

    <div class="form_row">
        <input type="submit" name="submit" value="Добавить коллекцию" />
    </div>
</form>