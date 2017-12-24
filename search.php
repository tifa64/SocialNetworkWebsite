<?php
$ini_array = parse_ini_file("config.ini");
$path = $ini_array['path'];
$username = $ini_array['username'];
$password = $ini_array['password'];
	include_once $_SERVER['DOCUMENT_ROOT'].$path.
    '/includes/magicquotes.inc.php';


	session_start();

	$query = $_POST['query'];
	$type = $_POST['type'];
	$user_id = $_SESSION['userid'];

	// Set up the connection to the database
	$servername = "localhost";
	$db_username   = $username;
	$db_password   = $password;
	$dbname     = "newdatabase";

	$conn = new mysqli($servername, $db_username, $db_password, $dbname);

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$reply = array();
	if(isset($type)) {
		if($type === 'email') {
			$email_query = "SELECT * FROM user WHERE email LIKE '%$query%'";
			$result = $conn->query($email_query);
			$num_rows = mysqli_num_rows($result);
			$users = array();
			if ($num_rows > 0) {
		       	for($i = 0; $i < $num_rows; $i++) {
			    		$row = mysqli_fetch_assoc($result);
			    		array_push($users, array("user_id" => $row['user_id'], "fname" => $row['first_name'], "lname" => $row['last_name'], "image_url" => $row['image_url'], "type" => "email", "nickname" => $row['nick_name']));
			    		#echo $row["last_name"].'<br>';
	    		}
	    		echo json_encode($users, JSON_FORCE_OBJECT);
		    }

		} else if($type === 'name') {
			$reply = array();
			$fname = '';
			$lname = '';
			if(strpos($query, ' ') !== false) {
				$pos = strpos($query, ' ');
				$fname = substr($query, 0, $pos);
				$lname = substr($query, $pos + 1);
			} else {
				$fname = $query;
			}

			$name_query1 = "SELECT * FROM user WHERE first_name LIKE '%$fname%'";
			$name_query2 = '';
			if($lname !== '') {
				$name_query1 = $name_query1 . " AND last_name LIKE '%$lname%'";
			} else {
				$lname = $query;
				$name_query2 = "SELECT * FROM user WHERE last_name LIKE '%$lname%'";
			}

			$result = $conn->query($name_query1);
			$num_rows = mysqli_num_rows($result);
			$users = array();
			if ($num_rows > 0) {
		       	for($i = 0; $i < $num_rows; $i++) {
			    		$row = mysqli_fetch_assoc($result);
			    		array_push($users, array("user_id" => $row['user_id'], "fname" => $row['first_name'], "lname" => $row['last_name'], "image_url" => $row['image_url'], "nickname" => $row['nick_name']));
			    		#echo $row["last_name"].'<br>';
	    		}
		    }

		    if ($name_query2 !== '') {
		    	$result = $conn->query($name_query2);
		    	$num_rows = mysqli_num_rows($result);
		    	if($num_rows > 0) {
		    		for($i = 0; $i < $num_rows; $i++) {
			    		$row = mysqli_fetch_assoc($result);
			    		array_push($users, array("user_id" => $row['user_id'], "fname" => $row['first_name'], "lname" => $row['last_name'], "image_url" => $row['image_url'], "nickname" => $row['nick_name']));
			    		#echo $row["first_name"].'<br>';
			    		#echo $row["last_name"].'<br>';
		    		}
		    	}
		    }
		    $num_rows = mysqli_num_rows($result);
		    if(sizeof($users) > 0)
		    	echo json_encode($users, JSON_FORCE_OBJECT);


		} else if($type === 'hometown') {
			$hometown_query = "SELECT * FROM user WHERE home_town LIKE '%$query%'";
		    $result = $conn->query($hometown_query);
		    $num_rows = mysqli_num_rows($result);
		    $users = array();
		    if($num_rows > 0) {
		    	for($i = 0; $i < $num_rows; $i++) {
		    		$row = mysqli_fetch_assoc($result);

		    		array_push($users, array("user_id" => $row['user_id'], "fname" => $row['first_name'], "lname" => $row['last_name'], "image_url" => $row['image_url'], "nickname" => $row['nick_name']));

		    		#echo $row["user_id"].'<br>';
		    		#echo $row["first_name"].'<br>';
	    		}
	    	}
		   	if(sizeof($users) > 0)
		   		echo json_encode($users, JSON_FORCE_OBJECT);

		} else if($type === 'posts') {
			$posts_query = "SELECT * FROM posts,user WHERE caption LIKE '%$query%' AND posts.user_id='$user_id' AND posts.user_id=user.user_id";
		    #$posts_query = mysql_query("SELECT * FROM posts WHERE caption LIKE '%$query%'");
		    $result = $conn->query($posts_query);
		    $num_rows = mysqli_num_rows($result);
		    $posts = array();
		    if($num_rows > 0) {
		    	for($i = 0; $i < $num_rows; $i++) {
			    		$row = mysqli_fetch_assoc($result);
			    		array_push($posts, array("content" => $row['caption'], "time" => $row['time'], "fname" => $row['first_name'], "lname" => $row['last_name'], "image_url" => $row['image_url'], "post_id" => $row['post_id'], "user_id" => $row['user_id'], "nickname" => $row['nick_name']));
	    		}
	    		if(sizeof($posts) > 0)
		    		echo json_encode($posts, JSON_FORCE_OBJECT);
		    }
		}
	} else {
		if(strpos($query, '@') !== false) {
			$email_query = "SELECT * from user WHERE email LIKE '%$query%'";
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



			$name_query1 = "SELECT * FROM user WHERE first_name LIKE '%$fname%'";
			$name_query2 = '';
			if($lname !== '') {
				$name_query1 = $name_query1 . " AND last_name LIKE '%$lname%'";
			} else {
				$lname = $query;
				$name_query2 = "SELECT * FROM user WHERE last_name LIKE '%$lname%'";
			}

			$result = $conn->query($name_query1);
			$num_rows = mysqli_num_rows($result);
			if ($num_rows > 0) {
				$users = array();
		       	for($i = 0; $i < $num_rows; $i++) {
			    		$row = mysqli_fetch_assoc($result);
			    		array_push($users, array("user_id" => $row['user_id'], "fname" => $row['first_name'], "lname" => $row['last_name']));
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
			    		array_push($users, array("user_id" => $row['user_id'], "fname" => $row['first_name'], "lname" => $row['last_name']));
			    		#echo $row["first_name"].'<br>';
			    		#echo $row["last_name"].'<br>';
		    		}
		    		array_push($reply, array("users_lname" => $users));
		    	}
		    }

		    $posts_query = "SELECT * FROM posts WHERE caption LIKE '%$query%' AND user_id='$user_id'";
		    #$posts_query = mysql_query("SELECT * FROM posts WHERE caption LIKE '%$query%'");
		    $result = $conn->query($posts_query);
		    $num_rows = mysqli_num_rows($result);
		    if($num_rows > 0) {
		    	$posts = array();
		    	for($i = 0; $i < $num_rows; $i++) {
			    		$row = mysqli_fetch_assoc($result);
			    		array_push($posts, array("content" => $row['caption'], "user_id" => $row['user_id'], "post_id" => $row['post_id']));
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
	}

	$conn->close();
?>
