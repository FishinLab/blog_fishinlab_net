<!--this is the script for user delete note-->
<html><body>
<?php
#the procesure of deleting the user note:
#(1) delete the line from user_notes table
#(2) remove the file in local path
function delete_note($user_name, $note_name)
{
    $sql_get_path = "select note_path from user_notes where holder = '$user_name' and note_title = '$note_name';";
    $sql_delete_note = "delete from user_notes where holder = '$user_name' and note_title = '$note_name';";

    $mysql_instance = new mysqli("localhost", "root", "mysql", "web_db"); 
    $res_path = $mysql_instance->query($sql_get_note);
    $row_path = $res_path->fetch_assoc();

	exec("rm -f ".$row_path["note_path"]." &");
	mysql_query($sql_delete_note);
}

$user_name = $_POST["user_name"];
$note_name = $_POST["note_title"];

$mysql_instance = new mysqli("localhost", "root", "mysql", "web_db");

delete_note($user_name, $note_name);

$sql_get_user_num = "select user_num from users where name = '$user_name';";
$res_num = $mysql_instance->query($sql_get_user_num);
$row_num = $res_num->fetch_assoc();

echo "<p><h4>note delete succeed<h4></p>";
echo "<a href = 'http://blog.fishinlab.net/".$row_num["num"]."/welcome.phtml'>return home page</a>";

mysql_close($con);

?>
</body></html>
