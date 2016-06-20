function changeIcon(likeicon,dislikeicon)
{
	 if (dislikeicon.style.display != "none")
	 {
		 dislikeicon.style.display = "none";
		 likeicon.style.display = "block";
	 }else
	 {
		 dislikeicon.style.display = "block";
		 likeicon.style.display = "none"; 
	 }
}