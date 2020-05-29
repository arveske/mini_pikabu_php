
<html>
   
   <head>
      <title>Register Page</title>
      
      <style type = "text/css">
         
	* {
margin: 0;
  padding: 0;

}
body {
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 20px;
    color:#333
  margin: 0;

}

#wrapper {
    width: 100%;
    min-width: 200px;
    max-width: 4000px;
  margin: 0;
  padding: 0;
}

#header {
display: inline-block;
    float: left;
    height: 60px;
    width: 100%;
    background: #f2f2f2;
padding: 0px;
}

#menu {
    float:right;
    font-size: 18px;
	margin: 18px;
margin-right: 50px;

}

#menu1 {
	margin-right: 30px;
}

#logo {
   	margin: 5px;
}

#navigation {
    float: left;
    height: 6px;
    width: 100%;
    background: #00e673;
padding: 0px;
}

#registration {
font-size: 16px;

}
input, select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type=submit] {
    width: 100%;
    background-color: #00e673;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}

a { 
    color: #737373; 
    text-decoration: none;
   }

   a:hover {
    color: #00e673; 
   }
         
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         
         .box {
            border:#666666 solid 1px;
		
         }
      </style>
      
   </head>
   
   <body bgcolor = "#FFFFFF">

	            <div style="display:inline;" id="header">
               <a href="../index.php"><img id="logo" width='260' src=../images/logo.png /></a> 	
				<div id="menu"><a id="menu1" href="login.php"><img width="16px" src=../images/log1.png /> login</a></div>
            </div>
<div id="navigation">
            <p></p>
        </div>	
      <div align = "center">
         <div style = "position:asolute; width:600px; border: solid 1px #737373; background:#f2f2f2; border-radius: 10px;" align = "left">
            <div style = "background-color:#00e673; color:#f2f2f2; padding:3px;"><b>Registration</b></div>
				
            <div style = "margin:30px">

	
	<form method="POST">
                  <label id='registration'>Username  :</label><input id='registration' name="username" type="text" class = "box" required/><br /><br />
                  <label id='registration'>Password  :</label><input id='registration' name="password" type="password" placeholder="6-30 symbols required" class = "box" required/><br/><br />
		<label id='registration'>E-mail  :</label><input id='registration' name="email" type="email" class = "box" required/><br/><br />
		<label id='registration'>Full name  :</label><input id='registration' name="fullname" type="text" class = "box" required/><br/><br />
                  <input id='registration' name="submit" type="submit" value="Register"/><br />
               </form>
				
            </div>
				
         </div>
		<?php

$link=mysqli_connect("localhost", "st2014", "progress", "st2014");

if(isset($_POST['submit']))
{
    $err = [];

    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['username']))
    {
        $err[] = "Username can only contain letters and numbers";
    }

    if(strlen($_POST['username']) < 3 or strlen($_POST['username']) > 30)
    {
        $err[] = "Username can have size 3-30 symbols";
    }
	
	if(strlen($_POST['password']) < 6 or strlen($_POST['password']) > 30)
    {
        $err[] = "Password can have size 6-30 symbols";
    }

    $query = mysqli_query($link, "SELECT fullname FROM 003125_users WHERE username='".mysqli_real_escape_string($link, $_POST['username'])."'");
    if(mysqli_num_rows($query) > 0)
    {
        $err[] = "User with same username already exists";
    }

    if(count($err) == 0)
    {

        $login = $_POST['username'];

        $password = trim($_POST['password']);
		
		$email = $_POST['email'];
		$fullname = $_POST['fullname'];
		$zero = 0;

        mysqli_query($link,"INSERT INTO 003125_users SET username='".$login."', password='".$password."', email='".$email."', fullname='".$fullname."', liked='".$zero."', disliked='".$zero."'");
        header("Location: ../index.php"); exit();
    }
    else
    {
        print "<b>Came some errors</b><br>";
        foreach($err AS $error)
        {
            print $error."<br>";
        }
    }
}
?>	
      </div>

   </body>
</html>