
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
	$('.modal-content').append('<h1><a class="link" href="https://localhost:8000/social-network/users/' + data["sender_id"] + '">' + data["sender_name"] + '</a> sent you a friend request</h1>');
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
		if(e.target == modal) {
			modal.style.display = "none";
		}
	});

	$(document).keydown(function(e) {
		//Check first if a textbox is in focus
	    let key = e.which;
	    if(key == 27)
    	{
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
			msg_type: 'notification',
			full_name: user_full_name,
			recepient_id: 135312
		};
		conn.send(JSON.stringify(data));
	});
	///////////////////////////////////////////////////////////



	// ADD YOUR CODE HERE
	// E.G Capture the "add_friend" event and call conn.send with the required parameters




});