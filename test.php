<?php
	session_start();

	$_SESSION['user_id'] = 1;

?>
<!DOCTYPE html>

<head>
	<title>This is a test webpage</title>
	<script type="text/javascript" src="js/jquery-3.2.1.js"></script>
	<script type="text/javascript" src="js/search.js"></script>
</head>
</body>
	<h1>Search</h1>
	<form id="search-form" action="search.php" method="post">
		<input type="text" id="search-query" name="query"><br>
		<input type="submit" value="Search">
	</form>
</body>