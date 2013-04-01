<!--this is the script for user check the fiel-->
<html><body>
<?php

#this procesure just select file attribute from the user_files table
function check_file($user_name, $file_name)
{
	$con = mysql_connect("localhost" , "root" , "mysql");
	mysql_select_db("web_db");

    $sql_check = "select file_attr, file_path from user_files where holder = '$user_name';"

	$res = mysql_query($sql_check);
	while($row = mysql_fetch_array($res))
	{
		echo "<p><h3>".$row["file_attr"]."</h3></p>";
		echo "<br />";
	}
	mysql_close($con);
}
?>
</body></html>
