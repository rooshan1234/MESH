function change_icon(event)
{
	var event_icon = event.currentTarget;
	
	var status_id = event_icon.id;
	var src = event_icon.src;
	

	//alert(status_id.split('_'));
	var split_status_id = status_id.split('_'); 
	
	var get_status_id = split_status_id[2];

	var get_user_id = split_status_id[3];
	//alert(get_status_id);
	//alert(get_user_id);
	//var get_last_underscore = status_id.lastIndexOf("_");
	//var get_status_id = status_id.substr(get_last_underscore+1, status_id.length);
	//alert (get_status_id);

	var get_occurance_slash = src.lastIndexOf("/");
	
	var get_src_name = src.substr (get_occurance_slash+1, src.length);
	
	alert (get_src_name);

	if (get_src_name == "dislike.png"){
		event_icon.src = "like.png";
		ajax_update(get_status_id, "like", get_user_id);
	}else{
		event_icon.src = "dislike.png";
		ajax_update(get_status_id, "dislike", get_user_id);
	}	
}
function get_likes_comments(){
	var xhr =  new XMLHttpRequest();

	xhr.onreadystatechange = function () {

		if(xhr.readyState == 4 && xhr.status==200){
			var responseObj = JSON.parse(xhr.responseText);
			
			for (var i = 0; i < responseObj.counts.status_id.length; i++){
				// comments
				var get_comment_key = "comments_" + responseObj.counts.status_id[i];
				var get_comment_id = document.getElementById(get_comment_key);
				if (get_comment_id){
					//include check to see if updating is even needed?
					//alert (get_comment_id);
					get_comment_id.innerHTML = responseObj.counts.total_comments[i] + " Comment(s)";
				}

				//likes
				
				var get_like_key = "likes_" + responseObj.counts.status_id[i];
				var get_like_id = document.getElementById(get_like_key);
				if (get_like_id){
					get_like_id.innerHTML = responseObj.counts.total_likes[i] + " likes";
				}

			}	


			//alert (responseObj.counts.status_id.length);

			//get_like_button.innerHTML = result + " likes";
			//alert (get_like_button);

		}
	}

	xhr.open("GET", "getlikeandcomments.php");
	xhr.send();
}
function ajax_update (status_id, like_or_dislike, user_id){
	//open ajax request
	//pass to php script
	//php script updates stuff in database
	//once its updated, update no count because this is the main status
	
	//alert ("updatedatabase.php?status_id=" + status_id + "&status_likeordislike=" + like_or_dislike);

	var get_like_button = document.getElementById("likes_" + status_id);

	var xhr =  new XMLHttpRequest();
	
	//alert(status_id + "_" + user_id);
	
	xhr.onreadystatechange = function () {
		var result = xhr.responseText;

		if(xhr.readyState == 4 && xhr.status==200){
			var result = xhr.responseText;
			alert(result);
			//alert ("it ran!");
			get_like_button.innerHTML = result + " likes";
			//alert (get_like_button);

		}
	}
	xhr.open("GET", "updatedatabase.php?status_id=" + status_id + "&status_likeordislike=" + like_or_dislike + "&user_id=" + user_id);
	alert ("updatedatabase.php?status_id=" + status_id + "&status_likeordislike=" + like_or_dislike + "&user_id=" + user_id);
	xhr.send(null);
}