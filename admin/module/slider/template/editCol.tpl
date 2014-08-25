<div class="form_row">{ajax-submit}</div>

<Form action="" method="POST" enctype="multipart/form-data" id="slider" article="{id}">
    <div id="general">
        <div class="leftcol">
            <div class="form_row">
                 <div class="label">Имя коллекции</div>
                 <input type="text" name="name" id="name" style="width:500px;" value="{name}">
            </div>
            <div class="form_row">
                <div class="label">Описание коллекции</div>
                    <textarea name="description" style="width:500px; height:215px;" id="description">{description}</textarea>
            </div>
        </div>
        
        <div class="leftcol">
            <div class="form_row">
                <div class="label">Для страниц</div> 
                <div class="row">
                    <select name="category[]" id="category" style="width:200px; height:290px;" multiple>
                        {category-main}
                        {category}
                    </select>
                </div>	
            </div>
        </div>
    </div>
		
    <div id="photo">
	{images}
    </div>
    
    <div class="form_row">
        <input type="submit" name="update" value="Сохранить">
    </div>
</Form>