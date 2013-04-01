<!--this is the script for user to get md5-->
<?php
#here are 2 function one is for string and the other is for file
function str_md5($str)
{
    if(is_string($str))
    {
        return md5($str);
    }
    else die("this function is for string to md5");
}

function file_md5($file_path)
{
    if(file_exists($file_path))
    {
        return md5_file($file_path);
    }
    else die("this function is for file md5");
}
/*
#to use md5sum is about 4 times faster than the openssl md5
function file_md5sum($file_path)
{
    if(file_exists($file_path)) 
    {
        $res = explode(" ", exec("md5sum $file_path"));
        return res[0];
    }
    else die("the file is not exists");
}
 */
?>
