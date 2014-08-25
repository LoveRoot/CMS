 
<?php
	if ($_REQUEST["a"] == "events" and $_REQUEST["c"] == "all" )
{
	require_once($_SERVER["DOCUMENT_ROOT"]."/admin/classes/pagination.class.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/admin/classes/events.class.php");
	
	$events = new events();
	
	$page = new page("Select * From events", "Select id From events", 10);
	
	$events->__Removal(intval($_GET["delete"]));
	$events->__Mass_removal($_POST["objects"]);
	
	echo "<form action=\"\" method=\"post\">";	
	if ($page->result == true)
	{
		echo "<table border='0'>";
			echo "<tr>";
				echo "<th>Арт.</th>";
				echo "<th>Заголовок</th>";
				echo "<th>Приоритет</th>";
				echo "<th>Проверена</th>";
				echo "<th>Автор</th>";
				echo "<th><input type='checkbox' class='addons' name='selectall' onclick=checkAll(this) /></th>";
			echo "</tr>";
				
			do
			{
						
				$priority_arr = array("5"=>"<span style='color:red; font-weight:bold;'>Срочный</span>",
				"4"=>"<span style='color:orange; font-weight:bold;'>Высокий</span>",
				"3"=>"<span style='color:green; font-weight:bold;'>Нормальный</span>",
				"2"=>"<span style='color:lightgreen; font-weight:bold;'>Низкий</span>","1"=>"Очень низкий");
				$priority = strtr($page->result["priority"],$priority_arr);
						
				$defend = "Да";
				if ($page->result["status"] == "0") { $defend = "Нет"; }
				
				echo "<tr>";
					echo "<td>".$page->result["id"]."</td>";
					echo "<td style=\"text-align:left;\">"."<a href=\"javascript:\" class=\"options\" 
								delete='?a=$_GET[a]&c=$_GET[c]&delete=".$page->result["id"]."'
								edition='?a=$_GET[a]&edit=".$page->result["id"]."'
								>
								<img src='/admin/template/images/settings.png' /></a>"."&nbsp;".substr($page->result["title"],0,85)."</td>";
					echo "<td>".$priority."</td>";
					echo "<td>".$defend."</td>";
					echo "<td>".$page->result["author"]."</td>";
					echo "<td><input type='checkbox' class='addons' name='objects[]' value='".$page->result["id"]."' /></td>";					
				echo "</tr>";
			}
						
			while($page->result = mysqli_fetch_assoc($page->res99));
					
		echo "</table>";
			echo "<div id=\"bottom_panel\">";	
				echo $page->navigation("admin/index.php?a=post&c=posted&page=");
				echo "<div id=\"setParametrs\">
						<select name=\"pamametrs\">
							<option name=\"deleteAll\">Удалить выбранное</option>
							<option name=\"deleteAll\">Отправить на проверку</option>
						</select>
						<input type=\"submit\" name=\"action\" value=\"OK!\">
					  </div>";		
			echo "</div>";
		}
			else
		{
                    echo $events->GetMessage("ShowAlert", array("caption" => "<h1>Сожалеем</h1>",
                                                                "ShowAlert" => "Эта страница не содержит активных событий, вы можете <a href='/admin.php?a=events&c=add'>создать событие</a>"));
		}
	echo "</form>";
}
?>