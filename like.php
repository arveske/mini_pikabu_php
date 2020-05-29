<?php
	session_start();
	include('config.php');
	$query2 = mysqli_query($db,"SELECT liked, disliked FROM 003125_users WHERE username='".$_SESSION['username']."' LIMIT 1");
    	$data2 = mysqli_fetch_assoc($query2);
	$likes = $data2['liked'];
	$dislikes = $data2['disliked'];
    if ($_GET['me'] == 1) {
        $likes = $likes.'|'.$_GET['id'];
	$sql = "UPDATE 003125_users SET liked='".$likes."' WHERE username='".$_SESSION['username']."'";
	if ($db->query($sql) === TRUE) {
	} else {
    	echo "Error updating record: " . $db->error;
	}
	$sql1 = "UPDATE 003125_posts SET likes = (likes + 1) WHERE id='".$_GET['id']."'";
	if ($db->query($sql1) === TRUE) {
	} else {
    	echo "Error updating record: " . $db->error;
	}
	header('location: '.$_GET['link']);

    } elseif ($_GET['me'] == 2) {
	$dislikes = $dislikes.'|'.$_GET['id'];
	$sql = "UPDATE 003125_users SET disliked='".$dislikes."' WHERE username='".$_SESSION['username']."'";
	if ($db->query($sql) === TRUE) {
	} else {
    	echo "Error updating record: " . $db->error;
	}
	$sql1 = "UPDATE 003125_posts SET dislikes = (dislikes + 1) WHERE id='".$_GET['id']."'";
	if ($db->query($sql1) === TRUE) {
	} else {
    	echo "Error updating record: " . $db->error;
	}
	header('location: '.$_GET['link']);
    }

?>