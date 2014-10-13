<?php

    class controller_authorize extends Controller
    {

        public function __construct()
        {
            parent::__construct();
            $this->model_authorize = core::GetFactory("models/", "model_authorize");

            if (isset($_POST["authorize"]))
            {
                $login = core::Vanish($_POST["login"]);
                $password = md5($_POST["password"]);

                $this->model_authorize->GetAuthorize($login, $password);
            }

            if (isset($_GET["do"]) && $_GET["do"] == "logout")
            {
                $this->model_authorize->Logout();
            }

            $status_enable = Model::Config("site_status");

            if ($status_enable == "on") {
                Model::Redirect301("/siteoff/");
            }
        }

        public function index_action(&$data = "")
        {
            if ((!isset($_COOKIE["user"])))
            {
                $this->view->GetTemplate("main.phtml", "authorize/authorize_form.phtml");
            } else
            {
                $data['user'] = $this->model_authorize->GetUserInfo($_COOKIE["user"]);
                $this->view->GetTemplate("main.phtml", "authorize/authorize_success.phtml", $data);
            }
        }

        function __destruct()
        {

        }

    }

?>
