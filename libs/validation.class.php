<?php
		class Validation {
			public $maxlength;
			public $minlength;
			public $message;

			public function __construct() {
			}

			public function setValid($array="") {
					$valid_status = array();

					foreach($array as $row => $valid) {

							$this->maxlength = (isset($valid['maxlength'])) ? $valid['maxlength'] : 20;
							$this->minlength = (isset($valid['minlength'])) ? $valid['minlength'] : 0;

							switch($valid["type"]) {
									case "string_ru":
										$pattern = "[а-яА-яА-Я0-9]";
										$valid_status[$row]["status"] = (preg_match("/^{$pattern}{{$this->minlength},{$this->maxlength}}+$/ui", $valid["content"]));

									break;
									case "string_en":
										$pattern = "[a-zA-zA-Z0-9]";
										$valid_status[$row]["status"] = (preg_match("/^{$pattern}{{$this->minlength},{$this->maxlength}}+$/", $valid["content"]));

									break;

									case "string_any":
										$pattern = "[a-zA-zA-Zа-яА-яА-Я0-9]";
										$valid_status[$row]["status"] = (preg_match("/^{$pattern}{{$this->minlength},{$this->maxlength}}+$/", $valid["content"]));
									break;

									case "integer":
										$pattern = "[0-9]";
										$valid_status[$row]["status"] = (preg_match("/^{$pattern}{{$this->minlength},{$this->maxlength}}+$/", $valid["content"]));

									break;
									case "email":
										$pattern = "[a-zA-Z0-9_\-.]+@[a-zA-Z0-9_\-.]+\.[a-z\-.]";
										$valid_status[$row]["status"] = (preg_match("/^{$pattern}{{$this->minlength},{$this->maxlength}}+$/", $valid["content"]));
									break;
									default:
										echo "Один или несколько элементов для проверки имеет не верный тип валидации";
							}

							$valid_status[$row]["pattern"] = $pattern;
							$valid_status[$row]["minlength"] = $this->minlength;
							$valid_status[$row]["maxlength"] = $this->maxlength;

							return $this->getMessage($valid_status);
					}
			}

			public function getMessage($arr) {
					$this->message = "";
					$param["arr"] = $arr;
					$this->message = core::I()->Template($_SERVER["DOCUMENT_ROOT"]."/engine/template/validation/","index",$param,1);
					return $this->message;

		 }
	}
?>