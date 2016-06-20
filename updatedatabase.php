<?php
include_once ("config.php");

	//get variables
	$status_id = $_GET["status_id"];
	$status_likeordislike = $_GET["status_likeordislike"];
	$user_id = $_GET["user_id"];

	//echo $status_id;
	//echo $status_likeordislike;
	//echo $user_id;

	$db = mysqli_connect(DB_HOST_NAME, DB_USER, DB_PASS, DB_NAME);
	if (!$db) {
		exit ("Error - Could not connect to MySQL");
	}

	$q = "SELECT u_id, s_id FROM Likes where u_id=$user_id AND s_id=$status_id";

	$result = mysqli_query($db, $q);

	if (!$result){
		//echo "Query was unsuccusful";
	}else{
		//echo mysqli_num_rows($result);

		if (mysqli_num_rows($result) == 0){
			//echo "fire 1";
			$q = "INSERT INTO Likes(u_id, s_id, like_or_dislike) VALUES ($user_id,$status_id,'$status_likeordislike')";
		}else {
			//echo "fire 2";
			$q = "UPDATE Likes SET like_or_dislike='$status_likeordislike' WHERE u_id=$user_id AND s_id=$status_id";
		}
		$result = mysqli_query($db, $q);
		if (!$result){
			//echo "Query was unsuccusful(2)";
		}else{
			//echo "Query was good (2)";
		}
		//echo "Query was good";
	}

	$q = "SELECT u_id, s_id FROM Likes where s_id=$status_id AND like_or_dislike='like'";
	$result = mysqli_query($db, $q);


	print (mysqli_num_rows($result));



	mysqli_close($db);

?>