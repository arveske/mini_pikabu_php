<?php
function upload_my_file($fileid) {
  $target_dir = "../uploads/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $error="";
  $uploadOk = 1;
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
  $saved_file = $target_dir . $fileid . "." . $imageFileType;
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"]) and $_FILES["fileToUpload"]["size"] != 0) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
          $uploadOk = 1;
      } else {
          $uploadOk = 0;
      }
  }
  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 5000000) {
      $_SESSION['error']=$_SESSION['error']."<p>Sorry, your file is too large.";
      $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
      $_SESSION['error']=$_SESSION['error']."Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
  }
  if ($uploadOk == 0) {
      $_SESSION['error']=$_SESSION['error']."Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
	$name = $fileid . '.' . $imageFileType;
	mysqli_query($_SESSION['db'],"INSERT INTO 003125_uploads SET id='".$_SESSION['row_cnt']."', path='".$name."'");
	
      if (move_uploaded_file(
           $_FILES["fileToUpload"]["tmp_name"], $saved_file)) {
          $_SESSION['error']=$_SESSION['error'].'<p>The file '. basename( $_FILES["fileToUpload"]["name"]). ' has been uploaded.';
	
      }
  }
}

upload_my_file($row_count);
?>