<form action="" method="POST" id="FormWinProp" value="saveWinProp=faq&id={id}">
	<div id="echo"></div>
	
	<div class="form_row">
		<div class="label">Название вопроса:</div>
		<div class="row"><input type="text" name="title" value="{title}" style="width:270px;" /></div>
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
            <input type="button" value="Применить" id="WinProp">
	</div>
</form>