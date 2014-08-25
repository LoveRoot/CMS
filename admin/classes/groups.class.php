<?php
	class groups extends core {
		public function __construct() {
			parent::__construct();
			$this->list = $this->GetListGroups();
		}

		public function GetListGroups() {
                    $list = new pagination("SELECT * From groups where id != 1",
                                           "SELECT id From groups where id != 1", 10);
                    return $list;
		}
                
                public function Delete($id) {
                    $delete = DB::I()->__DeleteItem("groups","id='".$id."'");
                    
                    if ($delete == true) {
                        setcookie("success", "Группа успешно удалена", time() + 1);
                        header("Location: /admin.php?component=groups");
                    }
                    
                }
	}

	class addgroups extends groups {
		public function __construct() {
			parent::__construct();
			if (isset($_POST["f_submit"])) {
				$this->AddGroups($_POST);
			}
		}

		private function AddGroups($data="") {
			$arr = array("site" => array("" => ""), "admin" => array("" => ""));
			$permissions = serialize($arr);

			$this->sql = DB::I()->__InsertItems("groups", array("name" => $this->__Vanish($_POST["gr_name"]), "permissions" => $permissions));

			if ($this->sql == true) {

			}
		}
	}

	class editgroups extends groups {
		public function __construct($id=0) {
			$this->edit = $this->GetDataGroup($id);
			if (isset($_POST["f_submit"])) {
				$this->SetAcceptGroup($_POST);
			}
		}

		public function GetDataGroup($id) {
			return $sql = DB::I()->__SelectItems("groups",array("*"),"id='".$id."'");
		}

		private function SetAcceptGroup($data) {
				$newPermissions = serialize(array("site" => $data["site"], "admin" => $data["admin"]));
				$sql = DB::I()->__UpdateItem("groups","id='".intval($_GET["id"])."'", array("name" => $data["gr_name"],
																																									  "permissions" => $newPermissions));
				if ($sql == true) {

				}

		}
	}
?>