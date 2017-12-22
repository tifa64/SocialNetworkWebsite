<?php
$ini_array = parse_ini_file("config.ini");
$path = $ini_array['path'];
include_once $_SERVER['DOCUMENT_ROOT'].$path.
    '/includes/magicquotes.inc.php';


session_start();
	$userid = $_SESSION['userid'];


	$servername = "localhost";
	$db_username   = "root";
	$db_password   = "";
	$dbname     = "newdatabase";

	$conn = new mysqli($servername, $db_username, $db_password, $dbname);

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	// U1 sender
	// U2 receiver
	$get_notifcations_query = "SELECT N.seen ,user_id1, user_id2, U1.image_url AS sender_image_url, U1.nick_name AS sender_nick_name, U1.first_name AS sender_first_name, U1.last_name AS sender_last_name FROM notifications AS N, user AS U1, user AS U2 WHERE N.user_id1=U1.user_id AND N.user_id2=U2.user_id AND U2.user_id='$userid'";
	$result = $conn->query($get_notifcations_query);
	$num_rows = mysqli_num_rows($result);
	$notifications = array();
	for($i = 0; $i < $num_rows; $i++) {
		$row = mysqli_fetch_assoc($result);
		$username = '';
		if($row["sender_nick_name"] !== NULL) {
			$username = $row["sender_nick_name"];
		} else {
			$username = $row["sender_first_name"].' '.$row["sender_last_name"];
		}
		array_push($notifications, array("sender_id" => $row["user_id1"], "receiver_id" => $row['user_id2'], "sender_username" => $username, "sender_image_url" => $row['sender_image_url'], "seen" => $row['seen']));
	}
	echo json_encode($notifications);

	$conn->close();
?>