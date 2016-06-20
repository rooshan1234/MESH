<?php
include_once ("config.php");

	$db = mysqli_connect(DB_HOST_NAME, DB_USER, DB_PASS, DB_NAME);
	if (!$db) {
		exit ("Error - Could not connect to MySQL");
	}
	
	$q = "SELECT status_id FROM Status";
	
	$result = mysqli_query($db, $q);

	$json = array("counts" => array());

	while ($row = mysqli_fetch_assoc($result)){
		//echo $row["status_id"];
		//comment count
		
		$q = "SELECT * FROM Comments WHERE s_id=".$row["status_id"]."";
		$result_total_comments = mysqli_query($db, $q);
		$row_total_comments = mysqli_num_rows($result_total_comments);
		
		//like count
		$q = "SELECT * FROM Likes WHERE like_or_dislike='like' AND s_id=".$row["status_id"]."";
		$result_total_likes = mysqli_query($db, $q);
		$row_total_likes = mysqli_num_rows($result_total_likes);

		$json["counts"]["status_id"][] = $row["status_id"];
		$json["counts"]["total_comments"][] = $row_total_comments;
		$json["counts"]["total_likes"][] = $row_total_likes;

		//echo "status id: " . $row["status_id"] . "comment_total:" .$row_total_comments . "likes_total:" . $row_total_likes;
	}
	print json_encode($json);

	mysqli_close($db);

?>