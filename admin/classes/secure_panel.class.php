<?php

    class secure_panel extends Model {

        public function __construct() {
            parent::__construct();
        }

    }

    class __GetPermissions extends secure_panel {

        public $protect = 1;

        public function __construct($sql) {
            parent::__construct();

            $this->sql = mysqli_query($this->link, $sql);
            $this->result = mysqli_fetch_row($this->sql);

            if ($this->result[0] == 1) {
                return $this->protect = 0;
            }
        }

    }

?>