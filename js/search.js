$(document).ready(function() {
	
	$("#search-form").submit(function(e) {
		e.preventDefault();

		var query = $("#search-query").val();

		$.ajax({
			url: 'search.php',
			type: 'POST',
			data: {query: query},
			success: function(response) {
				console.log(response);
				var json = $.parseJSON(response);
				console.log(json);
			},
			error: function(data) {
				var json = $.parseJSON(data);
       			alert(json.error);
			}
		});

	});

});