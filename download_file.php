<!--this is the script for user download the file-->
<html><body>
<?php
#the procesure of downloading the file:
#(1) 
function download_file($user_name, $file_path, $file_name, $user_num)
{
	echo $user_name."<br />";
	echo $file_path."<br />";
	echo $file_name."<br />";

	$fd = fopen($file_path, "r");
	header("Content-type:application/octet-stream");
	header("Accept-Length:".filesize($file_path));
	header("Content-Disposition:attachment; filename=".$file_name);

	echo readfile($fd, filesize($file_path));
	fclose($fd);
	
	#header("location='http://192.168.1.111/".$user_num."/tmp/".$file_name."'");

}

$user_name = $_POST["user_name"];
$file_name = $_POST["file_name"];
$file_path = $_POST["file_path"];

$con = mysql_connect("localhost" , "root" , "mysql");
mysql_select_db("web_db");

$sql_get_user_num = "select user_num from users where name = '$user_name'";
$res_num = mysql_query($sql_get_user_num);
$row_num = mysql_fetch_array($res_num);

download_file($user_name, $file_path, $file_name, $row_num["num"]);

echo "<a href = 'http://blog.fishinlab.net/".$row_num["num"]."/welcome.phtml'>return home page</a>";

mysql_close($con);

?>
</body></html>
