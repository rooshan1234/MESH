var MAX_LENGTH = 1000;

function countCharacters (event)
{

	var characters = document.getElementById("charactersNewspost");
	
	var textArea = event.currentTarget;
	
	var textAreaLength = textArea.value.length;
	
	if (MAX_LENGTH > textAreaLength){
			characters.innerHTML = (MAX_LENGTH - textAreaLength) + " characters remaining";
			return true;
	}else
	{
		characters.innerHTML = "You have exceeded the total number of max characters";
		return false;
	}

}
function clearCharacters(event)
{
	var textArea = event.currentTarget;
	var textAreaLength = textArea.value.length;
	var characters = document.getElementById("charactersNewspost");
	
	if ((MAX_LENGTH - textAreaLength) == MAX_LENGTH)
	{
		characters.innerHTML = MAX_LENGTH + " characters remaining";
	}
}