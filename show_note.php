<!--this is the script for user show his notes-->
<html><body>
<?php
require "get_user_num.php";
require "check_session.php";
#the procesure of show note
#(1) get the note path from user_notes table
#(2) read the note from local storage
#(3) output the note to web site
function show_note($user_name, $note_name)
{
    $sql_get_path = "select note_path from user_notes where holder = '$user_name' and note_title = '$note_name';";
	$res_path = mysql_query($sql_get_path);
	$row_path = mysql_fetch_array($res_path);	

	$fd = fopen($row_path["note_path"], "r") or exit("unable to open note");

    echo "<p><h3>$note_name</h3></p>";
	echo "<p><h4>";
	while(!feof($fd))
	{
		echo fgets($fd)."<br />";
	}
	echo "</h4></p>";
	fclose($fd);
}

$user_name = $_POST["user_name"];
$note_name = $_POST["note_title"];

$con = mysql_connect("localhost" , "root" , "mysql");
mysql_select_db("web_db");
$user_num = get_user_num($user_name, $con);

session_start();

if(check_session($user_name, $user_num))
{
    show_note($user_name, $note_name);
    echo "<a href = 'http://blog.fishinlab.net/$user_name/welcome.pthml'>return home page</a>";
}
else{
    header("location:http:/blog.fishinlab.net/");
}
mysql_close($con);
?>
</body></html>
