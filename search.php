<?php
	$query = $_POST["query"];
	// Set up the connection to the database
	$servername = "localhost";
	$db_username   = "root";
	$db_password   = "";
	$dbname     = "social-network";

	$conn = new mysqli($servername, $db_username, $db_password, $dbname);

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$reply = array();
	if(strpos($query, '@') !== false) {
		$email_query = "SELECT * from user WHERE email='$query'";
		$result = $conn->query($email_query);
		if(mysqli_num_rows($result) == 1)
		{
			$row = mysqli_fetch_assoc($result);
			array_push($reply, array("user_email" => array("fname" => $row['first_name'], "lname" => $row['last_name'])));
		}
	}else {
		$fname = '';
		$lname = '';
		if(strpos($query, ' ') !== false) {
			$pos = strpos($query, ' ');
			$fname = substr($query, 0, $pos);
			$lname = substr($query, $pos + 1);
		} else {
			$fname = $query;
		}



		$name_query1 = "SELECT * FROM user WHERE first_name='$fname'";
		$name_query2 = '';
		if($lname !== '') {
			$name_query1 = $name_query1 . " AND last_name='$lname'";
		} else {
			$name_query2 = "SELECT * FROM user WHERE last_name='$lname'";
		}

		$result = $conn->query($name_query1);
		$num_rows = mysqli_num_rows($result);
		if ($num_rows > 0) {
			$users = array();
	       	for($i = 0; $i < $num_rows; $i++) {
		    		$row = mysqli_fetch_assoc($result);
		    		array_push($users, array($row['user_id'] => array("fname" => $row['first_name'], "lname" => $row['last_name'])));
		    		#echo $row["last_name"].'<br>';
    		}
    		array_push($reply, array("users_fname" => $users));
	    }

	    if ($name_query2 !== '') {
	    	$result = $conn->query($name_query2);
	    	$num_rows = mysqli_num_rows($result);
	    	if($num_rows > 0) {
	    		$users = array();
	    		for($i = 0; $i < $num_rows; $i++) {
		    		$row = mysqli_fetch_assoc($result);
		    		array_push($users, array($row['user_id'] => array("fname" => $row['first_name'], "lname" => $row['last_name'])));
		    		#echo $row["first_name"].'<br>';
		    		#echo $row["last_name"].'<br>';
	    		}
	    		array_push($reply, array("users_lname" => $users));
	    	}
	    }

	    $posts_query = "SELECT * FROM posts WHERE caption LIKE '%$query%'";
	    #$posts_query = mysql_query("SELECT * FROM posts WHERE caption LIKE '%$query%'");
	    $result = $conn->query($posts_query);
	    $num_rows = mysqli_num_rows($result);
	    if($num_rows > 0) {
	    	$posts = array();
	    	for($i = 0; $i < $num_rows; $i++) {
		    		$row = mysqli_fetch_assoc($result);
		    		array_push($posts, array($row['post_id'] => array("content" => $row['caption'], "user_id" => $row['user_id'])));
		    		#echo $row["post_id"].'<br>';
		    	#	echo $row["caption"].'<br>';
    		}
	    	array_push($reply, array("posts" => $posts));	
	    }

	    $hometown_query = "SELECT * FROM user WHERE home_town LIKE '%$query%'";
	    $result = $conn->query($hometown_query);
	    $num_rows = mysqli_num_rows($result);
	    if($num_rows > 0) {
	    	$users = array();
	    	for($i = 0; $i < $num_rows; $i++) {
	    		$row = mysqli_fetch_assoc($result);
	    		array_push($users, array($row['user_id'] => array("fname" => $row['first_name'], "lname" => $row['last_name'])));

	    		#echo $row["user_id"].'<br>';
	    		#echo $row["first_name"].'<br>';
	    	}
	    	array_push($reply, array("users_hometown" => $users));
	    }
	}
	echo json_encode($reply, JSON_FORCE_OBJECT);
?>