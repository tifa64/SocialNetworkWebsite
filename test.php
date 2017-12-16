

<?php
	// THIS WHOLE PAGE IS USED FOR TESTING PURPOSES
	session_start();

	// Only used for testing, should be removed
	$_SESSION['user_id'] = 1;
	$_SESSION['full_name'] = 'Ahmed Elsayed';
	////////////////////////////////////
?>
<!DOCTYPE html>

<head>
	<title>This is a test webpage</title>
	<script type="text/javascript" src="js/jquery-3.2.1.js"></script>
	<script>
		var user_id = <?php echo $_SESSION['user_id']; ?>;
		var user_full_name = <?php echo '"'.$_SESSION['full_name'].'"'; ?>;
	</script>
	<script type="text/javascript" src="js/notifications.js"></script>	
</head>
</body>
	<h1>Search</h1>
	<form id="search-form" action="search.php" method="post">
		<input type="text" id="search-query" name="query"><br>
		<input type="submit" value="Search">
	</form>
</body>