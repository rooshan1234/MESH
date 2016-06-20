<?php
include_once ("config.php");

	if (isset($_POST["submitted"]) && $_POST["submitted"]) {
		
		// get the username and password and check that they aren't empty
		$username = trim($_POST["username"]);
		$password = trim($_POST["password"]);

		if (strlen($username) > 0 && strlen($password) > 0) {
			// load the database and verify the username/password
			$db = mysqli_connect(DB_HOST_NAME, DB_USER, DB_PASS, DB_NAME);
			if (!$db) {
		     exit ("Error - Could not connect to MySQL");
		  }
		
			$q = "SELECT user_id, first_name, last_name FROM Users 
					WHERE email = '$username' AND password = '$password';";

			$result = mysqli_query($db, $q);
			
			if ($row = mysqli_fetch_assoc($result)) {
				// login successful
				session_start();

				$_SESSION["user_id"] = $row["user_id"];
				$_SESSION["first_name"] = $row["first_name"];
				$_SESSION["last_name"] = $row["last_name"];

				header("Location: feed.php?c=0");

				mysqli_free_result($result);
				
				mysqli_close($db);
				
				exit();

			} else {
				// login unsuccessful
				$error = ("The username/password combination was incorrect.");
				mysqli_free_result($result);
				mysqli_close($db);
			}
		} else {
			$error = ("You must enter a non-blank username/password combination to login.");
		}
	} else {
		$error = "";
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="mystyle.css">
	<script type = "text/javascript" src="login-functions.js"></script>
	<title>Welcome to MESH</title>
</head>

<body>
<div class="bodyWidth">
	<h1>MESH <small>Discover. Explore. Connect.</small></h1>
	<hr>
</div>

<div class="bodyWidth">
	<div class="bodyMain">
			<form id="formClass" class="formClass" action="login.php" method="post">
				<input type="hidden" name="submitted" value="1"/>
				<div class="textBox">Username:</div>
				<div class="inputBox"><input type="text" name="username" id="username" ></div>
				<br>
				<div class="textBox">Password:</div>
				<div class="inputBox"><input type="password" name="password" id="password"></div>
				<br>
				<div class="buttonBox">
				<input type="submit" value="Register" id="Register">
				<input type="submit" value="Login">
				</div>
				<div class="error_bottom">
					<p>	
						<span><?=$error?></span>
						<span class="error" id="username_error">Invalid Username (check format)</span>
						<span class="error" id="password_error">Invalid Password (check length > 8/special character)</span>
					</p>
			</div>
			</form>
	</div>
</div>
<script type = "text/javascript" src="login-events.js"></script>
</body>
</html>