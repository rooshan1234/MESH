/*
current problems:

*/

/***************************Hiding and showing error functions********************************/
function show_error (error){
	document.getElementById(error).style.display = "block";
}
function hide_error (error){
	document.getElementById(error).style.display = "none";
}
/***************************END ERROR FUNCTIONS***********************************************/


/***************************Required checking functions**************************************/
function check_spaces(target){
	var regex_match_position = target.value.search(/^\S+$/);
	return (regex_match_position!=0 || !target.value.trim() || target==null || target.value== "");
}
function check_password (target){
	var regex_match_position = target.value.search(/\W+/i);
	return (target.value.length < 8 || 
	 	regex_match_position==-1 || !target.value.trim() ||
	 		target==null || target.value== "");
}
function check_username (target){
 	var regex_match_position = target.value.search(
	   /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/);
 	return (regex_match_position!=0);
}
function check_match(x, y)
{  
	return (x.value!=y.value);
}
function check_birthday(target){
	
	var regex_match_position = target.value.search(/^\d{2}\/\d{2}\/\d{4}$/);

	var birthday_split = target.value.split(/\//g);
	var birthday_split_date = birthday_split[0];
	var birthday_split_month = birthday_split[1];
	var birthday_split_year = birthday_split[2];

	return(regex_match_position==-1 || birthday_split_date >=32 || birthday_split_month>=13 
			||(birthday_split_month==02 && birthday_split_date>=30) || 
					birthday_split_year<=1915 || birthday_split_year>=2016);
}
/***************************END CHECK FUNCTIONS**************************************/


/***************************Event functions*****************************************/
function space_event(event)
{
	 var name = event.currentTarget;

	 var error = name.id + "_error";
	 
	 if (check_spaces(name)){
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
function birthday_event(event)
{
	var birthday = event.currentTarget;

	var error = birthday.id + "_error";
	
	if (check_birthday(birthday)){
		show_error(error);
	}else{
		hide_error(error);
	}
}
function match_event(x, y, name)
{  
	var error = name + "match_error";
	
	if (check_match(x,y))
	{
		show_error(error);
	}else
	{
		hide_error(error);
	}
}
/***************************END EVENT FUNCTIONS**********************************/

function submit_form()
{
	var error;

	//checking if the names failed
	var theFirstName = document.getElementById("firstname");
	var theLastName = document.getElementById("lastname");
	
	if (check_spaces(theFirstName)){
		error = theFirstName.name + "_error";
		show_error(error);
	}
	if (check_spaces(theLastName)){
		error = theLastName.name + "_error";
		show_error(error);
	}

	//check if the passwords are failing
	var password = document.getElementById("password");
	var confirmPassword = document.getElementById("confirmPassword");

	if (check_password(password)){
		error = password.name + "_error";
		show_error(error);
	}
	if (check_password(confirmPassword)){
		error = confirmPassword.name + "_error";
		show_error(error);
	}

	//check if the email (username is failing)
	var email = document.getElementById("email");
	var confirmEmail = document.getElementById("confirmEmail");

	if (check_username(email)){
		error = email.name + "_error";
		show_error(error);
	}
	if (check_username(confirmEmail)){
		error = confirmEmail.name + "_error";
		show_error(error);
	}

	//check if birthday is correct
	var birthday = document.getElementById("birthday");

	if(check_birthday(birthday)){
		error = birthday.name + "_error";
		show_error(error);
	}

	//check if passwords match
	if(check_match(password, confirmPassword)){
		error = password.name + "match_error";
		show_error(error);
	}

	//check if emails match
	if (check_match(email,confirmEmail)){
		error = email.name + "match_error";
		show_error(error);
	}

	return (!check_spaces(theFirstName) && !check_spaces(theLastName) &&
			!check_password(password) && !check_password(confirmPassword) &&
			!check_username(email) && !check_username(confirmEmail) &&
			!check_match(password,confirmPassword) && !check_match(email,confirmEmail) &&
			!check_birthday(birthday));



}