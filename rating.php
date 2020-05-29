
<?php
include('config.php');
if ($result = $db->query("SELECT id FROM 003125_posts ORDER BY username")) {
		$row_count = $result->num_rows;
		$result->close();
}
    for( $i= $row_count ; $i >= 1 ; $i-- )
{
    $query = mysqli_query($db,"SELECT title, description, time, username, likes, dislikes, fullname, link FROM 003125_posts WHERE id='".$i."' LIMIT 1");
    $data = mysqli_fetch_assoc($query);

    $query1 = mysqli_query($db,"SELECT path FROM 003125_uploads WHERE id='".$i."' LIMIT 1");
    $data1 = mysqli_fetch_assoc($query1);

	echo '<div style = "width:600px; border: solid 1px #333333; " align = "left"><div style = "margin:30px">';
	echo "<p>".htmlspecialchars($data['title']);
	if ($data["link"] != "" and $data["link"] != null) {
	echo ' '.'<a href="'.$data["link"].'">link</a>';}
	if ($data1['path'] != "") {
	echo "<p>"."<img width='350' src=../uploads/" . $data1['path'] . " />";
	}
	print "<p>".htmlspecialchars($data['description']);
	print "<p>"."Submitted ".$data['time'];
	print "  by ".$data['username'];
	print "(".$data['fullname'].")";
	print " | Likes: ".$data['likes'];
	print " Dislikes: ".$data['dislikes'];
	echo '<p>'.'<a href="">Comments</a>';
	if(isset($_SESSION['login_user'])){
		$query2 = mysqli_query($db,"SELECT liked, disliked FROM 003125_users WHERE username='".$_SESSION['username']."' LIMIT 1");
    		$data2 = mysqli_fetch_assoc($query2);
		$likes = explode("|", $data2['liked']);
		$dislikes = explode("|", $data2['disliked']);
		if (in_array($i, $likes)) {
    			echo ' '."You like it";
		} elseif (in_array($i, $dislikes)) {
			echo ' '."You dislike it";
		} else {
			echo ' '.'<form action="like.php?id='.$i.'" method="POST"><input name="like" type="submit" value="Like" /><input name="dislike" type="submit" value="Dislike" /></form>';
			
		}
   	}
	echo '</div></div>';
}
?>        