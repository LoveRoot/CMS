<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/admin/classes/pagination.class.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/admin/classes/application.class.php");
	
	$app = new application($_GET["action"]);
	$mysql = new page("Select * from mail","Select id from mail", 15);
	
	if ($app->message)
	{
		echo $app->message;
	}
	
	if ($mysql->result == true)
	{
		echo "<div id=\"form\" style=\"position:relative; z-index:50;\">";
			echo "<form action=\"\" type=\"POST\">";
				echo "<table border='0'>";			
						echo "<tr>";
							echo "<th style=\"width:5px;\">№</th>"; 
							echo "<th style=\"width:60px;\">Автор</th>";
							echo "<th style=\"width:140px;\">Тема</th>";
							echo "<th style=\"width:80px;\">Тип</th>";
							echo "<th style=\"width:130px;\">Штамп времени</th>";
							echo "<th style=\"width:20px;\">Проверена</th>";
							echo "<th style=\"width:120px;\">Адрес страницы</th>";
							echo "<th style=\"width:70px;\">Действие</th>";
							echo "<th style=\"width:5px; text-align:center;\"><input type=\"checkbox\" class=\"addons\" onclick=\"checkAll(this)\"></th>";
						echo "</tr>";
				do
				{
					$respons = "<img src=\"/admin/template/images/ico/none.png\" alt=\"\" title=\"\" />";
					if ($mysql->result["respons"] == 1)
					$respons = "<img src=\"/admin/template/images/ico/noprotect.png\" alt=\"\" title=\"\" />";
					
					
					echo "<tr>";
						echo "<td>".$mysql->result["id"]."</td>";
						echo "<td style=\"width:60px;\">".$mysql->result["author"]."</td>";
						echo "<td>".$mysql->result["theme"]."</td>";
						echo "<td>".$mysql->result["type"]."</td>";
						echo "<td style=\"width:120px;\">".$mysql->result["date_time"]."</td>";
						echo "<td style=\"width:16px;\">".$respons."</td>";
						echo "<td style=\"width:70px;\"><a href='".$mysql->result["link"]."' target='_blank'>Перейти...</a></td>";
						echo "<td style=\"width:70px;\"><a href=/admin.php?a=application&c=readfull&id=".$mysql->result["id"]."".">Подробнее...</a></td>";
						echo "<th style=\"width:5px; text-align:center;\"><input type=\"checkbox\" class='addons' name='array[]' value='".$mysql->result["id"]."'></th>";
					echo "</tr>";
				}
				while($mysql->result = mysqli_fetch_assoc($mysql->res99));
				echo "</table>";
				echo "<div id=\"bottom_panel\">";
					$mysql->navigation("/".$_SERVER["HTTP_HOST"]."/admin.php?a=application&page=");
					
					echo "<div id=\"setParametrs\">							
								<select name=\"parametrs\">
									<option name=\"deleteAll\" value=\"deleteAll\">Удалить выбранные</option>
									<option name=\"moderAll\" value=\"moderAll\">Смотрел</option>
									<option name=\"publicAll\" value=\"publicAll\">На рассмотрение</option>
								</select>
								<input type=\"submit\" name=\"action\" value=\"OK!\" id=\"actionButt\">
						</div>";		
					
				echo "</div>";
				
			echo "</form>";
			
		echo "</div>";
	}
		else
	{
		echo $app->__empty();
	}
	
?>