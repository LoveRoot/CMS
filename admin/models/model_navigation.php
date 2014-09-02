<?php

	class model_navigation extends Model {
		public function __construct() {

		}

		public function UnSerialize($str="") {
			return unserialize($str);
		}

		public function GetPermissions() {
			$get_permissions = Model::QueryString("SELECT gr.permissions From groups as gr, users as usr WHERE login = '".$_COOKIE["user"]."' and gr.id = usr.groups");
			return $this->UnSerialize($get_permissions["permissions"]);
		}

		public function GetModules() {
			$modules = array();
			$result = Model::SelectItems("module", array("*"));
			do {
				$modules[] = $result;
			} while($result = mysqli_fetch_assoc(Model::$query));
			return $modules;
		}
	}
