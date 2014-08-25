<?php

    class configure extends core {

        public function __construct() {
            parent::__construct();
        }

    }

    class general extends configure {

        public function __construct() {

        }

        public function GetTemplate($path)
        {
            $this->path = $path;
            $this->dir = scandir($this->path);
            $this->cat = $this->__config("template");

            foreach ($this->dir as $this->template)
            {
                if ($this->template == "." || $this->template == "..")
                continue;
                if (is_dir($this->path . "/" . $this->template)) {
                    $selected = $this->template == $this->cat ? 'selected="selected"' : '';
                    $this->theme .= "<option ".$selected.">".$this->template."</option>";
                }
            }
            return $this->theme;
        }

        public function GetFile($path, $this_page="")
        {
            $this->path = $path;
            $this->dir = scandir($this->path);
            $this->cat = $this->__config("template");

            foreach ($this->dir as $this->template)
            {
                if ($this->template == "." || $this->template == "..")
                continue;
                if (is_file($this->path . "/" . $this->template)) {
                    $selected = $this->template == $this_page ? 'selected="selected"' : '';
                    $this->theme .= "<option ".$selected.">".$this->template."</option>";
                }
            }

            return $this->theme;
        }
    }

    class database extends configure {

        public function __construct() {
            parent::__construct();
        }

        public function getCountPost() {
            $this->sql = mysqli_query($this->link, "Select COUNT(id) From Article") or die(mysqli_error($this->socket));
            while ($this->result = mysqli_fetch_array($this->sql)) {
                return $this->countPost = $this->result[0];
            }
        }

        public function getCountComments() {
            $this->sql = mysqli_query($this->link, "Select COUNT(id) From Comments") or die(mysqli_error($this->socket));
            while ($this->result = mysqli_fetch_array($this->sql)) {
                return $this->countComments = $this->result[0];
            }
        }

    }

    class module extends configure {

        public function __construct() {
            parent::__config();
        }

        public function getLastnews() {
            return $this->__config("lastnews");
        }

        public function getWhoonline() {
            return $this->__config("whoonline");
        }

        public function getLastcomments() {
            return $this->__config("lastcomments");
        }

        public function getTags() {
            return $this->__config("tags");
        }

        public function getEvent() {
            return $this->__config("event");
        }

        public function getSearch() {
            return $this->__config("search");
        }

        public function getSlider() {
            return $this->__config("slider");
        }

    }

    class comments extends configure {

        public function __construct() {

        }

        public function getActiveComments() {
            return $this->__config("comments");
        }

        public function getCommentsGuest() {
            return $this->__config("comments_guest");
        }

        public function getCommentsGuestMod() {
            return $this->__config("guest_comments_moderation");
        }

        public function getCommentsModAll() {
            return $this->__config("comments_moderation");
        }

        public function getCommentsNav() {
            return $this->__config("comments_num_rows");
        }

    }

?>