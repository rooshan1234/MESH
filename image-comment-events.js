var dislikeiconcomments = document.getElementById("dislike_icon_comments");
var likeiconcomments = document.getElementById("like_icon_comments");

dislikeiconcomments.addEventListener("click",function(){changeIcon(likeiconcomments,dislikeiconcomments);},false);
likeiconcomments.addEventListener("click",function(){changeIcon(likeiconcomments,dislikeiconcomments);},false);