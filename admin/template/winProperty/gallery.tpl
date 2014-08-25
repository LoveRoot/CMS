<form action="" method="POST" id="FormWinProp" value="saveWinProp=gallery&id={id}" enctype="multipart/form-data">
    <div id="echo"></div>

    <div class="form_row">
        <div class="label">Название:</div>
        <div class="row"><input type="text" name="title" value="{title}" style="width:200px;" /></div>
    </div>

    <div class="form_row">
        <div class="label">URL имя:</div>
        <div class="row"><input type="text" name="url" value="{url}" style="width:200px;" /></div>
    </div>

    <div class="form_row">
        <div class="checkbox">
            <div class="row">
                <input id="status" type="checkbox" name="status" {status} />
                <label for="status">Активная запись</label>
            </div>
        </div>
    </div>

    <div class="form_row">
        <div class="row">
            <a href="javascript:"  onclick="AddCollectionLogo({id});" style="text-decoration:none;">Загрузить файл...</a>
            <input id="fileLogo" type="file" name="filename" style="display:none;" />
        </div>
        <div id="logo">
            {logo}
        </div>
    </div>

    <div class="form_row">
        <input type="button" value="Применить" id="WinProp">
    </div>
</form>