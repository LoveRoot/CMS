<?php
	class controller_tabs extends Controller {
			public function __construct() {
				parent::__construct();
				$this->model = core::GetFactory("admin/models/", "model_tabs");
			}

			public function index_action(&$data="") {
				if(isset($_GET["component"])) {
					$component = core::Vanish($_GET["component"]);

					if (isset($component) && method_exists($this->model, $component)) {
						$data['tabs'] = $this->model->$component();
					}

					$this->view->GetTemplate("main.phtml", "tabs.phtml", $data);
				}
			}
	}
?>