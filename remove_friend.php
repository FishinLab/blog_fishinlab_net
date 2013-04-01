<!--this is the script for user remove his friend-->
<html><body>
<?php
require "get_user_num.php";
#the procesure of remove friend:
#project one:delete the line in user_friends table;
#project two:update the line in user_friends table, set the user_friend to null, and then remove the line at right time
function remove_friend($user_name, $fri_name)
{
	$sql_check = "select * from user_friends where user_name = '".$user_name."' and user_friend = '".$fri_name."'";
	$sql_remove = "delete from user_friends where user_name = '".$user_name."' and user_friend = '".$fri_name."'";	

	$res_check = mysql_query($sql_check);
	$row_check = mysql_fetch_array($res_check);
	if($row_check)
	{
		$res_remove = mysql_query($sql_remove);
		return True;
	}
	else return False;
}

$user_name = $_POST["user_name"];
$fri_name = $_POST["user_friend"];

$con = mysql_connect("localhost" , "root" , "mysql");
mysql_select_db("web_db");

$user_num = get_user_num($user_name, $con);
#$sql_get_user_num = "select num from user_num_map where name = '".$user_name."'";
#$res_num = mysql_query($sql_get_user_num);
#$row_num = mysql_fetch_array($res_num);

session_start();
if(check_session($user_name, $user_num))
{
    $flag = remove_friend($user_name, $fri_name);
    if($flag == True)
    {
	    echo "<h4>remove friend succeed</h4>";
	    #echo "<a href = 'http://192.168.1.111/".$row_num["num"]."/welcome.html'><h4>return home page</h4></a>";
	    echo "<a href = 'http://blog.fishinlab.net/".$user_num."/welcome.phtml'><h4>return home page</h4></a>";
    }
    else
    {
	    echo "<h4>could not remove the friend</h4>";
	    #echo "<a href = 'http://192.168.1.111/".$row_num["num"]."/welcome.html'><h4>return home page</h4></a>";
	    echo "<a href = 'http://blog.fishinlab.net/".$user_num."/welcome.phtml'><h4>return home page</h4></a>";
    }
}

mysql_close($con);

?>
</body></html>
