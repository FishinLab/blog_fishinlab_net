<!--this is the script for other script get user number to generate user direct-->
<?php
function get_user_num($user_name, $mysql_db)
{
	if($mysql_db)
	{
        $sql_get_user_num = "select user_num from users where name = '$user_name';";
        
        $res = $mysql_db->query($sql_get_user_num);
        $row = $res->fetch_assoc();

		if($row)
		{
			return $row["user_num"];
		}
		else die("select sql error");
	}
}
?>
