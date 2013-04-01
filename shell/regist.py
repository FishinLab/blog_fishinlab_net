#this is the python script for user to regist in FisHinLab

#error types:
#error code 0:the routine completed successfully
#error code 1:the user's home page directory is already exists
#error code 2:the php does not pass the right parameter to the python script

import sys
import os

class register:

    error_code = 0

    def affire(self, user_num, user_name):
    
        if(user_num is None or user_name is None):
            self.error_code = 1
            return self.error_code
        
        user_home_path = "/var/www/" + user_num + "/";
        user_home_page = user_home_path + "welcome.phtml"
        if os.path.exists(user_home_page):
            error_code = 1
            return 1
        else:
            os.system("mkdir " + user_home_path)
            os.system("chmod 757 " + user_home_path)

            html_web_code = '''<html>
    <head>
        <title>welcome back</title>
        <link rel = "stylesheet" type = "text/css" href="/styles/welcome_style.css"/>
    </head>
    <body>
<p id = "little_title">
welcome back, '''+ user_name +'''  
</p>

<hr />
<hr id = "updown"/>
<!--upload files to user files list-->
<form action = "../upload_file.php" method = "post" class = "tools" enctype = "multipart/form-data">
    <p class="t">you can upload local files here</p>
	<input type = "file" name = "upload_file" id = "upload_file" value = "choose file" >
	<input type = "hidden" name = "user_name" id = "user_name" value = "'''+ user_name +'''">
	<input type = "submit" name = "submit" value = "upload files">
</form>

<!--show user friends-->
<form action = "../show_friends.php" method = "post" class = "tools">
    <p class="t">say hello to my friends</p>
	<input type = "hidden" name = "user_name" value  = "'''+user_name+'''">
	<input type = "submit" name = "submit" value = "show friends"> 
</form>

<!--click into user files list-->
<form action = "../get_user_files.php" method= "post" class = "tools">
    <p class = "t">show files</p>
	<input type = "hidden" name = "user_name" value = "'''+user_name+'''">
	<input type = "submit" name = "submit" value = "show files">
</form>

<!--click into user notes list-->
<form action = "../get_user_notes.php" method = "post" class = "tools">
    <p class = "t">show notes</p>
	<input type = "hidden" name = "user_name" value = "'''+user_name+'''" >
	<input type = "submit" name = "submit" value ="show notes" >
</form>

<!--add friend id to friend list-->
<form action = "../add_friend.php" method = "post" class = "tools">
    <p class = "t">add new friend</p>
	<p id = "add_friend">friend name:<input type = "text" name = "friend">
	<input type = "hidden" name = "user_name" value = "'''+user_name+'''"></p>
	<input type = "submit" name = "submit" value = "add">
</form>
<!--web note-->
<p id = "write_note">write down the note</p>
<form action = "../web_note.php" method="post" id = "note_form" enctype = "multipart/form-data">
	<p class = "note_title"><textarea name = "title" rows = "2" cols = "100"></textarea></p>
	<p class = "note_self"><textarea name = "note" rows = "20" cols = "100"></textarea></p>
	<input type = "hidden" name = "user_name" value = "'''+user_name+'''" />
	<input type = "submit" name = "submit" value = "note" />
</form>

<!--logout-->
<form action = "../logout.php" id = "logout_form" class = "tools">
    <input type = "submit" name = "submit" value = "logout"/> 
</form>
</body></html>''';#this is the welcome html web page code

            #auto generate welcome.phtml 
            fw = file(user_home_page , 'w')
            #here is the html code of welcome.phtml
            fw.writelines(html_web_code)
            fw.close()
            
            error_code = 0
            return 0

def run(user_num, user_name):
    if user_num is None:
        return 2
    elif user_name is None:
        return 1
    else:
        reg = register();
        reg.affire(user_num, user_name)

if __name__ == "__main__":
    run(sys.argv[1], sys.argv[2])
