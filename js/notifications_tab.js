function createLikeNotificationEntry(notification){
	var element = '<div class="notification_entry"><img class ="profile_picture" src="';
	element += notification['sender_image_url'] + '" width=30 height=30>';
	element += '<h3>' + notification["sender_username"] + ' <span>liked your post</span></h3>';
	element += '</div>';

	return element;
}

function displayNotifications(json) {
	var myNode = document.getElementsByTagName("body");
	while (myNode.firstChild) {
    	myNode.removeChild(myNode.firstChild);
    	console.log("remocing");
	}
	var keys = Object.keys(json);
	for(key in keys) {
		var element = createLikeNotificationEntry(json[key]);
		console.log(element);
		$("body").append(element);
	}
}

function updateNotificationsCount(count) {
	$("#notifications-count").html(count);
	if(count == 0) {
		document.getElementById("notifications-count").style.display = "none";
	} else {
		document.getElementById("notifications-count").style.display = "block";
	}
}

$(document).ready(function(){
	$.ajax({
		url: 'index.php',
		type: 'POST',
		data: {action: 'clear_notifications', userid: user_id},
		success: function(response) {
			console.log(response);
		}
	})
	console.log("notification_tab");
	updateNotificationsCount(0);
});