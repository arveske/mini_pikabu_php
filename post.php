

<html>
   
   <head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <title>Main Page</title>
	  <meta name="viewport" content="width=device-width, initial-scale=1">
      <style type = "text/css">
* {
margin: 0;
  padding: 0;
box-sizing:border-box;
}
	body {
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 14px;
    color:#333
  margin: 0;
  padding: 0;
	outline:none;
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
#title {
 font-size: 18px;
	float:left;
	font-weight: 500;
	position: relative;
bottom: 42px;
left:1%;
}

a { 
    color: #737373; 
    text-decoration: none;
   }

   a:hover {
    color: #00e673; 
   }

#postitos {
   	margin-left: 22.5%;
	margin-right: 18%;
padding:5%;

}


.btn {
  margin-bottom:5px;
  -webkit-border-radius: 28;
  -moz-border-radius: 28;
  border-radius: 28px;
  font-family: Arial;
  color: #737373;
  font-size: 20px;
  padding: 3px 15px 3px 15px;
  border: solid #00e673; 1px;
  text-decoration: none;
}

.btn:hover {
  background: #00e673;;
  background-image: -webkit-linear-gradient(top, #00e673;, #00e673;);
  background-image: -moz-linear-gradient(top, #00e673;, #00e673;);
  background-image: -ms-linear-gradient(top, #00e673;, #00e673;);
  background-image: -o-linear-gradient(top, #00e673;, #00e673;);
  background-image: linear-gradient(to bottom, #00e673;, #00e673;);
  text-decoration: none;
}

#link {
	padding: 2px;
	right: 5px
	position: absolute;
}
#post {
	position: relative;
top: 30px;
padding: 30px;
	
}

}
#descr {
	font-size: 14px;
	
}

#text3 {
	margin-top: 10px;
	 width: 100%; 
    word-wrap: break-word;
	margin-bottom: 10px;
	
}

#text4 {
	 color: #737373;
	
}

#text5 {
	 margin-top: 10px;
	font-size: 14px;
}

#triangle-up {
	width: 0;
	height: 0;
	border-left: 16px solid transparent;
	border-right: 16px solid transparent;
	border-bottom: 23px solid #737373;
}
#triangle-up:hover {
	border-bottom: 23px solid #00e673;
}
#triangle-down {
	width: 0;
	height: 0;
	border-left: 16px solid transparent;
	border-right: 16px solid transparent;
	border-top: 23px solid #737373;
}
#triangle-down:hover {
	border-top: 23px solid #ff3333;
}     

#like {
 font-size: 28px;
	font-weight: 700;
}

#likes {
position:absolute;
left: 26%;
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
font-size: 15px;

}

.likes {
	float:left;
	width:28%;
}

.post {
	float:left;
	width:72%;
	padding-top:30;
}
.inner-likes {
	float:right;
	text-align:center;
	padding:15px;
}

.space {
	float:left;
	width:24.4%;
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
	
   
 
				
            <div style="display:inline;" id="header">
               <a href="index.php"><img id="logo" width='260' src=images/logo.png /></a>
               <?php
			   $error = "";
   session_start();
   if(!isset($_SESSION['login_user'])){
      print '<div id="menu"><a id="menu1" href="auth/login.php"><img width="20px" src=images/log1.png /> login</a><a href="auth/register.php">register</a></div>';
   } else {
	   print '<div id="menu"><a id="menu1" href="addpost.php"><img width="25px" src=images/write1.png /> add post</a><a href = "auth/logout.php">log out</a></div>';
   }
		
		?>   			
            </div>
<div id="navigation">
            <p></p>
        </div>



<div class="container">

			
		 <?php
header('Content-Type: text/html; charset=utf-8');
include('config.php');
if ($result = $db->query("SELECT id FROM 003125_posts ORDER BY username")) {
		$row_count = $result->num_rows;
		$result->close();
}

	$query = mysqli_query($db,"SELECT title, description, time, username, likes, dislikes, fullname, link, rating FROM 003125_posts WHERE id='".$_GET['id']."' LIMIT 1");
    $data = mysqli_fetch_assoc($query);
    $query1 = mysqli_query($db,"SELECT path FROM 003125_uploads WHERE id='".$_GET['id']."' LIMIT 1");
    $data1 = mysqli_fetch_assoc($query1);
	$sum = $data['likes'] - $data['dislikes'];
	echo '<div class="likes"><div class="inner-likes">';
	if(isset($_SESSION['login_user'])){
		$query2 = mysqli_query($db,"SELECT liked, disliked FROM 003125_users WHERE username='".$_SESSION['username']."' LIMIT 1");
    		$data2 = mysqli_fetch_assoc($query2);
		$likes = explode("|", $data2['liked']);
		$dislikes = explode("|", $data2['disliked']);
		if (in_array($_GET['id'], $likes) or in_array($_GET['id'], $dislikes)) {
    			echo '<p></br></br>';
				if ($sum < 0) { echo '<p id="like" style = "color:#ff3333;">'.$sum.'</p>';}
			else if ($sum > 0) {echo '<p id="like" style = "color:#00e673;">'.$sum.'</p>';}
			else {echo '<p id="like" style = "color:#737373;">'.$sum.'</p>';}
		} else {
			echo '<a href="like.php?id='.$_GET['id'].'&link=post.php?id='.$_GET['id'].'&me=1"><p id="triangle-up"></p></a>';
			if ($sum < 0) { echo '<p id="like" style = "color:#ff3333;">'.$sum.'</p>';}
			else if ($sum > 0) {echo '<p id="like" style = "color:#00e673;">'.$sum.'</p>';}
			else {echo '<p id="like" style = "color:#737373;">'.$sum.'</p>';}
			echo '<a href="like.php?id='.$_GET['id'].'&link=post.php?id='.$_GET['id'].'&me=2"><p id="triangle-down"></p></a>';
		}
	} else {
		echo '<p></br></br>';
				if ($sum < 0) { echo '<p id="like" style = "color:#ff3333;">'.$sum.'</p>';}
			else if ($sum > 0) {echo '<p id="like" style = "color:#00e673;">'.$sum.'</p>';}
			else {echo '<p id="like" style = "color:#737373;">'.$sum.'</p>';}
			}
		echo '</div></div>';
	echo '<div class="post"><div class="inner-post">';
	echo '<a href="post.php?id='.$_GET['id'].'">'.strip_tags($data["title"]).'</a>';
	if ($data["link"] != "" and $data["link"] != null) {
	echo '<a id="link" href="'.$data["link"].'"> <button href="'.$data["link"].'"class="btn">link</button></a>';}
	
	
	echo '<div style = "background:#f2f2f2; border-radius: 10px; width:60%; border: solid 1px #737373;" align = "left"><div style = "margin:30px">';
	echo '<br><p>';
	if ($data1['path'] != "") {
	echo "<p align='center'>"."<img width='60%' src=../uploads/" . $data1['path'] . " /></p>";
	}
	print "<p>".strip_tags($data['description'])."</p>";
	echo '<p>';
	print "<p>"."Submitted ".$data['time'];
	print "  by ".$data['username'];
	print "(".$data['fullname'].")";
	print " | Likes: ".$data['likes'];
	print " Dislikes: ".$data['dislikes'];
	echo '</div></div></div>';

	
   	
?>  
</div>
<div class="container">
<div class="space">
<div class="inner-likes"></div></div>
<div class="post">
<div class="inner-post">
         <div style = "position:asolute; width:60%; border: solid 1px #737373; background:#f2f2f2; border-radius: 10px;margin-left:5%" align = "left">
            <div style = "background-color:#00e673; color:#f2f2f2; padding:3px; font-size: 15px;border-radius: 10px;"><b>Add Comment to This Post!</b></div>

				
            <div style = "margin:30px">
               
               <?php
if(isset($_SESSION['login_user'])) {
	?>
<form method="post" name="myform" enctype="multipart/form-data">
	<label id='login' for="description">Comment:</label>
	<textarea id='login' maxlength="200" type="text"  style="width: 100%; height: 80px;" name="descr" width="80" height="100" placeholder="Description! - max size 200 symbols" required/></textarea><br>
    <input id='login' name="submit" type="submit" value="Submit"/>
</form>

<?php
} else {
echo '<br> You must be logged in to post comments <br>';
}
?>
					</div>
            </div>
				</div>
         </div>
		 </div>
<?php
if(isset($_POST['submit']))
{		
        $login = $_SESSION['username'];
        $fullname = $_SESSION['fullname'];
	date_default_timezone_set('Etc/GMT-2');
	$time = date('Y-m-d H:i:s');
	$description = $_POST['descr'];
		if ($result = $db->query("SELECT id FROM 003125_comments ORDER BY text")) {
		$row_cnt = $result->num_rows;
		$row_cnt = $row_cnt +1;
		$result->close();
	}   
	$_SESSION['row_cnt'] = $row_cnt;
	$_SESSION['db'] = $db;
	
    mysqli_query($db,"INSERT INTO 003125_comments SET user='".$login."', name='".$fullname."', time='".$time."', text='".$description."'
	, id='".$row_cnt."', post_id='".$_GET['id']."'");
	} 

		 
if ($result = $db->query("SELECT id FROM 003125_comments ORDER BY text")) {
		$row_count3 = $result->num_rows;
		$result->close();
	}   
	   		 
		 for( $y= ($row_count3) ; $y >= 1 ; $y-- )
	{
	$s_id = $y;
	$query3 = mysqli_query($db,"SELECT time, user, name, text, post_id FROM 003125_comments WHERE id='".$s_id."' LIMIT 1");
    $data3 = mysqli_fetch_assoc($query3);
	if  ($data3['post_id'] == $_GET['id']) {
		echo '<div class="container"><div class="space"><div class="inner-likes"></div></div>';
		echo '<div class="post"><div class="inner-post">';
	echo '<div style = "position:asolute; width:60%; border: solid 1px #737373; background:#f2f2f2; border-radius: 10px;margin-left:5%" align = "left"><div style = "margin:30px">';
	print "<p>".strip_tags($data3['text']);
	print "<p><br>";
	print "<p>"."Submitted ".$data3['time'];
	print "  by ".$data3['user'];
	print "(".$data3['name'].")</div></div></div></div></div>";

   	

	
	}
	}

	
	?>
		 

   </body>
   </html>