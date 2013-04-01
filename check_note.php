<!--this is the script for user check note-->
<html><body>
<?php
require "get_user_num.php";
#the procesure of checking the users' notes:
#(1) get the generation date from DB
function get_note_date($user_name, $note_name)
{
    $sql_get_date = "select note_data from user_notes where holder = '$user_name' and note_title = '$note_name' ;";
	
	$res_date = mysql_query($sql_get_date);
	$row_date = mysql_fetch_array($res_date);

	echo "<p><h4>the note write date: ".$row_date["note_date"]."</h4></p>";
}

$user_name = $_POST["user_name"];
$note_name = $_POST["note_title"];

$con = mysql_connect("localhost" , "root" , "mysql");
mysql_select_db("web_db");

get_note_date($user_name, $note_name);
$user_num = get_user_num($user_name, $con);

echo "<a href = 'http://blog.fishinlab.net/$user_num/welcome.phtml'><return home page/a>";

mysql_close($con);
?>
</body></html>
