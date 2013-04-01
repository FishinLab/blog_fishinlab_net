<!--this is the script for user add friend-->
<html><body>
<?php
require "get_user_num.php";
require "check_session.php";
#the procesure of add userf friends:
#(1) check whether the user exist or not
#(2) insert into the user_friends table
#(3) update the related information

function check_friend($user_name, $fri_name)
{
    $sql_check_1 = "select name from users where name = '$fri_name';";
    $sql_check_2 = "select user_friend from user_friends where user_name = '$user_name' and user_friend = '$fri_name';";

	$res_1 = mysql_query($sql_check_1);
	$row_1 = mysql_fetch_array($res_1);
	
	if($row_1)
	{
		$res_2 = mysql_query($sql_check_2);
		$row_2 = mysql_fetch_array($res_2);

#no_error:add friend succeed
#error_1:the friend which user input has been the user's friend
#error_2:the friend which user input not exists
		
		if($row_2)
		{
			return "error_1";
		}
		else return "no_error";
	}
	else return "error_2";
}

function insert_friend($user_name , $fri_name)
{
    $sql_insert_1 = "insert into user_friends value (id, '$user_name', '$fri_name', 'normal')";
	mysql_query($sql_insert_1);
}

$con = mysql_connect("localhost" , "root" , "mysql");
mysql_select_db("web_db");

$fri_name = $_POST["friend"];
$user_name = $_POST["user_name"];

$user_num = get_user_num($user_name,$con);

if(check_session($user_name, $user_num))
{
    $flag = check_friend($user_name, $fri_name);

    echo $_SESSION["name"];
    echo $_SESSION["user_num"];

    if($flag == "no_error")
    {
	    insert_friend($user_name, $fri_name);

	    echo "<h4>add friend succeed</h4>";
        echo "<a href = 'http://blog.fishinlab.net/$user_num/welcome.phtml'><h4>return home page</h4></a>";
    }
    elseif($flag == "error_1")
    {
	    echo "<h4>the user has been your friend</h4>";
        echo "<a href = 'http://blog.fishinlab.net/$user_num/welcome.phtml'><h4>return home page</h4></a>";
    }
    elseif($flag == "error_2")
    {
	    echo "<h4>the user does not exist</h4>";
        echo "<a href = 'http://blog.fishinlab.net/$user_num/welcome.phtml'><h4>return home page</h4></a>";
    }
}
else{
    header("location:http://blog.fishinlab.net/");
}
mysql_close($con);
?>
</body></html>
