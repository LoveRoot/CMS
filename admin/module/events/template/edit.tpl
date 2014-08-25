<h1>Редактировать событие</h1>
<form action="{location}" method="POST">
	<div class="tabs">
		<ul>
			<li><a href="#maincont">Основные</a></li>
			<li><a href="#advanced">Дополнительно</a></li>
		</ul>
	</div>
	<div id="maincont">
		<div class="form_row">
			<div class="label">Заголовок события</div>
			<input type="text" name="title" size="100" value="{title}" />
		</div>
				
		<div class="form_row">	
				<div class="label">Дата/время(начало)</div>
				<div class="row"><div style="float:left; margin-right:10px; width:80px"><input type="text" name="currentdate" style="width:70px;" value="{begin-Date}"></div>
				<div style="float:left; width:80px"><input type="text" name="currenttime" style="width:70px;" value="{begin-Time}"></div></div>					
			</div>		
						
		<div class="form_row">	
			<div class="label">Дата/время(конец)</div>
			<div class="row"><div style="float:left; margin-right:10px; width:80px"><input type="text" name="lastdate" style="width:70px;" value="{last-Date}"></div>
			<div style="float:left; width:80px"><input type="text" name="lasttime" style="width:70px;" value="{last-Time}"></div></div>						
		</div>	
		
		<div class="form_row">
			<div class="label">Изображение</div>
			<div class="row"><input type="file" name="filename"></div>				
		</div>
		
		<div class="form_row">
			<div class="label">Приоритет</div>
			<select name="priority" style="width:190px;">
				{prioritet}
			</select>
		</div>

		<div class="form_row">
			<div class="label">Для страниц</div> 
			<div class="row"><select name="category[]" style="width:190px; height:190px;" multiple>{page}</select></div>	
		</div>
		
		<div class="form_row">
			<div class="label">Содержание события</div>
			<div class="row"><textarea name="content" rows="18" style="width:57%;" id="shortnews">{event}</textarea></div>			
		</div>
						
		
	</div>	

	<div id="advanced">
		<div class="form_row">
			<div class="label">Статус события</div>
			<input type="checkbox" name="posted" {status} /> Разместить событие сразу / Отправить событие на дополнительное рассмотрение.
		</div>
		
		<div class="form_row">
			<div class="label">Дочерние категории</div>
			<input type="checkbox" name="сhildcategories" {сhild-categories} /> Показывать в дочерних категориях.
		</div>
	</div>
	
	<div class="form_row">
		<input type="submit" name="submit" value="Обновить запись" style="margin-left:180px;" />
	</div>
</form>