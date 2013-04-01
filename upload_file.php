<!--this is the script for upload file-->
<html><body>
<?
require "get_user_num.php";
require "check_session.php";
function store_file($user_name , $_FILES)
{	
    $sql_get_user_num = "select user_num from users where name = '$user_name';";

	$con = mysql_connect("localhost" , "root" , "mysql");
	mysql_select_db("web_db");
	$result = mysql_query($sql_get_user_num);
	$row = mysql_fetch_array($result);
	
	mysql_close($con);
	$user_num = $row["num"];
	$up_file_name = $_FILES["upload_file"]["name"];

	move_uploaded_file($_FILES["upload_file"]["tmp_name"] , "/var/www/".$user_num."/tmp/".$up_file_name);
	
	echo "<p><h4>upload file succeed</h4></p>";
	echo "<a href = 'http://blog.fishinlab.net/".$user_num."/welcome.phtml'><h4>return home page</h4></a>";
}

#update the web_db
function upload_file($user_name , $file_name)
{
    $sql_get_user_num = "select user_num from users where name = '$user_name';";
	
	$con = mysql_connect("localhost" , "root" , "mysql");
	mysql_select_db("web_db");
	$result = mysql_query($sql_get_user_num);

	$row_num = mysql_fetch_array($result);

    $sql_update_db = "insert into user_files value (id, file_name = '$file_name', file_path = '/var/www/$row_num['num']/tmp/$file_name', file_owner = '$user_name', file_holder = '$user_name');";
	mysql_query($sql_update_db);	
	
	mysql_close($con);
}

$user_name = $_POST["user_name"];
$file_name = $_FILES["upload_file"]["name"];

#the procesure of uploading file:
#(1) update the table of user_files
#(2) move the template file to /var/www/tmp/$user_num/$file_name

upload_file($user_name, $file_name);
store_file($user_name, $_FILES);
?>

</html></body>
