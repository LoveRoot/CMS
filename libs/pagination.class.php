<?php

    class Pagination
    {

        public function __construct($request = "", $count_sql = "", $num = 0)
        {
						$this->count = $num;

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
						$pages = "";
            $url = $url_target;

            for($i=1; $i <= $this->total; ++$i) {
							$class = $i == $this->page ? "active":"";
							$pages .= "<a class='{$class}' href=".$url.($i).">".$i."</a>";
						}

            if ($this->posts > $this->count) {
                return $pages;
            }
        }

    }

?>