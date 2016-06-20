<?php
include_once ("config.php");

session_start();
if (!isset($_SESSION["user_id"])) {
	header("Location: login.php");
	exit();
}else{
	$status_id = $_GET["status"];

	$page_count = $_GET["c"];

	$first_name = $_SESSION["first_name"];
	$last_name = $_SESSION["last_name"];

	$db = mysqli_connect(DB_HOST_NAME, DB_USER, DB_PASS, DB_NAME);
	if (!$db) {
		exit ("Error - Could not connect to MySQL");
	}

	$q = "SELECT status_id, u_id, first_name, last_name, picture_path , picture_name, post_status, time_stamp FROM Status where status_id='$status_id';";
	$result = mysqli_query($db, $q);
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="mystyle.css">
	<title>MESH View comments</title>
	<script type = "text/javascript" src="image-comment-functions.js"></script>
</head>
<body>
	<div class="bodyWidth">
		<h1>MESH <small>View. Comments.</small></h1>
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
				<?php  
				if ($row = mysqli_fetch_assoc($result)){
					$q_commments = "SELECT u_id,s_id,first_name, last_name, picture_path, picture_name, post_comment, time_stamp FROM Comments where s_id='$status_id' ORDER BY time_stamp ASC;";
					$result_comments = mysqli_query($db, $q_commments);
					?>
					<li> 
						<div class="newsFeedPost">
							<div class="imageResizePost">
								<img src="<?=$row["picture_path"]?><?=$row["picture_name"]?>" alt="image" width="90px" height="80px">
							</div>
							<div class="newPostPerson">
								<h4><?=$row["first_name"]?> <?=$row["last_name"]?><small> <?=$row["time_stamp"]?></small></h4>
								<div class="newsFeedComment"><p><?=$row["post_status"]?></p></div>
								<div class="replyandshare"><a href="commentnewsfeedpost.php?status=<?=$status_id?>&c=<?=$page_count?>">Reply</a> <a class="spaceAdj"><?=mysqli_num_rows($result_comments)?> Comment(s)</a>
								</div>		
								<ul class="CommentList">
									<?php
									while (($row_comments = mysqli_fetch_assoc($result_comments))) {
										?>	
										<li>
											<div class="imageResizeComment">
												<img src="<?=$row_comments["picture_path"]?><?=$row_comments["picture_name"]?>" alt="image" width="40px" height="40px">
											</div>
											<div class="newsFeedComments">
												<h4><?=$row_comments["first_name"]?> <?=$row_comments["last_name"]?><small><?=$row_comments["time_stamp"]?></small></h4>
												<div class="newsFeedComment"><p><?=$row_comments["post_comment"]?></p></div>
											</div>
										</li>
										<?php  
									}	
									?>
								</ul> 
							</div>
						</div>
					</li>
					<?php
				}
				?>
			</ul>
		</div>
	</div>
	<script type = "text/javascript" src="image-comment-events.js"></script>
</body>
</html>