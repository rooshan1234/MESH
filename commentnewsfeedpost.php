<?php
include_once ("config.php");
$error="";


session_start();
if (!isset($_SESSION["user_id"])) {
	header("Location: login.php");
	exit();
}else{
	$status_id = $_GET["status"];
	$page_count = $_GET["c"];


	$user_id = $_SESSION["user_id"];
	$first_name = $_SESSION["first_name"];
	$last_name = $_SESSION["last_name"];


	$db = mysqli_connect(DB_HOST_NAME, DB_USER, DB_PASS, DB_NAME);
	
	if (!$db) {
		exit ("Error - Could not connect to MySQL");
	}

	$q = "SELECT status_id,first_name, last_name, post_status, time_stamp FROM Status where status_id='$status_id';";

	$result_info = mysqli_query($db, $q);

	$row_comments_info = mysqli_fetch_assoc($result_info);

	if (isset($_POST["submitted"]) && $_POST["submitted"]){
		
		$uploaddir = "uploads/";
		
		$temp = explode(".", $_FILES['userfile_comment']['name']);

		$extension = '.' . end($temp);

		$filename = basename($_FILES["userfile_comment"]["name"], $extension) . $user_id . $status_id;

		$filename = $filename . $extension;

		$file_to_upload = $uploaddir . $filename;

		$status_comment = trim($_POST["comment"]);

		if (strlen($status_comment) > 0){

			if ($_FILES['userfile_comment']['name']){
				if (move_uploaded_file($_FILES['userfile_comment']['tmp_name'], $file_to_upload))
				{
					$error="File is valid, and was successfully uploaded.\n";
				}else {
					$error= "Unable to upload file.\n";
				}
			}else{
				$filename ="";
				$uploaddir = "";

			}
			
			$q = "INSERT INTO Comments(u_id, s_id ,first_name, last_name, picture_path, picture_name ,post_comment, time_stamp) VALUES (
				'$user_id', $status_id, '$first_name', '$last_name', '$uploaddir', '$filename' ,'$status_comment', NOW());";

$result = mysqli_query($db, $q);


if ($result){
	
	header('Location: feed.php?c='.$page_count);
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
	<title>MESH Post - Comment</title>
	<script type = "text/javascript" src="comment-functions.js"></script>
</head>
<body>
	<div class="bodyWidth">
		<h1>MESH <small>Post. Comment.</small></h1>
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
		<div class="newsfeed">
			<ul class="postList">
				<li> 
					<div class="newsFeedPost">
						<div class="imageResizePost">
							<img src="imageholder-comment.gif" alt="image">
						</div>
						<div class="newPostPerson">
							<h4><?=$row_comments_info["first_name"]?> <?=$row_comments_info["last_name"]?> <small><?=$row_comments_info["time_stamp"]?></small></h4>
							<div class="newsFeedComment"><p><?=$row_comments_info["post_status"]?></p></div> 
						</div>
					</div>
				</li>
			</ul>
		</div>
		<div class="commentContainerPost">
			<form class="commentboxandbuttonsPost" action="commentnewsfeedpost.php?status=<?=$status_id?>&c=<?=$page_count?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="submitted" value="1"/>
				<textarea name="comment" id="comment" ROWS="100" COLS="100"></textarea>		
				<p id="charactersRemaining">1000 characters remaining</p>
				<div class="statusButtons">
					<input name="userfile_comment" type="file" name="Upload Picture">
					<input type="submit" value="Post Status">
					<input type="submit" value="Cancel">
				</div>
			</form>

		</div>
	</div>
	<script type = "text/javascript" src="comment-events.js"></script>
</body>
</html>