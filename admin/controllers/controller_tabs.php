<?php

class controller_tabs extends Controller {

    public function __construct() {
        parent::__construct();
        $this->model = core::GetFactory("admin/models/", "model_tabs");
    }

    public function index_action(&$data = "", &$vParams = array()) {
        if (isset($_GET["component"])) {
            $component = core::Vanish($_GET["component"]);

            if (isset($component) && method_exists($this->model, $component)) {
                $data['action'] = core::Vanish($_GET['action']);
                $data['tabs'] = $this->model->$component();
								if (isset($_GET["component"]) && $_GET["component"] == "pages" && (isset($_GET["action"]) && $_GET["action"] == "property")) {
									$data['type'] = $this->model->TypePage(intval($_GET["id"]));
								}	else {
									$data['type'] = isset($_GET['type']) ? core::Vanish($_GET['type']) : "index";
								}
            }

            $this->view->GetTemplate("main.phtml", "tabs.phtml", $data);
        }
    }

}

?>