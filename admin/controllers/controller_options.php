<?php

class controller_options extends Controller{
    public function __construct() {
        parent::__construct();
        $this->model = new model_options();
    }

		public function save_conf_action($vParams = array()) {
			$vParams = $_POST;

			$result = $this->model->SaveConf($vParams);

			if ($result == true) {
				if (isset($vParams["save_and_exit"])) {
					core::GetSystemError("Ваши параметры были успешно сохранены", 1);
					Model::Redirect301("/admin.php");
				}	else {
					core::GetSystemError("Ваши параметры были успешно сохранены", 1);
					Model::Redirect301($_SERVER["HTTP_REFERER"]);
				}
			}
		}

    public function index_action(&$data=array(), &$vParams = array()) {
        $data['title'] = "Настройка сайта";
				$data['param'] = $this->model->GetConfig();
				$data['template'] = $this->model->GetTemplate("template/");
        $this->view->GetTemplate("options.phtml","main.phtml", $data);
    }
}

?>
