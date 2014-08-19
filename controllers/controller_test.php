<?php
  class controller_test extends Controller {

		public $title;
		public $description;
		public $keywords;


		public function index_action() {

				$this->view->GetTemplate("test.phtml","main.phtml");
		}
  }
