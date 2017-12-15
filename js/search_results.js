var currentTab;

function updateContent(json) {
	var already_here = [];
	var keys = Object.keys(json);
	for(key in keys) {
		var x = json[key];
		if(currentTab === 'posts') 
			$('#'+currentTab).append(createPostEntry(x));
		else {
			if(already_here.indexOf(x['user_id']) == -1) {
				$('#'+currentTab).append(createUserEntry(x));
				already_here.push(x['user_id']);
			}
		}
	}
	if(keys.length == 0) {
		$(".num_elements_found").remove();
		return;
	}
	console.log('tab length = ');
	console.log($(".tab").length);
	if($(".tab").length !== 0) {
		if(currentTab == 'posts') {
			if($('.num_elements_found').length > 0)
				$('.num_elements_found').html(createNumEntriesFound(keys.length))
			else
				$(".tab").after(createNumEntriesFound(keys.length));
		}
		else {
			if($('.num_elements_found').length > 0)
				$('.num_elements_found').html(createNumEntriesFound(keys.length))
			else
				$(".tab").after(createNumEntriesFound(already_here.length));
		}
	} else{
		if(currentTab == 'posts')
			$(".tab").after(createNumEntriesFound(keys.length));
		else
			$(".tab").after(createNumEntriesFound(already_here.length));
	}	
}

function createUserEntry(user) {
	var element = '<div id="' + user['user_id'] + '" class="search_result">';
	element += '<h2>' + user['fname'] + ' ' + user['lname'] + '</h2>';
	element += '<img src="' + user['image_url'] + '" width=75 height=75/>';

	element += "</div>";
	return element;
}

function formatDate(date) {
	var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
	var year = date.slice(0, 4); 
	var str = date.slice(5, date.length);
	var month = str.slice(0, 2);
	str = str.slice(3, str.length);
	var day = str.slice(0, str.indexOf(' '));
	str = str.slice(str.indexOf(' ') + 1, str.length);
	var hour = str.slice(0, str.indexOf(':'));
	str = str.slice(str.indexOf(':') + 1, str.length);
	var mins = str.slice(0, str.indexOf(':'));
	var ampm;
	if(hour < 12)
		ampm="am";
	else if(hour >= 12) {
		ampm="pm";
		if(hour > 12)
			hour -= 12;
	}
	if(day[0] == '0')
		day = day.slice(1, day.length);
	if(hour[0] == '0')
		hour = hour.slice(1, hour.length);
	var output = day + ' ' + months[parseInt(month)-1];
	if(parseInt(year) !== (new Date).getFullYear())
		output += ' ' + year;
	 output += ' ' + hour + ':' + mins + ampm

	return output;
}

function createPostEntry(post) {
	var element = '<div id="' + post['post_id'] + '" class="search_result_post">';
	element += '<div class="container"><img class="profile_picture" src="' + post['image_url'] + '" width=50 height=50/>';
	element += '<h3 class="name"><a href="https://localhost:8000/social-network/users/' + post['user_id'] + '">' + post['fname'] + ' ' + post['lname'] + '</a></h3>';
	element += '<h6 class="post_date">' + formatDate(post['time']) + '</h6></div>';
	element += '<p>' + post['content'] + '</p>';
	element += '</div>';

	return element; 
}

function createNoEntryFound() {
	var element = '<div class="no_result"><h2>No Results Found 😔</h2></div>';
	return element;
}

function createNumEntriesFound(length) {
	var element = '<div class="num_elements_found">Found ' + length + ' Results</div>';
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
				$(".num_elements_found").remove();
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
				//console.log(response);
				emptyTabs();
				if(response !== '')
					updateContent($.parseJSON(response));
				else {
					addNoResultsFound();
					$(".num_elements_found").remove();
				}
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
				//console.log(response);
				emptyTabs();
				if(response !== '')
					updateContent($.parseJSON(response));
				else {
					addNoResultsFound();
					$(".num_elements_found").remove();
				}
			},
			error: function(data) {

			}
		});
	});

	$("a").on('click', function() {
		console.log('a clicked');
	});
});