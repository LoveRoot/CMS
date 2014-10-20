<?php
    class controller_breadcrumbs extends Controller {
        public function __construct() {
            parent::__construct();
            $this->model = core::GetFactory("models/", "model_breadcrumbs");
        }
        
        public function index_action(&$vParams = array()) {
            $data["breadcrumbs"] = $this->model->GetBreadcrumbs($vParams); 
            $this->view->GetTemplate("main.phtml","system_template/breadcrumbs.phtml", $data);
        }
    }
?>
