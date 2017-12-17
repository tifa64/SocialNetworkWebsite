
var conn = new WebSocket('ws://localhost:9000');

// Called on establishing the connection
conn.onopen = function(e) {
	console.log('Connected Established!');
	var userdata = {
		id: user_id, // Should be set to the id of the sending user
		msg_type: 'initialization'
	}
	conn.send(JSON.stringify(userdata));
};


// Called when this client receives a message
conn.onmessage = function(e) {
	console.log(e.data);
	console.log(JSON.parse(e.data));
	var data = JSON.parse(e.data);
	var modal = document.getElementById('myModal');
	modal.style.display = "block";

	// THIS IS ADDED FOR TESTING PURPOSES AND SHOULD BE REMOVED
	if(data["msg_type"] === "friend_request_notification")
		$('.modal-content').html('<h1><a class="link" href="https://localhost:8000/social-network/users/' + data["sender_id"] + '">' + data["sender_name"] + '</a> sent you a friend request</h1>');
	else if(data['msg_type'] === "like_notification")
		$('.modal-content').html('<h1><a class="link" href="https://localhost:8000/social-network/users/' + data["sender_id"] + '">' + data["sender_name"] + '</a> has liked your post </h1>');
	//////////////////////////////////////////////////////////


	//console.log(JSON.parse(e));
};

// Called whenever an error occurrs
conn.onerror = function(e) {
	console.log("An error has occurred");
	console.log(e);
};

$(document).ready(function() {
	// Use conn.send whenever you need to send data i.e. added a new user or liked someone's post
	// conn.send(JSON.stringify({whatever parameters you want}))
	
	var ret = $.get('notification.html', function(data) {
		console.log(data);
		$("body").prepend(data);
	});

	var modal = document.getElementById('myModal');


	$(window).click(function(e) { 
		var modal = document.getElementById('myModal');
		if(e.target == modal) {
			modal.style.display = "none";
		}
	});

	$(document).keydown(function(e) {
	    let key = e.which;
	    if(key == 27)
    	{
    		modal = document.getElementById('myModal');
			modal.style.display = "none";
    	}
	    
	});

	// ONLY USED FOR TESTING PURPOSES, SHOULD BE REMOVED
	$("#search-form").submit(function(e) {
		e.preventDefault();
		var message_content = document.getElementById('search-query').value;
		console.log(message_content);
		var data = {
			id: user_id,
			content: message_content,
			msg_type: 'friend_request_notification',
			full_name: user_full_name,
			recepient_id: 1
		};
		conn.send(JSON.stringify(data));
	});


	$("#add_friend_test").click(function(e) {
		var message_content = document.getElementById('search-query').value;
		var data = {
			id: user_id,
			content: message_content,
			msg_type: 'friend_request_notification',
			full_name: user_full_name,
			recepient_id: parseInt(message_content)
		};

		conn.send(JSON.stringify(data));
	});

	$("#like_test").click(function(e) {
		var message_content = document.getElementById('search-query').value;
		var data = {
			id: user_id,
			content: message_content,
			msg_type: 'like_notification',
			full_name: user_full_name,
			recepient_id: parseInt(message_content)
		};
		conn.send(JSON.stringify(data));
	});
	///////////////////////////////////////////////////////////



	// ADD YOUR CODE HERE
	// E.G Capture the "add_friend" event and call conn.send with the required parameters




});