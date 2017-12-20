function createLikeNotificationEntry(notification){
	var element = '<div class="notification_entry"><img class ="profile_picture" src="';
	element += notification['sender_image_url'] + '" width=30 height=30>';
	element += '<h3>' + notification["sender_username"] + ' <span>liked your post</span></h3>';
	element += '</div>';

	return element;
}

function displayNotifications(json) {
	var keys = Object.keys(json);
	for(key in keys) {
		var element = createLikeNotificationEntry(json[key]);
		console.log(element);
		$("body").append(element);

	}
}


$(document).ready(function(){
	$.ajax({
		url: 'getNotifications.php',
		type: 'POST',
		data: {userid: user_id},
		success: function(response) {
			console.log(response);
			var json = JSON.parse(response);
			displayNotifications(json);
		}
	});


});