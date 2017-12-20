<?php 
	$ini_array = parse_ini_file("config.ini");
	$path = $ini_array['path'];
	include_once $_SERVER['DOCUMENT_ROOT'].
    $path.'/includes/helpers.inc.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php include $_SERVER['DOCUMENT_ROOT'].$path.'/includes/notifications.html.php'; ?>
</head>
<body>

<input type="hidden" name="userid" value="<?php htmlout($_SESSION['userid']);?>">
<?php include $_SERVER['DOCUMENT_ROOT'].$path.'/includes/logout.inc.html.php'; ?></p>
<?php include $_SERVER['DOCUMENT_ROOT'].$path.'/includes/search.inc.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'].$path.'/includes/poster.inc.html.php'; ?></p>
</body>
</html>
