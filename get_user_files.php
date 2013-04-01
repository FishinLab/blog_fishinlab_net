<!--get the user's files from database-->
<html>
    <head>
        <title>
            get user files
        </title>
        <link rel = "stylesheet" href = "styles/show_file_style.css" type = "text/css"/>
    </head>
<body>
<p><h3>you got files here:</h3></p>
<?php
require "get_user_num.php";
#get the file name from the user_files
#(1) select the file_name from user_files
#(2) generate the table of the user files, put the file_name into the user_files table
function get_files_from_db($name)
{
    $sql_get_files = "select file_name, file_path from user_files where owner_name = '$name';";

	$con = mysql_connect("localhost" , "root" , "mysql");
	mysql_select_db("web_db");
	$result = mysql_query($sql_get_files);

	#generate the table of file 
		echo "<table border = 1 id = 'file_table'>";
		echo "<tr><th>owner:</th> <th>file name:</th> <th></th> <th></th> <th></th> <th></th> </tr>";

	while($row = mysql_fetch_array($result))
	{
		#generate the talbe of files here
		echo "<tr>";
		echo 	"<td>".$name."</td>";
		echo 	"<td>".$row["file_name"]."</td>";
		echo 	"<td>
					<form action = 'share_file.php' method = 'post'>
						<input type = 'submit' name = 'share' value = 'share file'>
							<input type = 'hidden' name = 'user_name' value = '".$name."'>
							<input type = 'hidden' name = 'file_name' value = '".$row['file_name']."'/>
							<input type = 'hidden' name = 'file_path' value = '".$row['file_path']."'>
						</input>
					</form>
				</td>
				<td>
					<form action = 'download_file.php' method = 'post'>
						<input type = 'submit' name = 'download' value = 'download'>
							<input type = 'hidden' name = 'user_name' value = '".$name."'>
							<input type = 'hidden' name = 'file_name' value = '".$row['file_name']."'/>
							<input type = 'hidden' name = 'file_path' value = '".$row['file_path']."'>
						</input>
					</form>
				</td>
				<td>
					<form action = 'delete_file.php' method = 'post'>
						<input type = 'submit' name = 'delete' value = 'delete'>
							<input type = 'hidden' name = 'user_name' value = '".$name."'>
							<input type = 'hidden' name = 'file_name' value = '".$row['file_name']."'/>
							<input type = 'hidden' name = 'file_path' value = '".$row['file_path']."'>
						</input>
					</form>
				</td>
				<td>
					<form action = 'check_file.php' method = 'post'>
						<input type = 'submit' name = 'check' value = 'check file'>
							<input type = 'hidden' name = 'user_name' value = '".$name."'>
							<input type = 'hidden' name = 'file_name' value = '".$row['file_name']."'/>
							<input type = 'hidden' name = 'file_path' value = '".$row['file_path']."'>
						</form>
					</form>
				</td>";
		echo "</tr>";
	}
	echo "</table>";
	mysql_close($con);

}

$name = $_POST["user_name"];
if($name)
{
	get_files_from_db($name);
#	echo "<a href = 'http://192.168.1.111/0001/welcome.html'>return home page</a>";
#how this happened here??? why <a> write before the function get_files_from_db()???
}
$con = mysql_connect("localhost", "root" , "mysql");

$user_num = get_user_num($name,$con);
echo "<a href = 'http://blog.fishinlab.net/$user_num/welcome.phtml'>return home page</a>";

mysql_close($con);
?>
<br />
</body></html>
