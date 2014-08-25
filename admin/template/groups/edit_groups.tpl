<header><h1 class="inline">Редактирование группы - <span style="color:red;s">{name}</span></h1></header>

<section class="setpermissions">
	<Form action="" method="POST" name="">

		<section id="maincont">
			<section class="form_row">
					<section class="label">Имя группы</section>
					<input type="text" name="gr_name" value="{gr-name}" style="width:200px;">
			</section>
		</section>
		<section id="site">
		</section>
		<section id="admin">
				<table class="noborder">
						<tr>
								<th>Имя модуля</th>
								<th>Разрешения</th>
								<th>Создание</th>
								<th>Изменение</th>
								<th>Удаление</th>
						</tr>
						<tr>
								<td>Настройки</td>
								<td>
									<input type="checkbox" name="admin[options][status]" id="options" />
									<label for="options"></label>
								</td>
								<td></td>
								<td></td>
								<td></td>
						</tr>

						<tr>
								<td>Страницы</td>
								<td>
									<input type="checkbox" name="admin[page][status]" id="page_active" />
									<label for="page_active"></label>
								</td>
								<td>
									<input type="checkbox" name="admin[page][public]" id="page_public" />
									<label for="page_public"></label>
								</td>
								<td>
									<input type="checkbox" name="admin[page][edit]" id="page_edit" />
									<label for="page_edit"></label>
								</td>
								<td>
									<input type="checkbox" name="admin[page][delete]" id="page_delete" />
									<label for="page_delete"></label>
								</td>
						</tr>

						<tr>
								<td>Учётные записи</td>
								<td>
									<input type="checkbox" name="admin[users][status]" id="users_active" />
									<label for="users_active"></label>
								</td>
								<td>
									<input type="checkbox" name="admin[users][public]" id="users_public" />
									<label for="users_public"></label>
								</td>
								<td>
									<input type="checkbox" name="admin[users][edit]" id="users_edit" />
									<label for="users_edit"></label>
								</td>
								<td>
									<input type="checkbox" name="admin[users][delete]" id="users_delete" />
									<label for="users_delete"></label>
								</td>
						</tr>

						<tr>
								<td>Рабочие группы</td>
								<td>
									<input type="checkbox" name="admin[groups][status]" id="groups_active" />
									<label for="groups_active"></label>
								</td>
								<td>
									<input type="checkbox" name="admin[groups][public]" id="groups_public" />
									<label for="groups_public"></label>
								</td>
								<td>
									<input type="checkbox" name="admin[groups][edit]" id="groups_edit" />
									<label for="groups_edit"></label>
								</td>
								<td>
									<input type="checkbox" name="admin[groups][delete]" id="groups_delete" />
									<label for="groups_delete"></label>
								</td>
						</tr>

						<tr>
								<td>Рассылки</td>
								<td>
									<input type="checkbox" name="admin[mailing][status]" id="mailing_active" />
									<label for="mailing_active"></label>
								</td>
								<td>
									<input type="checkbox" name="admin[mailing][public]" id="mailing_public" />
									<label for="mailing_public"></label>
								</td>
								<td>
									<input type="checkbox" name="admin[mailing][edit]" id="mailing_edit" />
									<label for="mailing_edit"></label>
								</td>
								<td>
									<input type="checkbox" name="admin[mailing][delete]" id="mailing_delete" />
									<label for="mailing_delete"></label>
								</td>
						</tr>
				</table>
		</section>

		<section class="form_row">
				<input type="submit" name="f_submit" value="Изменить группу" />
		</section>
	</Form>
</section>