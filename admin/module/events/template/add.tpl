<form action="" method="POST">
	<div class="tabs">
		<ul>
			<li><a href="#maincont">Основные</a></li>			
		</ul>
	</div>
	
	<h1>Создать новое событие</h1>
	
	<div id="bg-content">
		<div id="maincont">
			<div class="form_row">	
				<div class="label">Имя события</div>
				<div class="row"><input type="text" name="title" style="width:100%;" value="{title}" /></div>		
			</div>
						
			<div class="form_row">	
				<div class="label">Дата/время(начало)</div>
				<div class="row">
					<div style="float:left; margin-right:10px; width:80px"><input type="text" name="currentdate" style="width:70px;" value="{thisDate}">
				</div>
				<div style="float:left; width:80px">
					<input type="text" name="currenttime" style="width:70px;" value="{thisTime}">
				</div>	
				
				<div class="label">Дата/время(конец)</div>
					<div style="float:left; margin-right:10px; width:80px">
						<input type="text" name="lastdate" style="width:70px;" value="{lastDate}">
					</div>
					<div style="float:left; width:80px">
						<input type="text" name="lasttime" style="width:70px;" value="{lastTime}">
					</div>						
			</div>		
						
			<div class="form_row">	
				
			</div>	
									
			<div class="form_row">
				<div class="label">Изображение</div>
				<div class="row"><input type="file" name="filename"></div>				
			</div>
						
			<div class="form_row">
				<div class="label">Приоритет</div>
					<div class="row">
						<select name="priority" style="width:140px;">
							<option value="5">Срочный</option>
							<option value="4">Высокий</option>
							<option value="3">Нормальный</option>
							<option value="2">Низкий</option>
							<option value="1">Очень низкий</option>
						</select>
				</div>	
			</div>
						
			<div class="form_row">
				<div class="label">Выберите категорию</div>
				<div class="row"><select name="category" style="width:190px; height:140px;" multiple />{category}</select></div>								
			</div>
						
			<div class="form_row">
				<div class="label">Содержание события</div>
				<div class="row"><textarea name="content" rows="18" style="width:57%;" id="shortnews">{event}</textarea></div>			
			</div>
						
			<div class="form_row">
				<div class="label">Статус события</div>
				<div class="row"><input type="checkbox" name="posted" checked /> Разместить событие сейчас</div>			
			</div>
		</div>			
	</div>			
				
	<div class="form_row">
		<input type="submit" name="submit" value="Создать событие" />
	</div>
</form>