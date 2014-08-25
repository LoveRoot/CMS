<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/admin/classes/core.class.php");
	
	class blacklist extends core
	{	
		public function __construct()
		{
			$this->path = $_SERVER["DOCUMENT_ROOT"]."/engine/blacklist.root";
		}
		
		public function addlist($list)
		{
			$this->success = 0; 
				
			foreach($_POST as $l => $value)
			{
				$file = fopen($this->path, "w");
				$fwrite = fwrite($file, $value);
				fclose($file);
				
				
			}
				
		}
		
		protected function __destruct()
		{
			
		}
	}
	
	class def_blacklist extends blacklist
	{
		public function __construct()
		{
			$this->file_read = file($_SERVER["DOCUMENT_ROOT"]."/engine/blacklist.root");
		}
	}
?>