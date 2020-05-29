<?php
include('config.php');
session_start();
$_SESSION['error'] = "";

function is_url_exist($url){
    $ch = curl_init($url);    
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if($code == 200){
       $status = true;
    }else{
      $status = false;
    }
    curl_close($ch);
   return $status;
}

if(isset($_POST['submit']))
{		
        $login = $_SESSION['username'];
        $fullname = $_SESSION['fullname'];
	date_default_timezone_set('Etc/GMT-2');
	$time = date('Y-m-d H:i:s');
	$title = $_POST['title'];
	$description = $_POST['descr'];
	$like = 0;
	$dislike = 0;
	$link = null;
	$file = $_POST['link'];
	if(is_url_exist($file)) {
			if (strpos($file, 'http') == false) {
    				$file = 'http://'.$file;
			}
			$link = $file;
	} else {
		$_SESSION['error']=$_SESSION['error']."Its not link, will no be added";
    		echo "<p>";
	}
	$_SESSION['error'] = "";
	if ($result = $db->query("SELECT id FROM 003125_posts ORDER BY title")) {
		$row_cnt = $result->num_rows;
		$row_cnt = $row_cnt +1;
		$result->close();
	}  
	$_SESSION['row_cnt'] = $row_cnt;
	$_SESSION['db'] = $db;
	
    mysqli_query($db,"INSERT INTO 003125_posts SET username='".$login."', fullname='".$fullname."', time='".$time."', title='".$title."', description='".$description."'
	, likes='".$like."', dislikes='".$dislike."', id='".$row_cnt."', link='".$link."'");
	$_SESSION['error']=$_SESSION['error']."Post is sent to DataBase";
	if ($_FILES["fileToUpload"]["size"] != 0){
	if ($result = $db->query("SELECT id FROM 003125_uploads ORDER BY path")) {
		$row_count = $result->num_rows;
		$row_count = $row_count + 10;
		$result->close();
include('picupload.php');
	}
	
	}
}
?>

<html>
   
   <head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <title>Adding Page</title>
	  <meta name="viewport" content="width=device-width, initial-scale=1">
      <style type = "text/css">
* {
margin: 0;
  padding: 0;

}
	body {
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 14px;
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
#adder1 {
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


         
         label {
            font-weight:bold;
            font-size:14px;
         }
         
         .box {
            border:#666666 solid 1px;
         }
		 .your-form-selector {
    	display: inline-block;
	}
      </style>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
   <div id="wrapper">
   <div style="display:inline;" id="header">
               <a href="index.php"><img id="logo" width='260' src=images/logo.png /></a> 	
            </div>
<div id="navigation">
            <p></p>
        </div>	

	</div>
      <div align = "center">

	  
         <div style = "position:asolute; width:600px; border: solid 1px #737373; background:#f2f2f2; border-radius: 10px;" align = "left">
				
               
               <?php
if(isset($_SESSION['login_user'])) {
	?>
 <div style = "background-color:#00e673; color:#f2f2f2; padding:3px;"><b>Add New Post!</b></div>
<div style = "margin:30px">
<form method="post" name="myform" enctype="multipart/form-data">
	<label id='adder1' for="title">Title:</label>
	<input id='adder1' type="text"  name="title" width="80"  maxlength="30" placeholder="Title! - max size 50 symbols" required/><br>
	<label id='adder1' for="description">Description:</label>
	<textarea id='adder1' maxlength="200" type="text"  style="width: 536px; height: 100px;" name="descr" width="80" height="100" placeholder="Description! - max size 200 symbols" required/></textarea><br>
	<label id='adder1' for="title">Link:</label>
	<input id='adder1' type="text"  name="link"  placeholder="This is optional"/><br>
	<label id='adder1' for="link_url">Picture:</label>
	<input id='adder1' type="file" name="fileToUpload" id="fileToUpload" /><br>
    <input id='adder1' type="hidden" name="token" value="<?php echo $_SESSION['token'];?>"/>
	<p id='adder1'>Allowed formats: .png, .jped, .jpg, .gif</p>
    <input id='adder1' name="submit" type="submit" value="Post"/>
</form>
<div style = "font-size:20px; color:#cc0000; margin-top:10px"><?php echo $_SESSION['error']; ?></div>

<?php
$_SESSION['error'] = "";
} else {
	$_SESSION['error'] = "";
echo '<br> You must be logged in to post new content <br>';
}
?>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>