<?php

class pagination
{
	public $num;
	public $total;
	public $page;
	public $res99;
	public $result;

	const host = "localhost";
	const user = "root";
	const password = "";
	const DB = "test";

	public function __construct($request, $count_sql, $num)
	{
            $this->link = mysqli_connect(self::host, self::user, self::password, self::DB);
            $this->select_db = mysqli_select_db($this->link, self::DB);

            $this->num = $num;
            $this->sort = $sort;
            $this->request = $request;
            $this->where = $where;
            $this->page = $_POST['page'];

            $this->res99 = mysqli_query($this->link, "$count_sql");
            $this->posts = mysqli_num_rows($this->res99);
            // Находим общее число страниц
            $this->total = @intval(($this->posts - 1) / $this->num) + 1;
            // Определяем начало сообщений для текущей страницы
            $this->page = intval($this->page);
            // Если значение $page меньше единицы или отрицательно
            // переходим на первую страницу
            // А если слишком большое, то переходим на последнюю
            if(empty($this->page) or $this->page < 0) $this->page = 1;
            if($this->page > $this->total) $this->page = $this->total;
            // Вычисляем начиная к какого номера
            // следует выводить сообщения
            $this->start = $this->page * $this->num - $this->num;
            // Выбираем $num сообщений начиная с номера $start
            $this->res99 = mysqli_query($this->link, "$request LIMIT $this->start, $this->num");
            $this->result = mysqli_fetch_assoc($this->res99);
            $this->affected_rows = "<div style=\"margin-bottom:10px;\">Ответов получено:"." ".mysqli_affected_rows($this->link)."</div>";
	}

	public function navigation($url, $action)
	{
		$this->url = $url;

		if ($this->page != 1) $pervpage = '<a onclick="'.$action.'(this)" page=\'\' href=\'javascript:;\'><img src="/admin/template/images/admin/beginning.jpg" alt="Начало" /></a>&nbsp;
																			 <a onclick="'.$action.'(this)" page='.($this->page - 1).' href=\'javascript:;\'><img src="/admin/template/images/admin/pervPage.jpg" alt="Назад" /></a>&nbsp;';
		// Проверяем нужны ли стрелки вперед

		// Находим две ближайшие станицы с обоих краев, если они есть
		if($this->page - 2 > 0) $page2left = '<a onclick="'.$action.'(this)" page='.($this->page - 2).' href=\'javascript:;\'>'.($this->page - 2).'</a>';
		if($this->page - 1 > 0) $page1left = '<a onclick="'.$action.'(this)" page='.($this->page - 1).' href="javascript:;">'.($this->page - 1).'</a>';
		if($this->page + 2 <= $this->total) $page2right = '<a onclick="'.$action.'(this)" page='.($this->page + 2).' href="javascript:;">'.($this->page + 2).'</a>';
		if($this->page + 1 <= $this->total) $page1right = '<a onclick="'.$action.'(this)" page='.$nextPage.'>'.($this->page + 1).'</a>';
		if ($this->page != $this->total) $nextpage = '<a onclick="'.$action.'(this)" page='.($this->page + 1).' href=\'javascript:;\'><img src="/admin/template/images/admin/nextPage.jpg" alt="Далее" /></a>';

		// Вывод меню

		if ($this->posts > $this->num)
		{
                    return "<nav class='nav'>".
                                $pervpage . "&nbsp;" . "<strong id='page' page=" . $this->page . ">" . $this->page . "</strong> / " . $this->total . "&nbsp;" . $nextpage.
                            "</nav>";
            }
	}

	public function __destruct()
	{
		@mysqli_free_result($this->sql);
		@mysqli_close($this->link);
	}
}
?>