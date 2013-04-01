<!--this script is used to get the affire of logout event-->
<html><body>

<?php

#when user logout the web site, these things must be done:
#(1) update the user login status, that mean set the is_login = 0
#(2) copy the upload file which comes from user to the storage

	$sql_logout = "update users set is_login = 'N';";
	
    $db = new mysqli("localhost". "root" , "mysql", "web_db");
    $db->query($sql_logout);

    session_start();
    unset($_SESSION);
    session_destroy();

echo "<script type = 'text/javascript'>";
echo "";
echo "</script>";
?>

</body></html>
