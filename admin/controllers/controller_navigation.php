<?php
	class controller_navigation extends Controller {
		public function __construct() {
			parent::__construct();
			$this->model = core::GetFactory("admin/models/","model_navigation");
		}

		public function index_action() {
			$data['modules'] = $this->model->GetModules();
			$data['permissions'] = $this->model->GetPermissions();

			$this->view->GetTemplate("main.phtml","navigation/navigation.phtml", $data);
		}
	}
?>