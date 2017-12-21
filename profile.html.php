<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/logout.inc.html.php'; ?></p>
<?php include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/helpers.inc.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/poster.inc.html.php'; ?>
<?php //print_r( $_SESSION['info']); ?> 

<?php 
	$info = $_SESSION['info'] ;
		print_r($info['first_name']);
		echo "<br>";
		print_r($info['last_name']);
		echo "<br>";
		echo '<img src="'.$info['image_url'].'" >';
		echo "<br>";
		print_r($info['nick_name']);
		echo "<br>";
		print_r($info['birth_date']);
		echo "<br>";
		print_r($info['martial_status']);
		echo "<br>";
		print_r($info['about_me']);
		echo "<br>";
		print_r($info['gender']);
		echo "<br>";
		print_r($info['email']);
		echo "<br>";
		print_r($info['home_town']);
		echo "<br>";
//for ($i=0 ;$i< count($info) ;$i++){
//	}

?>

	