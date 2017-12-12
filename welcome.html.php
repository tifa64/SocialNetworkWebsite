<?php include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Social Network</title>
</head>
<body>
<?php if (isset($username)): ?>
    <p> WELCOME <?php htmlout($username); ?></p>
<?php endif; ?>
<form action=" " method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="hidden" name="userid" value="<?php htmlout($userid);?>">
    <input type="submit" value="Upload Image" name="submit">
</form>
<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/logout.inc.html.php'; ?></p>
</body>
</html>