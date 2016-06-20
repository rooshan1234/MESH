var textarea = document.getElementById("status");

textarea.addEventListener("keypress",countCharacters,false);
textarea.addEventListener("keyup",clearCharacters,false);