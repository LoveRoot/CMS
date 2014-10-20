<?php

    class Pagination
    {
        private static $instance;
        static $count, $res99, $posts, $total, $page, $start, $sql, $result;

        public static function I()
        {
            if (!(self::$instance instanceof self))
            {
                self::$instance = new self();
            }
            return self::$instance;
        }
        
        public static function SetPagination($request = "", $count_sql = "", $num = 10) {
            $data = array();
            
            self::$count = $num;
           
            self::$res99 = mysqli_query(Model::$link, "{$count_sql}");
            self::$posts = mysqli_num_rows(self::$res99);

            self::$total = @intval((self::$posts - 1) / $num) + 1;
            self::$page = isset($_GET["page"]) ? intval($_GET["page"]) : 1;

            if (empty(self::$page) or self::$page < 0)
                self::$page = 1;
            if (self::$page > self::$total)
                self::$page = self::$total;

            $start = self::$page * $num - $num;
            
            self::$result = Model::QueryString("{$request} LIMIT {$start}, {$num}");
            if (self::$result == true) {
                do
                {
                   $data[] = self::$result;
                } while(self::$result = mysqli_fetch_assoc(Model::$query));
            }

            return $data;
        }
        
        public static function navigation($url_target)
        {
            $pages = "";
            $url = $url_target;

            for($i=1; $i <= self::$total; ++$i) {
		$class = $i == self::$page ? "active":"";
		$pages .= "<a class='{$class}' href=".$url.($i).">".$i."</a>";
            }

            if (self::$posts > self::$count) {
                return $pages;
            }
        }
        
        private function __construct() {}

    }

?>