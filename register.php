<?php
include_once ("config.php");
$error="";
if (isset($_POST["submitted"]) && $_POST["submitted"]){
	
	//grab all the variables
	$firstname = $_POST["firstname"];
	$lastname = $_POST["lastname"];
	$password = $_POST["password"];
	$confirmPassword = $_POST["confirmPassword"];
	$email = $_POST["email"];
	$confirmEmail = $_POST["confirmEmail"];
	$gender = $_POST["gender"];
	$birthday = $_POST["birthday"];

	//open the database connection
	$db = mysqli_connect(DB_HOST_NAME, DB_USER, DB_PASS, DB_NAME);
	
	if (!$db) {
		exit ("Error - Could not connect to MySQL");
	}

	$q = "INSERT INTO Users (first_name, last_name, password, confirm_password, email, confirm_email, gender, birthdate)
	VALUES ('$firstname', '$lastname', '$password', '$confirmPassword', '$email', '$confirmEmail', '$gender', '$birthday');";

	$result = mysqli_query($db, $q);

	if($result){
		header('Location: login.php');
		mysqli_free_result($result);
		mysqli_close($db);
		exit();
	}else{
		$error = ("Was unable to create the user.");
		mysqli_free_result($result);
		mysqli_close($db);
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" type="text/css" href="mystyle.css">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Register for MESH</title>
<script type = "text/javascript" src="signup-functions.js"></script>
</head>
<body>

<div class="bodyWidth">
	<h1>MESH <small>Register.</small></h1>
	<hr>
</div>

<div class="bodyWidth">
	<div class="bodyMain">
			<form id="registrationClass" class="registrationClass" action="register.php" method="post">
				
			<input type="hidden" name="submitted" value="1"/>

				<!-- registration information required -- Form fields -->

				<div class="textBox">First Name:</div>
				<div class="inputBox"><input type="text" name="firstname" id="firstname" ></div>
				<div class="textBox">Last Name:</div>
				<div class="inputBox"><input type="text" name="lastname" id="lastname" ></div>
				
				<br>
				
				<div class="textBox">Password:</div>
				<div class="inputBox"><input type="password" name="password" id="password" ></div>
				<div class="textBox">Confirm Password:</div>
				<div class="inputBox"><input type="password" name="confirmPassword" id="confirmPassword"></div>
				
				<br>
				<div class="textBox">Email:</div>
				<div class="inputBox"><input type="text" name="email" id="email" ></div>
				<div class="textBox">Confirm Email:</div>
				<div class="inputBox"><input type="text" name="confirmEmail" id="confirmEmail"></div>
				
				<br>
				<div class="textBox">Gender:</div>
				<div class="inputBox">
					Male<input type="radio" value="Male" name="gender" checked="checked">
					Female<input type="radio" value="female" name="gender">	
				</div>
				
				<div class="textBox">Birthdate:</div>
				<div class="inputBox"><input type="text" name ="birthday" id="birthday"></div>
				
				<div class="buttonBoxRegister">
					<input type="submit" value="Reset Field(s)" name="reset"> <input type="submit" value="Register" name="register">
				</div>

			<div class="error_bottom">
				<p>
					<span><?=$error?></span>
					<span class="error" id="firstname_error">Invalid firstname (check for spaces)</span>
					<span class="error" id="lastname_error">Invalid lastname (check for spaces)</span>
					<span class="error" id="password_error">Invalid Password (check length > 8/special character)</span>
					<span class="error" id="confirmPassword_error">Invalid confirm password (check length > 8/special character)</span>
					<span class="error" id="passwordmatch_error">Passwords do not match</span>
					<span class="error" id="email_error">Email format incorrect</span>
					<span class="error" id="confirmEmail_error">Confirmed Email format incorrect</span>
					<span class="error" id="emailmatch_error">Emails do not match</span>
					<span class="error" id="birthday_error">Birthday format incorrect (dd/mm/yyyy) or check if date is valid</span>
				</p>
			</div>
			</form>
	</div>
	
</div>
<script type = "text/javascript" src="signup-events.js"></script>

</body>
</html>