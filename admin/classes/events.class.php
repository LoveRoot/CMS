<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/admin/classes/secure_panel.class.php");

class events extends core
{
	public $access = 1, $posted = 0;
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function __Removal($obj)
	{
		if (!empty($obj))
		{
			$sql = mysqli_query($this->socket, "Delete from events where id='".$obj."'");
			if ($sql == true)
			{
				header("Location: ".$_SERVER["HTTP_REFERER"]."");
			}
				else
			{
				echo $this->showmessage("Произошла неожиданная ошибка<br />".mysqli_error($this->socket));
			}
		}
	}
	
	public function __Mass_removal($obj)
	{
		if (!empty($obj))
		{			
			$permissions = new secure_panel();
			$permissions->ActiveModule("events_delete");
			
			if ($permissions->result["events_delete"] == 1)
			{
				foreach($obj as $del_obj)
				{
					$sql = mysqli_query($this->socket, "Delete from events where id='".$del_obj."'");
					if ($sql == true)
					{
						setcookie("success","delete", time() +1000);
						header("Location: ".$_SERVER["HTTP_REFERER"]."");
					}
						else
					{
						echo $this->showmessage("Произошла неожиданная ошибка<br />".mysqli_error($this->socket));
					}
				}
			}
				else
			{
				echo $this->showmessage("У вас нет прав на данную операцию");
			}
		}
	}
	
	public function __checked()
	{
		$this->error = array();
		
		$titleLeng = strlen($_POST["title"]);
		$contentLeng = strlen($_POST["content"]);
		
		if ($_POST["сhildcategories"])
		$this->сhildcategories = 1;
		
		if ($_POST["posted"] == "on")
		$this->posted = 1;
		
		if ($titleLeng < 20 || $titleLeng > 200) 
					$this->error($this->message[] = "<li>Заголовок события должен содержать от 30 до 200 символов А-я</li>");
		if (!preg_match("/^([0-9]){2,2}+.+([0-9]){2,2}+.+([0-9]){2,2}$/", $_POST["currentdate"]) and !intval($_POST["currentdate"])) 
					$this->error($this->message[] = "<li>Укажите дату начала события, дата события должна быть числом</li>");
		
		if (!preg_match("/^([0-9]){2,2}+:+([0-9]){2,2}+:+([0-9]){2,2}+:+([0-9]){2,2}$/", $_POST["currenttime"]) and !intval($_POST["currenttime"])) 
					$this->error($this->message[] = "<li>Укажите время начала события, время события должно быть числом</li>");
		
		if (empty($_POST["category"])) 
					$this->error($this->message[] = "<li>Укажите страницы на который будет отображаться событие</li>");
					
		if ($contentLeng < 20 || $contentLeng > 600) 
					$this->error($this->message[] = "<li>Текст вашего события составлен не верно, событие должно состоять не менее чем из 20 символов или  букв и не более чем 600 символов и букв</li>");
		
		if (!empty($this->message))
		{
			$this->access = 0;
		}
	}
	
}

class addEvent extends events
{
	public function __construct()
	{
		parent::__construct();
		
		$this->permissions = new __GetPermissions("Select events_add From secure_admin, users, groups
																			where 
																			users.login = '".$_COOKIE["user"]."' and
																			users.security = '".$_COOKIE["session"]."' and
																			groups.id = users.groups and
																			secure_admin.id_key = users.groups");
		
		
		if ($this->permissions->protect == 0)
		{
			$this->form = 1;
		}
			else
		{
			$this->form = 0;
			echo $this->showmessage("Сожалеем но у вас недостаточно прав для создания события !");
		}
	}
	
	public function __getCategory()
	{
		$sql = mysqli_query($this->socket, "SELECT c.title, c.id, c.link, sc.name, sc.index_cat, sc.altname FROM category c LEFT JOIN subcategory sc 
													ON c.link = sc.index_cat where c.type='normal' ORDER BY c.title, sc.name");
		
		if (mysqli_error($this->socket))
		{
			echo $this->defaultmessage("Произошла ошибка:".mysqli_error($this->socket));
		}
			
		for ($i=0, $p=-1; $results = mysqli_fetch_assoc($sql); $i++)
		{
				
			if ($p !== $results["link"])
			{
				$p = $results["link"];
				$this->arr .= "<option style='font-weight:bold;' value=".$results["link"].">".$results["title"]."</option>";
			}
			if (!empty($results["name"]))
			{
				$this->arr .= "<option style='padding-left:20px;' value=".$results["altname"].">".$results["name"]."</option>";
			}				
		}
		return $this->arr;
	}
	
	
	public function add($posted)
	{
		if ($_POST)
		{
			parent::__checked();
			
			if ($this->access == 0)
			{
				echo $this->show_err();
			}
				else
			{		
				foreach($_POST["pages"] as $pages)
				{
					$exp = explode(",", $pages);
					foreach($exp as $pages)
					{
						$unarray .= $pages."\r";
					}
				}

				$sql = mysqli_query($this->socket, "Insert into events(	
																		title, 
																		content, 
																		currentdate, 
																		currenttime,
																		lastdate,
																		lasttime,
																		pages,
																		priority, 
																		status,
																		сhildcategories,			
																		author, 
																	   ) 
													Value
													(
														'".$_POST["title"]."','".$_POST["content"]."','".$_POST["currentdate"]."','".$_POST["currenttime"]."',
														'".$_POST["lastdate"]."','".$_POST["lasttime"]."','".$unarray."','".$_POST["priority"]."',
														'".$this->posted."','".$this->сhildcategories."','".$_COOKIE["user"]."')
													");
				
				if ($sql == true)
				{
					setcookie("success","addevents", time() + 1000);
					header("location: /admin.php?a=events&c=all");
				}
					else
				{
					echo $this->error("Произошла ошибка при добавлении события<br />".mysqli_error($this->socket));
				}
			}
		}
	}
}

class editEvents extends events
{
	public function __construct()
	{
		parent::__construct();
		
		
		if ($_POST)
		{
			parent::__checked();
			
			if ($this->access == 1)
			{
				foreach($_POST["category"] as $pages)
				{
					$exp = explode(",", $pages);
					foreach($exp as $pages)
					{
						$newPage .= $pages.",";
						
					}
				}
				
				$unarray = substr($newPage, 0, strlen($newPage) -1);
				
				$sql = mysqli_query($this->socket, "Update events set 
																	title='".$_POST["title"]."', 
																	content='".$_POST["content"]."', 
																	currentdate='".$_POST["currentdate"]."', 
																	currenttime='".$_POST["currenttime"]."',
																	lastdate='".$_POST["lastdate"]."',
																	lasttime='".$_POST["lasttime"]."',
																	pages='".$unarray."',
																	priority='".$_POST["priority"]."', 
																	status='".$this->posted."',
																	сhildcategories='".$this->сhildcategories."',			
																	author='".$_COOKIE["user"]."' 
																	where id='".intval($_GET["edit"])."'");
				
				if ($sql == true)
				{
					setcookie("success","editevents", time() + 1000);
					header("location: /admin.php?a=events&c=all");
				}
					else
				{
					echo $this->defaultmessage("Произошла ошибка:".mysqli_error($this->socket));
				}
				
			}
				else
			{
				echo $this->show_err();
			}
		}
		
	}

	
	public function __getPrioritet()
	{
		$this->priority = array
							(
								"5"=>"<span style='color:red; font-weight:bold;'>Срочный</span>",
								"4"=>"<span style='color:orange; font-weight:bold;'>Высокий</span>",
								"3"=>"<span style='color:green; font-weight:bold;'>Нормальный</span>",
								"2"=>"<span style='color:lightgreen; font-weight:bold;'>Низкий</span>",
								"1"=>"Очень низкий"
							);
	}
}

?>