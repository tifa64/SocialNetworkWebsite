$(document).ready(function() {
	
	$("#search-form").submit(function(e) {
		e.preventDefault();

		var query = $("#search-query").value;

		$.ajax({
			url: 'search.php',
			type: 'POST',
			data: {query: query},
			success: function(response) {
				console.log(response);
				//var json = $.parseJSON(response);
				//console.log(json);
			},
			error: function(data) {
				var json = $.parseJSON(data);
       			alert(json.error);
			}
		});

	});
	var i = 0;
	$("#search-query").keyup(function() {
		var query = document.getElementById('search-query').value;
		if(query === '')
			return;
		console.log(query);

		$.ajax({
			url: 'search.php',
			type: 'POST',
			data: {query: query},
			success: function(response) {
				// json[0]['user_fname'/'user_lname'][]
				//console.log(response);	
				var json = $.parseJSON(response);
				var keys = Object.keys(json);
				console.log(json);
				for(key in keys) {
					console.log('!');
					console.log(json[key]);
					keys_2 = Object.keys(json[key]);
					console.log('@');
					for(key2 in keys_2) {
						console.log('user_id' + json[key][keys_2[0]][1]['user_id']);
					}
				}
				//console.log(Object.keys(json).length);
				//console.log(json[0]);
				//console.log(json[1]['posts'][0]);
				//console.log(json[0]);
				//console.log(json[0]['users_fname'][0]);
				//console.log(json[0]['posts']);
			},
			error: function(data) {
				var json = $.parseJSON(data);
       			alert(json.error);
			}
		});
	});

});