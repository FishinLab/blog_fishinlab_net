<!--this is the show user friends page-->
<html><body>
<p><h3>you got friends here:</h3></p>
<?php
require "get_user_num.php";
require "check_session.php";
#the procesure of show who is user friend:
#(1) select friend name from user_friend table where user_name = $user
function get_user_friend($user_name)
{
    $sql_get_fre = "select user_friend from user_friends where user_name = '$user_name';";
	$res = mysql_query($sql_get_fri);

	echo "<table border = 1>";
	echo "<tr>";
	echo 	"<th>user name:</th> <th>friend name:</th> <th></th>";
	echo "</tr>";
	while($row_fri = mysql_fetch_array($res))
	{
		echo "<tr>";
		echo 	"<td>".$user_name."</td>";
		echo 	"<td>".$row_fri["user_friend"]."</td>";
		echo  	"<td>";
		echo 		"<form action = 'remove_friend.php' method = 'post'>";
		echo 			"<input type = 'hidden' name = 'user_name' value = '".$user_name."'>";
		echo 			"<input type = 'hidden' name = 'user_friend' value = '".$row_fri["user_friend"]."'>";
		echo 			"<input type = 'submit' name = 'remove' value = 'remove friend'>";
		echo 		"</form>";
		echo 	"</td>";
		echo "</tr>";
	}
	echo "</table>";
}

$user_name = $_POST["user_name"];

$con = mysql_connect("localhost" , "root" , "mysql");
mysql_select_db("web_db");
$user_num = get_user_num($user_name, $con);

session_start();
if(check_session($user_name, $user_num))
{
    get_user_friend($user_name);
}

mysql_close($con);
echo "<a href = 'http://blog.fishinlab.net/".$user_num."/welcome.phtml'>return home page</a>";
?>
</body></html>
