<?php

    class Pagination
    {

        public function __construct($request = "", $count_sql = "", $num = 0)
        {
            $this->res99 = mysqli_query(Model::$link, "{$count_sql}");
            $this->posts = mysqli_num_rows($this->res99);

            $this->total = @intval(($this->posts - 1) / $num) + 1;
            $this->page = isset($_GET["page"]) ? intval($_GET["page"]) : 1;

            if (empty($this->page) or $this->page < 0)
                $this->page = 1;
            if ($this->page > $this->total)
                $this->page = $this->total;

            $this->start = $this->page * $num - $num;
            $this->sql = mysqli_query(Model::$link, "{$request} LIMIT $this->start, $num");
            $this->result = mysqli_fetch_assoc($this->sql);
        }

        public function navigation($url_target)
        {
            $url = $url_target;

            if ($this->page != 1)
                $pervpage = '<a href= /' . $url . '1' . '>Начало</a>&nbsp;<a href= /' . $url . ($this->page - 1) . '>Назад</a>';
            // Проверяем нужны ли стрелки вперед
            if ($this->page != $this->total)
                $nextpage = ' <a href=/' . $url . ($this->page + 1) . '>Вперёд</a>';

            // Находим две ближайшие станицы с обоих краев, если они есть
            if ($this->page - 2 > 0)
                $page2left = "<a class='deactive-nav' href=/" . $url . ($this->page - 2) . ">" . ($this->page - 2) . "</a>";
            if ($this->page - 1 > 0)
                $page1left = "<a class='deactive-nav' href=/" . $url . ($this->page - 1) . '>' . ($this->page - 1) . "</a>";
            if ($this->page + 2 <= $this->total)
                $page2right = "<a class='deactive-nav' href=/" . $url . ($this->page + 2) . ">" . ($this->page + 2) . "</a>";
            if ($this->page + 1 <= $this->total)
                $page1right = "<a class='deactive-nav' href=/" . $url . ($this->page + 1) . '>' . ($this->page + 1) . "</a>";

            // Вывод меню

            if ($this->posts > $this->count)
            {
                return $this->pagination = "<div class='pagination'>" .
                        $pervpage . $page2left . $page1left . "<span class='active-nav'>" . $this->page . "</span>" . $page1right . $page2right . $nextpage .
                        "</div>";
            }
        }

    }

?>