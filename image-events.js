
var dislike = document.getElementsByClassName("dislike");
var time_comments_likes = setInterval(get_likes_comments, 30000);




for (i in dislike){
	var x = document.getElementById(dislike[i].id);
	if (x!=null){
		x.addEventListener("click",change_icon,false);
	}

}



