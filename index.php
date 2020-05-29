

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
    font-size: 12px;
    color:#333
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
 padding:1%;
}

a { 
    color: #737373; 
    text-decoration: none;
   }

   a:hover {
    color: #00e673; 
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




	
		 <?php
header('Content-Type: text/html; charset=utf-8');
include('config.php');
function calculate_score($votes, $item_hour_age, $gravity=1.8){
    return (($votes) / pow(($item_hour_age+2), $gravity));
}
if ($result = $db->query("SELECT id FROM 003125_posts ORDER BY username")) {
		$row_count = $result->num_rows;
		$result->close();
}
date_default_timezone_set('Etc/GMT-2');
	$time1 = date('Y-m-d H:i:s');
	$arr = array();
	$arr_val = array();
    for( $i= $row_count ; $i >= 1 ; $i-- )
{
    $query = mysqli_query($db,"SELECT title, description, time, username, likes, dislikes, fullname, link FROM 003125_posts WHERE id='".$i."' LIMIT 1");
    $data = mysqli_fetch_assoc($query);

    $query1 = mysqli_query($db,"SELECT path FROM 003125_uploads WHERE id='".$i."' LIMIT 1");
    $data1 = mysqli_fetch_assoc($query1);
	$difference_in_seconds = (strtotime($time1) - strtotime($data['time'])) / 3600;
	$score1 = $data['likes'] - $data['dislikes'];
	$col = calculate_score($score1, $difference_in_seconds, $gravity=1.8);
	$sql1 = mysqli_query($db,"UPDATE 003125_posts SET rating = '".$col."' WHERE id='".$i."'");
	if ($db->query($sql1) === TRUE) {
	} else {
	}
	$arr2 = array($i);
	$arr = array_merge($arr, $arr2);
	$arr_val2 = array($col);
	$arr_val = array_merge($arr_val, $arr_val2);
	
}	
	array_multisort($arr_val, $arr);
	for( $y= ($row_count - 1) ; $y >= 0 ; $y-- )
	{
	echo "<div class='container'><div class='likes'><div class='inner-likes'>";
	$s_id = $arr[$y];
	$query = mysqli_query($db,"SELECT title, description, time, username, likes, dislikes, fullname, link, rating FROM 003125_posts WHERE id='".$s_id."' LIMIT 1");
    $data = mysqli_fetch_assoc($query);
    $query1 = mysqli_query($db,"SELECT path FROM 003125_uploads WHERE id='".$s_id."' LIMIT 1");
    $data1 = mysqli_fetch_assoc($query1);
	if ($result = $db->query("SELECT id FROM 003125_comments WHERE post_id='".$s_id."'")) {
		$row_cnt = $result->num_rows;
		$result->close();
	}
	$sum = $data['likes'] - $data['dislikes'];
	if(isset($_SESSION['login_user'])){
		$query2 = mysqli_query($db,"SELECT liked, disliked FROM 003125_users WHERE username='".$_SESSION['username']."' LIMIT 1");
    		$data2 = mysqli_fetch_assoc($query2);
		$likes = explode("|", $data2['liked']);
		$dislikes = explode("|", $data2['disliked']);
		if (in_array($s_id, $likes) or in_array($s_id, $dislikes)) {
    			echo '</br><p></br>';
				if ($sum < 0) { echo '<p id="like" style = "color:#ff3333;">'.$sum.'</p>';}
			else if ($sum > 0) {echo '<p id="like" style = "color:#00e673;">'.$sum.'</p>';}
			else {echo '<p id="like" style = "color:#737373;">'.$sum.'</p>';}
		} else {
			echo '<a href="like.php?id='.$s_id.'&link=index.php&me=1"><p id="triangle-up"></p></a>';
			if ($sum < 0) { echo '<p id="like" style = "color:#ff3333;">'.$sum.'</p>';}
			else if ($sum > 0) {echo '<p id="like" style = "color:#00e673;">'.$sum.'</p>';}
			else {echo '<p id="like" style = "color:#737373;">'.$sum.'</p>';}
			echo '<a href="like.php?id='.$s_id.'&link=index.php&me=2"><p id="triangle-down"></p></a>';
		}
	} else {
		echo '</br><p></br>';
				if ($sum < 0) { echo '<p id="like" style = "color:#ff3333;">'.$sum.'</p>';}
			else if ($sum > 0) {echo '<p id="like" style = "color:#00e673;">'.$sum.'</p>';}
			else {echo '<p id="like" style = "color:#737373;">'.$sum.'</p>';}
			}
	echo "</div></div>";
	
	echo "<div class='post'><div class='inner-post'>";
	echo '<a id="title" href="post.php?id='.$s_id.'">'.strip_tags($data["title"]).'</a>';
	if ($data["link"] != "" and $data["link"] != null) {
	echo '<a id="link" href="'.$data["link"].'"> <button href="'.$data["link"].'"class="btn">link</button></a>';}
	
	
	echo '<div style = "background:#f2f2f2; border-radius: 10px; width:60%; border: solid 1px #737373;margin:0.5%;" align = "left"><div style = "margin:30px">';
	echo '<br><p>';
	if ($data1['path'] != "") {
	echo "<p align='center'>"."<img width='60%' src=../uploads/" . $data1['path'] . " /></p>";
	}
	print "<div id='text3' width='800px'><p id='descr' style = 'font-size: 16px;'>".strip_tags($data['description'])."</p></div>";
	echo '<p>';
	print "<p id='text4';>"."Submitted ".$data['time']."  by ".$data['username']."(".$data['fullname'].") | Likes: ".$data['likes']." Dislikes: ".$data['dislikes'];
	echo '<p>'.'<a href="post.php?id='.$s_id.'">Comments</a>';
	echo ' : '.$row_cnt;
	echo '</div></div></div></div></div>';

	}
?>   

   </body>
</html>