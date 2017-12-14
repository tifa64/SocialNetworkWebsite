var currentTab;

function updateContent(json) {
	var already_here = [];
	var keys = Object.keys(json);
	for(key in keys) {
		var x = json[key];
		if(currentTab === 'posts')
			$('#'+currentTab).append('<div id="' + x['post_id'] + '" class="search_result">Name: ' + x['content'] +'<a href="localhost:8000/social-network/users/' + x['user_id'] + '">Link</a></div>');
		else {
			if(already_here.indexOf(x['user_id']) == -1) {
				$('#'+currentTab).append(createUserEntry(x));
				already_here.push(x['user_id']);
			}
		}
	}	
}

function createUserEntry(user) {
	var element = '<div id="' + user['user_id'] + '" class="search_result">';
	element += '<h2>' + user['fname'] + ' ' + user['lname'] + '</h2>';
	element += '<img src="' + user['image_url'] + '" width=75 height=75/>';

	element += "</div>";
	return element;
}

function createNoEntryFound() {
	var element = '<div class="no_result"><h2>No Results Found 😔</h2></div>';

	return element;
}


function emptyTabs() {
	$('#name').empty();
	$('#email').empty();
	$('#posts').empty();
	$('#hometown').empty();	
}

function addNoResultsFound() {
	var element = createNoEntryFound();
	$('#name').append(element);
	$('#email').append(element);
	$('#posts').append(element);
	$('#hometown').append(element);
}

function addTypeYourQueryDiv() {
	var element = '<div class="add_your_query"><h1>Type your query in the searchbar</h1></div>';
	$('#name').append(element);
	$('#email').append(element);
	$('#posts').append(element);
	$('#hometown').append(element);
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
	addTypeYourQueryDiv();
	currentTab = "name";
	document.getElementsByClassName("tabcontent")[0].style.display = "block";
	document.getElementById("tab1").style.display = "block";
	document.getElementById("tab1").className += " active";

	$(".search_result").click(function(e) {
		console.log(e.currentTarget);
	});
	
	$("#search-form").submit(function(e) {
		e.preventDefault();

		var query = $("#search-query").value;

		$.ajax({
			url: 'search.php',
			type: 'POST',
			data: {query: query},
			success: function(response) {
				console.log(response);
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
				//addNoResultsFound();
				addTypeYourQueryDiv();
			}
		}
	});

	$("div").click(function(e) {
		if(e.target.className === "search_result") {
			if(currentTab === "name") {
				console.log(e.target.id);
				window.location.href = 'users/' + e.target.id;
			}
		}
	});

	var i = 0;
	$("#search-query").keyup(function(e) {
		var query = document.getElementById('search-query').value;
		if(query === '')
			return;

		$.ajax({
			url: 'search.php',
			type: 'POST',
			data: {query: query, type: currentTab},
			success: function(response) {
				emptyTabs();
				if(response !== '')
					updateContent($.parseJSON(response));
				else
					addNoResultsFound();
			},
			error: function(data) {

			}
		});

		//var json = $.parseJSON(response);
		//updateContent(json);
	});

	$(".tablinks").click(function() {
		console.log("Tab clicked");
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
				else
					addNoResultsFound();
			},
			error: function(data) {

			}
		});
	});

});