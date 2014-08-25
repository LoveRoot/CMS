<?php
    $data = new core();
?>
<h2>Параметры изображений</h2>

<div class="section">
    <div class="form_row">
        <div class="label">Ширина изображения:</div>
        <input type="text" name="w_img_d" value="<?php echo $data->__config("w_img_d"); ?>" style="width:120px;">
    </div>

    <div class="form_row">
        <div class="label">Высота изображения:</div>
        <input type="text" name="h_img_d" value="<?php echo $data->__config("h_img_d"); ?>" style="width:120px;">
    </div>
</div>

<h2>Водянные знаки</h2>

<div class="section">
    <div class="form_row">
        <div class="checkbox">
            <input id="i_water" type="checkbox" name="i_water" id="water_on_off" <?= $water_on ?> />
            <label for="i_water">Включить водянные знаки на изображениях</label>
        </div>
    </div>

    <div class="form_row" id="control-water">
        <label for="i_water_type">Тип водяного знака:</label>
        <input type="radio" name="i_water_type" action="<?php $data->__config("i_water_type"); ?>" value="text" /> Текст
        <input type="radio" name="i_water_type" action="<?php $data->__config("i_water_type"); ?>" value="image" /> Изображение
    </div>

    <div class="form_row" id="water_type_text">
        <label for="i_water_type_text">Введите текст:</label>
        <input type="text" name="i_water_type_text" value="<?php $data->__config("i_water_type_text"); ?>">
    </div>

    <div class="form_row" id="water_type_img">
        <label for="i_water_type_img">Выберите изображение:</label>
        <input type="file" name="filename" id="i_water_type_image"> &nbsp; <a href="javascript:" id="download_water_image">Загрузить картинку</a>
    </div>
</div>

<h2>Расширения файлов допустимые при загрузке</h2>

<div class="section">
    <div class="form_row">	
        <div class="label">Разрешать к загрузке (Укажите через запятую):</div>
        <input type="text" name="file_downloader" value="<?php echo $data->__config("file_downloader"); ?>" style="width:180px;">
    </div>

    <div class="form_row">
        <div class="label">Допустимый размер:</div>
        <input type="text" name="file_size" value="<?php echo $data->__config("file_size"); ?>" style="width:180px;">
    </div>
</div>

