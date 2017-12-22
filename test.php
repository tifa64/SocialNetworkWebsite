

<?php
	
	$ini_array = parse_ini_file("config.ini");
	$path = $ini_array['path'];
	// THIS WHOLE PAGE IS USED FOR TESTING PURPOSES
	session_start();

	// Only used for testing, should be removed
	//$_SESSION['userid'] = 4;
	//$_SESSION['nick_name'] = "Abdullah Ahmed";
	////////////////////////////////////
?>
<!DOCTYPE html>

<head>
	<title>This is a test webpage</title>
<script type="text/javascript" src="js/jquery-3.2.1.js"></script>
<script>
	var user_id = 4;
		var user_full_name = "Abdullah Ahmed";
</script>
<script type="text/javascript" src="js/notifications.js?<?php echo time(); ?>"></script>
<link rel="stylesheet" href="css/notifications.css">
<link rel="stylesheet" href="css/navbar.css">
</head>
</body>
	<form id="search-form" action="search.php" method="post">
		<input type="text" id="search-query" name="query"><br>
	</form>
	<button id="add_friend_test">Add Friend</button>
	<button id="like_test">Send Like</button>

</body>