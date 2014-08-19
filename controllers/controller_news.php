<?php

	class controller_news extends Controller {
		public function __construct() {
			parent::__construct();
		}

		public function index_action() {
			$this->view->GetTemplate("main.phtml","system_template/news.phtml");
		}
	}
