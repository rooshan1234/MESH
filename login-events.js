var theForm = document.getElementById("loginClass");

var theUserName = document.getElementById("username");
var thePassword = document.getElementById("password");
var theRegisterButton = document.getElementById("Register");


theUserName.addEventListener("blur",username_event,false);
thePassword.addEventListener("blur",password_event,false);

theRegisterButton.addEventListener("click",function (){var URL='register.php'; redirectToURL(URL);}, false);

theForm.onsubmit = submitForm;

//theForm.addEventListener("sumbit",submitForm,false);
