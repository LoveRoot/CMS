<?php

class controller_siteoff extends Controller {
	public function __construct() {
		parent::__construct();
	}

	public function index_action() {
		$this->data['title'] = "Сайт временно приостановлен";
		View::I()->GetTemplate("main.phtml", "site_off.phtml", $this->data);
	}
}
