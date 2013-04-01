<!--this is the script for user delete files-->
<html><body>
<?php

#the procesure of deleting the files from user space:
#(1) remove the line from user_files tables in database
#(2) when rsync the strage, delete the file itself

function remove_file_from_db($user_name, $file_name)
{
    $sql_remove_file = "delete from user_files where holder = '$user_name' and file_name = '$file_name';";
    $mysql_instance = new mysqli("localhost", "root", "mysql", "web_db");
    $mysql_instance->query($sql_remove_file);

	if(file_exists("/var/www/shell/remove.sh"))
	{
		exec("/var/www/shell/remove.sh" , $res);

		if($res == null)
		{
            $sql_get_user_num = "select num from users where name = '$user_name';";
            $res_num = mysql_instance->query($sql_get_user_num);
            $row_num = $res_num->fetch_assoc($res_num);
            $user_num = $row_num["num"];

			echo "<a href = 'http://blog.fishinlab.net/$user_num/welcome.phtml'>return to home page</a>";
		}
	}

	mysql_close($con);
}

$user_name = $_POST["user_name"];
$file_name = $_POST["file_name"];

remove_file_from_db($user_name, $file_name);
?>
</body></html>
