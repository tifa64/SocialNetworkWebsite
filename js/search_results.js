var currentTab;

function updateContent(json) {
	var already_here = [];
	var keys = Object.keys(json);
	for(key in keys) {
		var x = json[key];
		if(currentTab === 'posts')
			$('#'+currentTab).append('<div> Name: ' + x['content'] + ' ' + x['post_id'] + ' ' + x['user_id'] + '</div>');
		else {
			if(already_here.indexOf(x['user_id']) == -1) {
				$('#'+currentTab).append('<div> Name: ' + x['fname'] + ' ' + x['lname'] + ' ' + x['user_id'] + '</div>');
				already_here.push(x['user_id']);
			}
		}
	}	
}


function emptyTabs() {
	$('#name').empty();
	$('#email').empty();
	$('#posts').empty();
	$('#hometown').empty();	
}

function changeTab(evt, tabName) {
    // Declare all variables
    var i, tabcontent, tablinks;
    var tabs = ['name', 'email', 'hometown', 'posts'];
    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    console.log(tabName);
    currentTab = tabName;
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}



$(document).ready(function(){
	currentTab = "name";
	document.getElementsByClassName("tabcontent")[0].style.display = "block";
	document.getElementById("tab1").style.display = "block";
	document.getElementById("tab1").className += " active";
	
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

	$(document).keyup(function(e) {

		var query = document.getElementById('search-query').value;
		if(e.which === 8) {
			if(query === '') {
				emptyTabs();
			}
		}
	});

	var i = 0;
	$("#search-query").keyup(function(e) {
		var query = document.getElementById('search-query').value;
		if(query === '')
			return;
		//console.log(query);
		$.ajax({
			url: 'search.php',
			type: 'POST',
			data: {query: query, type: currentTab},
			success: function(response) {
				emptyTabs();
				if(response !== '')
					updateContent($.parseJSON(response));
			},
			error: function(data) {

			}
		});

		//var json = $.parseJSON(response);
		//updateContent(json);
	});

});