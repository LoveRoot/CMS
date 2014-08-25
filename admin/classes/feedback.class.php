<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/classes/core.class.php");
	
	class procedure extends core
	{
		public function __construct()
		{
			parent::__construct();
			
			$this->sql = mysqli_query($this->link, "Select id, login from users where groups = '1' GROUP By login");
			while($this->result = mysqli_fetch_assoc($this->sql))
			{
				$this->option .= "<option value=".$this->result["id"].">".$this->result["login"]."</option>";			
			}
		}
		
		protected function checked()
		{
			if ($_POST)
			{
				$this->admin = $_POST["user"];
				$this->theme = $_POST["theme"];
								
				if (!preg_match("/[а-яА-Я_,.]+$/", $_POST["author"])) 
				$this->error($this->message[] = "<li>Поле с именем не может быть пустым.</li>");	
				
				if (!preg_match("/[а-яА-Я_,.]+$/", $_POST["theme"]))
				$this->error($this->message[] = "<li>Поле тема письма не может быть пустым.</li>");					
				
				if (!preg_match("/[а-яА-яА-Яa-zA-zA-Z0-9_,.]+$/", $_POST["message"]))
				$this->error($this->message[] = "<li>Содержимое поле сообщение содержит недопустимые символы или поле оказалось пустым.</li>");
				
			}
		}
		
		public function feedback_send()
		{
			if ($_POST)
			{
				if (empty($this->message))
				{
					$this->sql = mysqli_query($this->link,"Insert into mail(author, theme, message, date_time, respons) 
																	   VALUES('".$_POST["author"]."','".$_POST["theme"]."',
																			  '".$_POST["message"]."','".date("YmdHms")."','0')");
					if ($this->sql == true)
					{
						$this->message = $this->success("Ваша заявка успешно отправлена.<br />Через некоторое время ответственный по вашей заявки рассмотрит её.");
						header("REFRESH:3; url=".$_SERVER["HTTP_REFERER"]."");
					}
						else
					{
						$this->message = $this->alert("Произошла ошибка при отправке сообщения обратной связи:<br />".mysqli_error($this->link));
					}
				}
					else
				{
					return $this->message = $this->show_err();
				}
			}
		}
	}
	
	class feedback extends procedure
	{
		public function __construct()
		{
			parent::__construct();
			parent::checked();
			parent::feedback_send();
		}
	}
	
?>