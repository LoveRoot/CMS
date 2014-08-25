<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/classes/core.class.php");
	
	class access extends core
	{
		public $protect = 1;
		
		public function __construct()
		{
			parent::__construct();
						
			$this->permissions = $_COOKIE["permissions"];
			if (!isset($_COOKIE["permissions"]))
			$this->permissions = 0;
		}
		
		public function category()
		{			
			$this->sqli = mysqli_query($this->link, "Select link, viewGroups, password from category where link='".$_GET["content"]."'");
			$this->results = mysqli_fetch_assoc($this->sqli);
				
			$this->sqlGroups = mysqli_query($this->link, "Select id_group From groups where id_group='".$this->results["viewGroups"]."'");
			$this->resGroups = mysqli_fetch_assoc($this->sqlGroups);
				
			$this->GrpSuccess = $this->resGroups["id_group"];
				
			if ($this->GrpSuccess == $_COOKIE["permissions"] || $_COOKIE["permissions"] == 1 || $this->results["viewGroups"] == "*")
			{	
				$this->protect = "false";
			}
				else
			{
				$this->protect = "true";
				$this->MessageError = "К сожалению данная категория не предназначена для просмотра вашей группой !";
			}
			
			if(!empty($this->results["password"]) and ($_SESSION["pass_success".$this->results["link"]] !== $this->results["link"]))
			{
				$this->protect = "true";
				
				$_SESSION["pass_access".$this->results["link"]] = $this->results["link"];
					
				if($_POST["password_access"] == $this->results["password"] || $_SESSION["pass_success".$this->results["link"]] == $this->results["link"])
				{
					$this->protect = "false";
					$_SESSION["pass_success".$this->results["link"]] = $this->results["link"];
				}
			}	
		}	
		
		public function add_post()
		{
			if($_GET["do"] == "addnews" and $this->result_access["post_add"] == 0) 
			{
				return $this->protect = "true";
			}
		}
		
		public function showmessage()
		{	
			return  "<div class=\"alert\">
						<div class=\"img-alert\" style=\"float:left; width:64px; height:64px; margin-right:15px;\">
							<img src=\"/engine/images/system/icon/message/error.png\">
						</div>
						<div class=\"reporting\" style=\"float:left; width:85%;\"><h1>Доступ к данной функции был закрыт!</h1>
							Сожалеем но для вас закрыта данная функция, так как у вас не достаточно прав.<br/>
							Если произошла какая та ошибка, вы можете <a href='/feedback.html'>обратиться к администратору</a> за помощью.
						</div>
					</div>";
		}
	}
	
	class __GetPermissions extends access
	{
		public function __construct($sql)
		{
			parent::__construct();
			
			$this->sql = mysqli_query($this->link, $sql);
			$this->access = mysqli_fetch_row($this->sql);

			if ($this->access[0] == 1)
			{
				return $this->protect = 0;
			}
		}
	}
?>