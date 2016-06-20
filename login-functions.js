/***************************Hiding and showing error functions********************************/
function show_error (error){
	document.getElementById(error).style.display = "block";
}
function hide_error (error){
	document.getElementById(error).style.display = "none";
}
/***************************END ERROR FUNCTIONS***********************************************/

/***************************Required checking functions**************************************/
function check_username (target){
 	var regex_match_position = target.value.search(
	   /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/);
 	return (regex_match_position!=0);
}
function check_password (target){
	var regex_match_position = target.value.search(/\W+/i);
	return (target.value.length < 8 || 
	 	regex_match_position==-1 || !target.value.trim() ||
	 		target==null || target.value== "");
}
/***************************END CHECK FUNCTIONS**************************************/

function username_event(event)
{
	 var username = event.currentTarget;
	 
	 var error = username.id + "_error";
	 
	 if (check_username(username)) {
		show_error(error);
	  }else{
	  	hide_error(error);
	  }
}
function password_event(event)
{
	 var password = event.currentTarget;	 
	 
	 var error = password.id + "_error";

	 if (check_password(password)){
	 	show_error(error);
	 }else{
	 	hide_error(error);
	 }
}
function submitForm()
{
	var username = document.getElementById("username");
	var password = document.getElementById("password");

	var error;

	if(check_username(username)){
		error = username.name + "_error";
		show_error(error);
	}

	if (check_password(password)){
		error = password.name + "_error";
		show_error(error);
	}

	return (!check_username(username) && !check_password(password));
}
function redirectToURL (URL)
{
	 window.location.href = URL;
}