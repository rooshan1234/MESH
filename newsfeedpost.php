<?php
include_once ("config.php");
$error="";


session_start();
if (!isset($_SESSION["user_id"])) {
	header("Location: login.php");
	exit();
}else{

	$user_id = $_SESSION["user_id"];
	$first_name = $_SESSION["first_name"];
	$last_name = $_SESSION["last_name"];

	if (isset($_POST["submitted"]) && $_POST["submitted"]){
		
		$uploaddir = "uploads/";
		
		$temp = explode(".", $_FILES['userfile']['name']);

		$extension = '.' . end($temp);

		$filename = basename($_FILES["userfile"]["name"], $extension) . $user_id;

		$filename = $filename . $extension;

		$file_to_upload = $uploaddir . $filename;

		$status_post = trim($_POST["status"]);

		//if (strlen($status_post) > 0 || $_FILES['userfile']['name']) allows the user to post image without comments
		if (strlen($status_post) > 0){

			if ($_FILES['userfile']['name']){
				if (move_uploaded_file($_FILES['userfile']['tmp_name'], $file_to_upload)){
					$error="File is valid, and was successfully uploaded.\n";
				}else{
					$error= "Unable to upload file.\n";
				}
			}else{
				$filename ="";
				$uploaddir = "";

			}
			
			$db = mysqli_connect(DB_HOST_NAME, DB_USER, DB_PASS, DB_NAME);
			
			if (!$db) {
				exit ("Error - Could not connect to MySQL");
			}

			$q = "INSERT INTO Status(u_id, first_name, last_name, post_status, picture_path ,picture_name,time_stamp) VALUES (
				'$user_id', '$first_name', '$last_name', '$status_post', '$uploaddir' ,'$filename' ,NOW());";

$result = mysqli_query($db, $q);

if ($result){
	header("Location: feed.php?c=0");

	mysqli_free_result($result);
	
	mysqli_close($db);
	
	exit();

}else{
	$error = ("Was unable to upload the status to the database.");
	mysqli_free_result($result);
	mysqli_close($db);
}
}else{
	$error = ("Must enter a non-blank status.");
}
}else{
}
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="mystyle.css">
	<title>MESH Post - NewsFeed</title>
	<script type = "text/javascript" src="newfeedpost-functions.js"></script>

</head>
<body>
	<div class="bodyWidth">
		<h1>MESH <small>Post. Newsfeed.</small></h1>
		<hr>
	</div>

	<div class="bodyWidth">
		<div class="navigationMenu">
			<img src="imageholder.gif" alt="image">
			<h3><?=$first_name?> <?=$last_name?></h3>
			<ul class="nagivationMenulist">
				<li><a href="feed.php?c=0">Newsfeed</a></li>
				<li><a href="">Friends</a></li>
				<li><a href="newsfeedpost.php">Post Status</a></li>
				<li><a href="">Settings</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div>
	</div>

	<div class="bodyWidth">
		<div class="commentContainer">
			<form class="commentboxandbuttons" action="newsfeedpost.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="submitted" value="1"/>
				<textarea name="status" id="status" ROWS="100" COLS="100"></textarea>		
				<p id="charactersNewspost">1000 characters remaining</p>
				<br>
				<p><?=$error?></p>
				<div class="statusButtons">
					<input name="userfile" type="file" name="Upload Picture">
					<input type="submit" value="Post Status">
					<input type="submit" value="Cancel">
				</div>
			</form>		
		</div>
	</div>
	<script type = "text/javascript" src="newfeedpost-events.js"></script>

</body>
</html>