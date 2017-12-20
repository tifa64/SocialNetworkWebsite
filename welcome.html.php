<?php
	$ini_array = parse_ini_file("config.ini");
	$path = $ini_array['path']; 
	include_once $_SERVER['DOCUMENT_ROOT'] .
    $path.'/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Social Network</title>
</head>
<body>
<?php if (isset($_SESSION['userid'])): ?>
    <p> WELCOME <?php htmlout($_SESSION['userid']); ?></p>
<?php endif; ?>
<form action="./index.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="hidden" name="userid" value="<?php htmlout($_SESSION['userid']);?>">

    <input type="submit" value="Upload Image" name="submit">
</form>
<?php include $_SERVER['DOCUMENT_ROOT'].$path.'/includes/logout.inc.html.php'; ?></p>
</body>
</html>
