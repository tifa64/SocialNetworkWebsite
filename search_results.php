<?php
	session_start();

	// ONLY USED FOR TESTING PURPOSES AND SHOULD BE REMOVED
	$_SESSION['user_id'] = 1;
	$_SESSION['full_name'] = 'Karim Elawaad';
	//////////////////////////////////////////////////////

?>

<!DOCTYPE html>

<html>
	<head>
		<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/notifications.html.php'; ?>
		<script type="text/javascript" src="js/search_results.js"></script>
		<link rel="stylesheet"  href="css/search_results.css">
		<meta charset='utf-8'>

	</head>
	<body>
		<div id="search-bar">
			<form autocomplete="off" id="search-form" action="search.php" method="post">
				<input type="text" id="search-query" name="query"><br>
			</form>
		</div>
		<div class="tab">
			<button class="tablinks" id="tab1" onclick="changeTab(event, 'name')">Name</button>
			<button class="tablinks" id="tab2" onclick="changeTab(event, 'email')">Email</button>
			<button class="tablinks" id="tab3" onclick="changeTab(event, 'hometown')">Hometown</button>
			<button class="tablinks" id="tab4" onclick="changeTab(event, 'posts')">Posts</button>			
		</div>

		<div id="name" class="tabcontent">
		</div>

		<div id="email" class="tabcontent">
		</div>

		<div id="hometown" class="tabcontent">

		</div>

		<div id="posts" class="tabcontent">

		</div>
	</body>
</html>