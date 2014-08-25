?php
	class Login extends DB
	{		
		public function __construct()
		{
			parent::__construct();
			
			$this->access = 1;
			
			if ($_GET["do"] == "logout")
			{
				setcookie("user", "", time()-100000);
				setcookie("session", "", time() - 100000);
				
				$this->status = 0;
				header("Location:".$_SERVER["HTTP_REFERER"]);
			} 
			
			if (isset($_POST["login"]))
			{		
				$login = htmlspecialchars(mysql_escape_string($_POST["login"]));
				$password = md5($_POST["password"]);
				
				$sql = mysqli_query($this->link, "Select users.login, users.password, users.security, 
                                                                           users.status from users where users.login='".$login."' and users.password='".$password."'");
				$result = mysqli_fetch_object($sql);

				if ((!empty($result)) and $result->status == 1)
				{
					setcookie("user", $result->login, time()+3600*2, "/");
					setcookie("session", $result->security, time()+3600*2, "/");

					header("Location:".$_SERVER["HTTP_REFERER"]);
					$this->access = 1;
				}
					else
				{
					return $this->message = "Вероятно вы ввели не правильно имя пользователя или пароль.";
					$this->access = 0;
				}				
			}
		}	
	}
?>