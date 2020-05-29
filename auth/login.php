<?php
   include("config.php");
   session_start();
	$error="";
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      

    $query = mysqli_query($db,"SELECT password, fullname FROM 003125_users WHERE username='".mysqli_real_escape_string($db,$_POST['username'])."' LIMIT 1");
    $data = mysqli_fetch_assoc($query);

   
    if($data['password'] === $_POST['password'])
    {
         $_SESSION['login_user'] = myusername;
	 $_SESSION['username'] = $myusername;
	$_SESSION['fullname'] = $data['fullname'];
         
         header("location: ../index.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<html>
   
   <head>
      <title>Login Page</title>
      
      <style type = "text/css">
         * {
margin: 0;
  padding: 0;

}
body {
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 18px;
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
	margin: 16px;
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

#login {
font-size: 20px;

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
		<div id="menu"><a id="menu1" href="register.php">register</a></div>		
            </div>

<div id="navigation">
            <p></p>
        </div>	

      <div align = "center">
         <div style = "position:asolute; width:600px; border: solid 1px #737373; background:#f2f2f2; border-radius: 10px;" align = "left">
            <div style = "background-color:#00e673; color:#f2f2f2; padding:3px;"><b>Login</b></div>

				
            <div style = "margin:30px">
               <form action = "" method = "post">
                  <label id='login'>Username  :</label><input id='login' type = "text" name = "username" class = "box"/><br /><br />
                  <label id='login'>Password  :</label><input id='login' type = "password" name = "password" class = "box" /><br/><br />
			<p>user: admin, pass: admin4</p>
                  <input id='login' type = "submit" value = " Submit "/><br />
               </form>
               
               <div style = "font-size:20px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>