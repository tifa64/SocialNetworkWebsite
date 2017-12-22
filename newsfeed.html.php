<?php include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>

<input type="hidden" name="userid" value="<?php htmlout($_SESSION['userid']);?>">
<form  action="./index.php" method="post">
    <input type="submit" name="action" value="FriendRequests">
</form>
<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/search.inc.html.php'; ?></p>
<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/logout.inc.html.php'; ?></p>
<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/poster.inc.html.php'; ?></p>
<?php display_posts () ?>

</body>
</html>
