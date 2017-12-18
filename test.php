

<?php
	// THIS WHOLE PAGE IS USED FOR TESTING PURPOSES
	session_start();

	// Only used for testing, should be removed
	$_SESSION['user_id'] = 3;
	$_SESSION['full_name'] = 'Mohab Khairy';
	////////////////////////////////////
?>
<!DOCTYPE html>

<head>
	<title>This is a test webpage</title>
	<?php include $_SERVER['DOCUMENT_ROOT'].'/social-network/includes/notifications.html.php'; ?>
</head>
</body>
	<h1>Search</h1>
	<form id="search-form" action="search.php" method="post">
		<input type="text" id="search-query" name="query"><br>
		<input type="submit" value="Add Friend">
	</form>
	<button id="add_friend_test">Add Friend</button>
	<button id="like_test">Send Like</button>

</body>