<!--this is the script for user regist-->
<html><body>
<?php
require "md5.php";
require "get_user_num.php";
#check the regist user name has been used or not
#(1) select the user name from users table where name = input username
#(2) if the result is not null ,then the input user name is not available
function check_user_name($user_name, $mysql_db)
{
	$sql_check = "select name from users where name = '".$user_name."'";

    $res = $mysql_db->query($sql_check);
	//$res = mysql_query($sql_check);
	while($row = $mysql_db->fetch_assoc($res))
	{
		if($user_name == $row["name"])
		{
            echo "<p style='font:20px/20px Consolas;'>the user has been exist</p>";
            die();
		}
		else
			continue;
	}	
    print_r($row);
}

function get_new_user_num($mysql_db)
{
    if($mysql_db)
    {
        // maybe i should cache the count of the users first, and then i could use it from cache, $sql_get_big maybe less effective here

        $sql_get_big = "select user_num from users where user_num = (select max(user_num) from users";
        $res = mysql_db->query($sql_get_big);

        //$res = mysql_query($sql_get_big);
        //$row = mysql_fetch_array($res);

        $user_num = $row["num"] + 1;

        return $user_num;
    }
    else
    {
        die("error:can not get user number");
    }
}

#update the users table load on the new user information
#(1) insert the information of new user into users table
#(2) insert the information of new user into user_num_map 
function update_user_table($user_name, $user_num, $pwd, $mysql_db)
{
    $pwd = str_md5($pwd); 
    $sql_insert = "insert into users value (id, name = '$user_name', password = md5('$pwd'), is_login = 'N', user_num = '$user_num';)";

    $mysql_db->query($sql_insert);
}

$mysql_db = new mysqli("localhost", "root", "mysql", "web_db");

$user_name = $_POST["name"];
$pwd = $_POST["password"];

$user_num = get_new_user_num($mysql_db);
check_user_name($user_name, $mysql_db);
update_user_table($user_name, $user_num, $pwd, $mysql_db);

if($mysql_db)
{
    $user_num = get_user_num($user_name, $mysql_db);    
    exec("python /var/www/shell/regist.py $user_num $user_name &");
}
echo "<p><h3>welcome to FisHinLab</h3></p><br />";
echo "<a href = 'http://blog.fishinlab.net/".$user_num."/welcome.phtml'>return home page</a>";

mysql_close($con);
?>
</body></html>
