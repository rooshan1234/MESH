
<?php
/*
	- optimize sql query for number of rows
*/
include_once ("config.php");

session_start();

$page_count = 0;

$page_count = $_GET["c"] + $page_count;

if (!isset($_SESSION["user_id"])) {
	header("Location: login.php");
	exit();
}else{
	
	$user_id = $_SESSION["user_id"];
	$first_name = $_SESSION["first_name"];
	$last_name = $_SESSION["last_name"];

	$db = mysqli_connect(DB_HOST_NAME, DB_USER, DB_PASS, DB_NAME);
	if (!$db) {
		exit ("Error - Could not connect to MySQL");
	}

	$q = "SELECT status_id, u_id, first_name, last_name, picture_path , picture_name, post_status, time_stamp FROM Status ORDER BY time_stamp DESC LIMIT ".$page_count.", 10;";
	$result = mysqli_query($db, $q);
}
?>

<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="mystyle.css">
	<title>MESH NewsFeed</title>
	<script type = "text/javascript" src="image-functions.js"></script>
</head>
<body>
	<div class="bodyWidth">
		<h1>MESH <small>Newsfeed.</small></h1>
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
				while ($row = mysqli_fetch_assoc($result)) {				
					$count_comments = 0;
					
					$q_commments = "SELECT u_id,s_id,first_name, last_name, picture_path, picture_name, post_comment, time_stamp FROM Comments where s_id=".$row["status_id"]." ORDER BY time_stamp ASC;";
					
					$result_comments = mysqli_query($db, $q_commments);
					
					$q_likes = "SELECT like_or_dislike FROM Likes where u_id=$user_id AND s_id= ".$row["status_id"]." ";
					
					$result_likes = mysqli_query($db, $q_likes);
					
					$row_likes = mysqli_fetch_assoc($result_likes);

					$q_total_likes = "SELECT * FROM Likes where like_or_dislike='like' AND s_id= ".$row["status_id"]."";

					$q_result_total =  mysqli_query($db, $q_total_likes);

					//echo mysqli_num_rows($q_result_total);
					//echo $row_likes["like_or_dislike"];
				?>
					<li> 
						<div class="newsFeedPost">
							<div class="imageResizePost">

								<img src="<?php echo $row["picture_path"]?><?php echo $row["picture_name"]?>" alt="image" width="90px" height="80px">

							</div>
							<div class="newPostPerson">
								<h4><?php echo $row["first_name"]?> <?php echo $row["last_name"]?><small> <?php echo $row["time_stamp"]?></small></h4>

								<div class="newsFeedComment"><p><?php echo$row["post_status"]?></p></div>

								<div class="replyandshare"><a href="commentnewsfeedpost.php?status=<?php echo$row["status_id"]?>&c=<?php echo $page_count?>">Reply</a> <a class="spaceAdj" href="comments.php?status=<?php echo $row["status_id"]?>&c=<?php echo $page_count?>"> <p style="display:inline"id="comments_<?php echo $row["status_id"]?>"><?php echo mysqli_num_rows($result_comments)?> Comment(s)</p></a>

									<p id="likes_<?php echo $row["status_id"]?>" name="test" style="display:inline"> <?php echo mysqli_num_rows($q_result_total)?> likes</p>
									<img id="dislike_icon_<?php echo $row["status_id"]?>_<?php echo $user_id?>" class="dislike" src="<?php echo $row_likes["like_or_dislike"]==""?"dislike":$row_likes["like_or_dislike"]?>.png" align="right" alt="image">
									
								</div>
								<ul class="CommentList">
									<?php
										while (($row_comments = mysqli_fetch_assoc($result_comments)) && $count_comments<3) {
											$count_comments++;
									?>	
										<li>
											<div class="imageResizeComment">
												<img src="<?php echo $row_comments["picture_path"]?><?php echo $row_comments["picture_name"]?>" alt="image" width="40px" height="40px">
											</div>

											<div class="newsFeedComments">
												<h4><?php echo $row_comments["first_name"]?> <?php echo $row_comments["last_name"]?><small> <?php echo $row_comments["time_stamp"]?></small></h4>
												<div class="newsFeedComment"><p><?php echo $row_comments["post_comment"]?></p></div>
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

				<p style="text-align:right"><a href="feed.php?c=<?php echo $page_count>0? $page_count-10: $page_count=0?>">Previous 10</a> <a href="feed.php?c=<?php echo mysqli_num_rows($result)>=10 ?$page_count+10 : $page_count=$page_count ?>">Next 10</a></p>
			</div>

		</div>
		<script type = "text/javascript" src="image-events.js"></script>
	</body>
	</html>