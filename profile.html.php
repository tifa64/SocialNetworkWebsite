<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/logout.inc.html.php'; ?></p>
<?php include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/helpers.inc.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/poster.inc.html.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<?php 
//rint_r ((array)$userinfo);
//print_r(array_values($info));
$img = $userinfo[0]['image_url'];
echo '<img src="images/'.$img.'" >';
echo "<br>";
echo $userinfo[0]['first_name'];
echo "<br>";
echo $userinfo[0]['last_name'];
echo $userinfo[0]['nick_name'];
echo "<br>";
echo $userinfo[0]['birth_date'];
echo "<br>";
echo $userinfo[0]['martial_status'];
echo "<br>";
echo $userinfo[0]['about_me'];
echo "<br>";
echo $userinfo[0]['gender'];
echo "<br>";
echo $userinfo[0]['home_town'];
echo "<br>";

?>

<form action="" method="post">
	<input type="submit" name="action" value="edit">
</form>
</body>
</html>

	