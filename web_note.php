<!--this is the script for user write down the web note-->
<html><body>
<?php
require "get_user_num.php";
require "check_session.php";

function web_note($user_name, $note_name, $note_path, $note_date, $note_title)
{
	$sql_insert_note = "insert into user_notes value
						(id, '".$user_name."', '".$user_name."', '".$note_name."', '".$note_path."', '".$note_date."', '".$note_title."')";
	mysql_query($sql_insert_note);
}

$con = mysql_connect("localhost" , "root" , "mysql");
mysql_select_db("web_db");

$d = getdate();
$note_name = $d["year"].$d["mon"].$d["mday"].$d["hours"].$d["minutes"].$d["seconds"]."_note";
$user_name = $_POST["user_name"];
$note_title = $_POST["title"];
$note = $_POST["note"];
$note_date = $d["year"]."-".$d["mon"]."-".$d["mday"];

$user_num = get_user_num($user_name, $con);
$note_path = "/var/www/".$user_num."/tmp/".$note_name;

exec("touch ".$note_path." &");
exec("chmod 757 ".$note_path." &");

if(file_exists($note_path))
{
	$note_file = fopen($note_path, "w");
	fwrite($note_file, $note, strlen($note));
}

session_start();
if(check_session($user_name, $user_num))
{
    web_note($user_name, $note_name, $note_path, $note_date, $note_title);
}

mysql_close($con);

echo "<p><h4>note upload success</h4></p>";
#echo "<a href = 'http://192.168.1.111/".$row_num["num"]."/welcome.html'><h4>return home page</h4></a>";
echo "<a href = 'http://blog.fishinlab.net/".$user_num."/welcome.phtml'><h4>return home page</h4></a>";
?>
</body></html>
