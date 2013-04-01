<!--this is the script for user to share one file-->
<html><body>
<?php
function share_file($user_name,$file_name,$file_path)
{
    $sql_get_info = "select distnct file_name from user_files where file_name = '$file_name' and owner_name = '$user_name';";
    $sql_get_holder = "select distinct holder from user_files where owner = '$user_name' and holder_name = '$user_name';";

    $mysql_instance = new mysqli("localhost", "root", "mysql", "web_db");

    $file_info = $mysql_instance->query($sql_get_info);
    $new_holder = $mysql_instance->query($sql_get_holder);

	while($row_info = mysql_fetch_array($file_info))
	{
		while($row_holder = mysql_fetch_array($new_holder))
		{
            $sql_share_file = "insert into user_files value (id, file_name = '$row_info['file_name']', owner_name = '$user_name',holder_name = '$row_holder['holder']';";
			mysql_query($sql_share_file);
		}
	}	

	mysql_close($con);
}

function return_home($user_name)
{
	$con = mysql_connect("localhost" , "root" , "mysql");
	mysql_select_db("web_db");

    $sql_get_user_num = "select user_num from users where name = '$user_name';";
	$user_num = mysql_query($sql_get_user_num);

	$row_num = mysql_fetch_array($user_num);
	$pre_page = $row_num["user_num"];

    echo "<a href = 'http://blog.fishinlab.net/".$pre_page."/welcome.phtml'>return to home page</a>";
}

#when share file just insert a new line into the user_files table
$user_name = $_POST["user_name"];
$file_name = $_POST["file_name"];
$file_path = $_POST["file_path"];

share_file($user_name, $file_name, $file_path);
return_home($user_name);

?>

<p><h4>share succeed</h4></p>
</body></html>
