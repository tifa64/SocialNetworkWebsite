

<?php
	
	$ini_array = parse_ini_file("config.ini");
	$path = $ini_array['path'];
	// THIS WHOLE PAGE IS USED FOR TESTING PURPOSES
	session_start();

	// Only used for testing, should be removed
	$_SESSION['userid'] = 4;
	$_SESSION['nick_name'] = "Abdullah Ahmed";
	////////////////////////////////////
?>
<!DOCTYPE html>

<head>
	<title>This is a test webpage</title>
	<?php include $_SERVER['DOCUMENT_ROOT'].$path.'/includes/notifications.html.php'; ?>
</head>
</body>
	<form id="search-form" action="search.php" method="post">
		<input type="text" id="search-query" name="query"><br>
	</form>
	<button id="add_friend_test">Add Friend</button>
	<button id="like_test">Send Like</button>

</body>