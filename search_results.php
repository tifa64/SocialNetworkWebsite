<?php
	$ini_array = parse_ini_file("config.ini");
	$path = $ini_array['path'];
	//echo $_SESSION['userid'];
	// ONLY USED FOR TESTING PURPOSES AND SHOULD BE REMOVED
	//$_SESSION['user_id'] = 1;
	//$_SESSION['full_name'] = 'Karim Elawaad';
	//////////////////////////////////////////////////////

?>

<!DOCTYPE html>

<html>
	<head>
		<?php include $_SERVER['DOCUMENT_ROOT'].$path.'/includes/notifications.html.php'; ?>
		<script type="text/javascript" src="js/search_results.js"></script>
		<link rel="stylesheet"  href="css/search_results.css">
		<link rel="stylesheet" type="text/css" href="css/styleNewsFeed.css">
		<meta charset='utf-8'>

	</head>
	<body>
		<?php include $_SERVER['DOCUMENT_ROOT'].$path.'/includes/logout.inc.html.php'; ?></p>
		<?php include $_SERVER['DOCUMENT_ROOT'].$path.'/includes/search.inc.php'; ?>
		<?php include $_SERVER['DOCUMENT_ROOT'].$path.'/includes/header.inc.html.php'; ?>
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