<!--this php script will check session-->

<?php
function check_session($user_name, $user_num)
{
    if($_SESSION == Null)
    {
        return False;
    }

    if(($user_name != Null) and ($user_num != Null))
    {
        if(($_SESSION["name"] == $user_name) and ($_SESSION["is_login"] == 1) and ($_SESSION["user_num"] == $user_num))
        {
            return True;
        }
        else
        {
            return False;
        }
    } 
    else
    {
        die("error: function check_session() needs 2 parameter");
    }
}
?>
