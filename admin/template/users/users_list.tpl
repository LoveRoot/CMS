<section id="users">
    <section id="action">
        <a class="add-item" href="?component=users&model=addusers">Добавить пользователя</a>
    </section>

    <header><h1>Список пользователей</h1></header>

    <section class="users-section">
        <ul>
            {users}
        </ul>
    </section>
</section>

<section id="low-search">
    <header><h1>Поиск пользователей</h1></header>

    <Form action="" method="POST">
        <section class="row">
            <input type="text" name="forname" style="width:180px;" />
            <input type="button" name="ajax_send" value="Искать" onclick="ajax_submit('/admin/module/users/search.php', 'low_search', '#view ul')">
        </section>
        <section class="row">
            <span>Поиск:&nbsp;</span>
            <span>
                <input type="radio" name="type" value="normal" id="type_normal" checked />
                <label for="type_normal">Полное имя</label>
            </span>

            <span>
                <input type="radio" name="type" value="fulltext" id="type_fulltext" checked />
                <label for="type_fulltext">Похожее имя</label>
            </span>
        </section>
    </Form>

    <section id="view" class="users-section"><ul></ul></section>

</section>

<section id="search">
    <header><h1>Расширенный поиск пользователей</h1></header>
    <Form action="" method="POST">
        <section class="row">
            <input type="text" name="data" style="width:180px;" />
            <input type="button" name="ajax_send" value="Искать" onclick="ajax_submit('/admin/module/users/search.php', 'high_search', '#view_high ul')">
        </section>
        <section class="row">
            <p>Фильтр:&nbsp;</p>

            <section class="filter_search">
                <span>
                    <input type="radio" name="var" value="login" id="var_login" checked />
                    <label for="var_login">Логин</label>
                </span>

                <span>
                    <input type="radio" name="var" value="email" id="var_email" checked />
                    <label for="var_email">Почта(email)</label>
                </span>

                <span>
                    <input type="radio" name="var" value="active" id="var_active" checked />
                    <label for="var_active">Активные</label>
                </span>

                <span>
                    <input type="radio" name="var" value="no_active" id="var_no_active" checked />
                    <label for="var_no_active">Заблокированные</label>
                </span>
            </section>
        </section>
    </Form>

    <section id="view_high" style="margin-top:30px;" class="users-section"><ul></ul></section>
</section>

