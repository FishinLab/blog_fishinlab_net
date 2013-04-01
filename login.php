<!--here is the login php script-->
<?php
session_start();

$_SESSION["name"] = Null;
$_SESSION["user_num"] = -1;
$_SESSION["is_login"] = 0;

?>
<html>
<body>
<?php
require "md5.php";

function get_user($name , $pwd)
{
    $sql_get_user = "select password, id from users where name = '$name'";

    $mysql_instance = new mysqli("localhost",  "root",  "web_db");
    $res = $mysql_instance->query($sql_get_user);

    while($row = $res->fetch_assoc())
    {
        if(str_md5($pwd) == $row["password"] and 0 == $row["is_login"])
        {
            return 0;          
        }
        else if(str_md5($pwd) == $row["password"] and 0 != $row["is_login"])
        {
            return 1;
        }
        else
        {
            return 2;   
        }
    }

}

function get_user_index($name)
{
    $sql_get_user_index = "select user_num from users where name = '$user_name'";
    //where user_num == user's id
    $db = new mysqli("localhost" , "root", "mysql","web_db");
    $res = $db->query($sql_get_user_index);

    $user_num = 0;
    while($row = $res->fetch_assoc())
    {
        $user_num = $row["user_num"];
    }
	
	return $user_num;	
}

$name = $_POST["name"];
$pwd = $_POST["password"];
$user_num = get_user_index($name);

if(0 == get_user($name , $pwd))
{
    $_SESSION["name"] = $name;
    $_SESSION["user_num"] = $user_num;
    $_SESSION["is_login"] = 1;

    header("Location:http://blog.fishinlab.net/".$user_num."/welcome.phtml");
	exit;
}
elseif(1 == get_user($name , $pwd))
{
	header("location:http://blog.fishinlab.net/error/login/login_error_1.html");
	exit;
}
else
{
	header("location:http://blog.fishinlab.net/error/login/login_error_2.html");
	exit;
}
?>

</body>
</html>
