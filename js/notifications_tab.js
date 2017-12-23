function createLikeNotificationEntry(notification){
	var element = '<div class="notification_entry"><img class ="profile_picture" src="';
	element += notification['sender_image_url'] + '" width=30 height=30>';
	element += '<h3>' + notification["sender_username"];
	if(notification['notification_type'] == 'friend_request_notification')
		element += ' <span>sent you a friend request</span></h3>';
	else			
		element += ' <span>liked your post</span></h3>';
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
		//console.log(element);
		$("body").append(element);
	}
}

function getNotificationsCount(json) {
	var keys = Object.keys(json);
	var count = 0;
	for(key in keys) {
		if(json[key]['seen'] == 0) {
			count++;
		}
	}
	console.log("New notifications = " + count);
	return count;
}

function updateNotificationsCount(json) {
	console.log(json);
	var count = getNotificationsCount(json)

	console.log("updateNotificationsCount: " + count);
	$("#notifications-count").html(count);
	if(count == 0) {
		document.getElementById("notifications-count").style.display = "none";
	} else {
		document.getElementById("notifications-count").style.display = "block";
	}
}

$(document).ready(function(){

	$.ajax({
		url: 'getNotifications.php',
		type: 'POST',
		success: function(response) {
			var json = JSON.parse(response);
			if(typeof displayNotifications === "function") {
				displayNotifications(json);
			}
		}
	});
});