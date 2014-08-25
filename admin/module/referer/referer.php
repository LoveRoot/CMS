<?php
	include($_SERVER["DOCUMENT_ROOT"]."/admin/classes/pagination.class.php");

	if (isset($_GET["by"]) and isset($_GET["sort"]))
	{
		$page = new page("Select * from referer where $_GET[by] like '%".$_GET["sort"]."%'", "Select id from referer", 20);	
	}
		else
	{
		$page = new page("Select * from referer", "Select id from referer",  20);
	}
	
	if ($_GET["c"] == "clear")
	{
		@header("Location:".$_SERVER["HTTP_REFERER"]."");
		$sql = mysqli_query($mysql->socket, "Delete from referer");
	}
	
	$by = $_GET["by"];
	$sort = $_GET["sort"];
?>
	<?php
		if ($page->result == true)
		{
			
			print "<table border='0'>";
				print "<tr>";
					print "<th>Арт.</th>";
					print "<th>Агент</th>";
					print "<th>IP</th>";
					print "<th>Браузер</th>";
					print "<th>С страницы</th>";
					print "<th>На страницу</th>";
					print "<th>Время</th>";
				print "</tr>";
				
			do
			{

				print "<tr>";
					print "<td>".$page->result["id"]."</td>";
					print "<td>"."<a href='?a=referer&c=all&by=user_agent&sort=".$page->result["user_agent"]."'>".$page->result["user_agent"]."</a>"."</td>";
					print "<td>"."<a href='?a=referer&c=all&by=ip&sort=".$page->result["ip"]."'>".$page->result["ip"]."</a></td>";
					print "<td>"."<a href='?a=referer&c=all&by=browser&sort=".$page->result["browser"]."'>".$page->result["browser"]."</a>"."</td>";
					print "<td><a href='".urldecode($page->result["referer"])."' target='_blank'>".urldecode($page->result["referer"])."</a></td>";
					print "<td><a href='".urldecode($page->result["page"])."' target='_blank'>".urldecode($page->result["page"])."</a></td>";
					print "<td>"."<a href='?a=referer&c=all&by=date&sort=".$page->result["date"]."''>".$page->result["date"]."</a>"."&nbsp;".$page->result["time"]."</td>";
				print "</tr>";
				
				
			}
			while($page->result = mysqli_fetch_array($page->res99));
			
			print "</table>";
			
			if (empty($_GET["by"]))
			$by = "browser";
			
			if (empty($_GET["sort"]))
			$sort = $page->result["browser"];
			
			print $page->navigation("admin.php?a=referer&c=all&by=$by&sort=$sort&page=");
		}
			else
		{
			echo $mysql->__empty("");
		}
	?>