<?php

	class model_tabs extends Model {

		public $tabs;

		public function __construct() {

		}

		public function TypePage($id) {
			$result = Model::SelectItems("pages", array("page_type"), "id={$id}");
			return $result["page_type"];
		}


		public function options() {
					return $this->tabs = array
					(
							"index" => array
							(
									"type" => array
									(
										 "index" => array
											(
												 0 => array("id" => "#maincont", "name" => "Параметры"),
											   1 => array("id" => "#defend", "name" => "Защита")
											)
									)

							)
					);
		}

		public function pages() {
				return $this->tabs = array
					(
						"index" => array
						(
								"type" => array
								(
										"index" => array
										(
												0 => array("id" => "#maincont", "name" => "Список страниц")
										)
								)

					  ),
						"add" => array
						(
								"type" => array
								(
										"article" => array
										(
												0 => array("id" => "#maincont", "name" => "Основное"),
												1 => array("id" => "#advanced", "name" => "Контент"),
												2 => array("id" => "#seo", "name" => "SEO")
										)
								)

						),
						"property" => array
						(
							"type" => array
							(
								 "article" => array
									(
											0 => array("id" => "#maincont", "name" => "Основное"),
											1 => array("id" => "#advanced", "name" => "Контент"),
											2 => array("id" => "#seo", "name" => "SEO")
									)
							)
						)
					);
			}
	}
