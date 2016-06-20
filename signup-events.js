var theForm = document.getElementById("formClass");

var theFirstName = document.getElementById("firstname");
theFirstName.addEventListener("blur",space_event,false);

var theLastName = document.getElementById("lastname");
theLastName.addEventListener("blur",space_event,false);

var password = document.getElementById("password");
var confirmPassword = document.getElementById("confirmPassword");

password.addEventListener("blur",password_event,false);
password.addEventListener("blur",function(){match_event(password,confirmPassword,"password");},false);

confirmPassword.addEventListener("blur",password_event,false);
confirmPassword.addEventListener("blur",function(){match_event(password,confirmPassword,"password");},false);

var email = document.getElementById("email");
var confirmEmail = document.getElementById("confirmEmail");

email.addEventListener("blur",username_event,false);
email.addEventListener("blur",function(){match_event(email,confirmEmail,"email");},false);

confirmEmail.addEventListener("blur",username_event,false);
confirmEmail.addEventListener("blur",function(){match_event(email,confirmEmail,"email");},false);

var birthday = document.getElementById("birthday");
birthday.addEventListener("blur",birthday_event,false);

//testing purposes
theForm.onsubmit = submit_form;
