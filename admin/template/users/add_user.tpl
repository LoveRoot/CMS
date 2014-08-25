<header><h1 class="inline">Новая учётная запись</h1></header>

<Form action="" name="" method="POST">

    <section id="maincont">
        <section class="form_row">
            <section class="label">Логин:</section>
            <input type="text" name="adm_login" placeholder="Ваш логин, можно Русскими" style="width:25%;" value="{login}" />
        </section>

        <section class="form_row">
            <section class="label">Пароль:</section>
            <input type="password" name="adm_password" placeholder="Ваш пароль, от 1 до 20 символов" style="width:25%;" />
        </section>

        <section class="form_row">
            <section class="label">Повторите пароль:</section>
            <input type="password" name="adm_repeat_password" placeholder="Повторите пароль" style="width:25%;" />
        </section>
        
        <section class="form_row">
            <section class="label">Почтовый ящик:</section>
            <input type="email" name="adm_email" placeholder="admin@yandex.ru" style="width:25%;" required="" value="{email}" />
        </section>
        
        <section class="form_row">
            <section class="label">Группа пользователя:</section>
            <select name="group" style="width:25%;">
                {groups}
            </select>
        </section>
    </section>

    <section id="advanced">
        <section class="form_row">
            <section class="label">Имя:</section>
            <input type="text" name="adm_name" placeholder="Василий" style="width:25%;" value="{name}" />
        </section>

        <section class="form_row">
            <section class="label">Отчество:</section>
            <input type="text" name="adm_old_name" placeholder="Васильевич" style="width:25%;" value="{old-name}" />
        </section>

        <section class="form_row">
            <section class="label">Фамилия:</section>
            <input type="text" name="adm_family" placeholder="Пупкин" style="width:25%;" value="{family}" />
        </section>

        <section class="form_row">
            <section class="label">Телефон:</section>
            <input type="text" name="adm_phone" placeholder="Номер телефона" style="width:25%;" value="{phone}" />
        </section>

        <section class="form_row">
            <section class="label">Допольнительно, о себе:</section>
            <textarea name="adm_usr_info" style="width:25%; height:120px;">{usr-info}</textarea>
        </section>
    </section>

    <section class="form_row">
        <input type="submit" name="f_submit" value="Добавить пользователя" />
    </section>
</Form>