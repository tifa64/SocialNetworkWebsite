<?php include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
<input type="hidden" name="userid" value="<?php htmlout($_SESSION['userid']);?>">
<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/logout.inc.html.php'; ?></p>
<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/poster.inc.html.php'; ?></p>
</body>
</html>
