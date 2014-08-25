<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/admin/classes/core.class.php");

class application extends admin
{
	public function __construct($action)
	{
		parent::connect();
		
		switch($action)
		{
			case delete:
				return $this->__purge();
			break;
		}
	}
	
	public function __purge()
	{
		foreach($_POST["array"] as $this->result)
		{
			$sql = mysqli_query($this->socket, "Delete from mail where id='".$this->result."'");
			
			if (!$sql)
			{
				$this->message = $this->showmessage("Во время операции произошла ошибка:<br />".mysqli_error($this->socket));
			}	
		}
	}
	
	public function set_app_read($id)
	{
		$this->sql = mysqli_query($this->socket, "Select * from mail where id='".$id."'");
		$this->app_result = mysqli_fetch_assoc($this->sql);
		
		if ($this->app_result == false)
		{
			echo $this->showmessage("Произошла неожиданная ошибка:<br />".mysqli_error($this->socket));
		}
			else
		{
			return $this->get_app_full();
		}
	}
	
	public function get_app_full()
	{
		echo "<div class=\"tabs\">";
			echo "<ul id=\"tabs\">";
				echo "<li><a href=\"#general\">Содержание</a></li>";
				echo "<li><a href=\"#mail\">Ответить</a></li>";
			echo "</ul>";
		echo "</div>";
		
		echo "<div id=\"option_bg\">";
			echo "<div id=\"general\">";
				echo "<h1>Сообщение от&nbsp;".$this->app_result["author"]."</h1>";
				echo "<h1>Тема сообщения:&nbsp;".$this->app_result["theme"]."</h1>";
				echo "<h1>Сообщение:</h1>"."<span>".$this->app_result["message"]."</span>";
			echo "</div>";
			
			echo "<div id=\"mail\">";
				
			echo "</div>";
		echo "</div>";
	}
	
}