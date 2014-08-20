<?php

	class controller_article extends Controller {
		public function __construct() {
			parent::__construct();
			$this->model = new model_article();
		}

		public function index_action(&$data = array(), $params=null) {
			$p_id = 21;

			$data['news'] = $this->model->GetShortNews($p_id);

			$data['title'] = empty($data['news']->result['seotitle']) ? $data['news']->result['title'] : core::Config("title");
			$data['description'] = !empty($data['news']->result['description']) ? $data['news']->result['descroption'] : core::Config('description');
			$data['keywords'] = !empty($data['news']->result['keywords']) ? $data['news']->result['keywords'] : core::Config('keywords');


			$this->view->GetTemplate("system_template/news.phtml","main.phtml", $data);
		}
	}
