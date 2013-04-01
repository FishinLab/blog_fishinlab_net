<!--this is the script for user get notes list-->
<html>
    <head>
        <title>
            show user notes
        </title>
        <link rel = "stylesheet" href = "styles/show_note_style.css" type = "text/css" />
    </head>
<body>
<?php
require "get_user_num.php";
require "check_session.php";
#the procesure of get user notes:
#(1) just select information from user notes table
function get_user_notes($user_name)
{
	
    $slq_select = "select note_title from user_notes where holder = '$user_name';";

	echo "<p><h3>you got notes here:</h3></p>";	
    echo "<table border = '1' id = 'note_table'>";
	echo "<tr><th><h4>user name:</h4></th> <th><h4>note title:</h4></th> <th></th> <th></th> <th></th></tr>";
	$res_notes = mysql_query($sql_select);
	while($row_notes = mysql_fetch_array($res_notes))
	{
		echo "<tr>";
		echo 	"<td>".$user_name."</td>";
		echo 	"<td>".$row_notes["note_title"]."</td>";
		
		echo 	"<td>";
		echo 		"<form action = 'show_note.php' method = 'post'>";
		echo 			"<input type = 'hidden' name = 'user_name' value = '".$user_name."'/>";
		echo 			"<input type = 'hidden' name = 'note_title' value = '".$row_notes["note_title"]."'/>";
		echo 			"<input type = 'submit' name = 'submit' value = 'show note' />";
		echo 		"</form>";
		echo 	"</td>";
		
		echo 	"<td>";
		echo 		"<form action = 'check_note.php' method = 'post'>";
		echo 			"<input type = 'hidden' name = 'user_name' value = '".$user_name."'/>";
		echo 			"<input type = 'hidden' name = 'note_title' value = '".$row_notes["note_title"]."'/>";
		echo 			"<input type = 'submit' name = 'submit' value = 'check note' />";
		echo 		"</form>";
		echo 	"</td>";

		echo 	"<td>";
		echo 		"<form action = 'delete_note.php' method = 'post'>";
		echo 			"<input type = 'hidden' name = 'user_name' value = '".$user_name."'/>";
		echo 			"<input type = 'hidden' name = 'note_title' value = '".$row_notes["note_title"]."'/>";
		echo 			"<input type = 'submit' name = 'submit' value = 'delete' />";
		echo 		"</form>";
		echo 	"</td>";

		echo "</tr>";
	}
	echo "</table>";	

}

$user_name = $_POST["user_name"];

$con = mysql_connect("localhost" , "root" , "mysql");
mysql_select_db("web_db");
$user_num = get_user_num($user_name,$con);

session_start();
if(check_session($user_name, $user_num))
{
    get_user_notes($user_name);
    echo "<a href = 'http://blog.fishinlab.net/".$user_num."/welcome.phtml'>return home page</a>";
}
else
{
    header("location:http://blog.fishinlab.net/");
}
mysql_close($con);

?>
</body></html>
