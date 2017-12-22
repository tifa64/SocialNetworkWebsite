<?php
    $ini_array = parse_ini_file("config.ini");
    $path = $ini_array['path'];
     include_once $_SERVER['DOCUMENT_ROOT'].$path.
    '/includes/helpers.inc.php'; 
     include_once $_SERVER['DOCUMENT_ROOT'].$path.
    '/includes/db.inc.php';
    include_once $_SERVER['DOCUMENT_ROOT'].$path.
    '/includes/header.inc.html.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include $_SERVER['DOCUMENT_ROOT'].$path.'/includes/notifications.html.php'; ?>

    <meta charset="UTF-8">
    <title>Profile</title>
</head>
<body>
<?php if ($_SESSION['userid'] == $userid): ?>
    <form  action="./index.php" method="post">
        <input type="hidden" name="editinfo" value="$_SESSION['email']";?>
        <input type="submit" name="action" value="editprofile">

    </form>
    <form  action="./index.php" method="post">
        <input type="submit" name="action" value="showfriends">

    </form>
<?php elseif (check_friendship($pdo,$_SESSION['userid'],$userid)) :?>
<form  action="./index.php" method="post">
    <input type="hidden" name="newfriend_id" value="<?php htmlout($userid)?>">
    <input type="submit" name="action" value="Remove Friend">
</form>
<?php elseif (check_pendingfriends($pdo,$_SESSION['userid'],$userid)) :?>
    <form  action="./index.php" method="post">
    <input type="hidden" name="newfriend_id" value="<?php htmlout($userid)?>">
    <input type="submit" name="action" value="Cancel Request">
    </form>
<?php elseif (check_pendingfriends($pdo,$userid,$_SESSION['userid'])) :?>
    <p> Please navigate to FriendRequests so that you can accept this request (DONT BE A MEAN MOTHAFAKA)!</p>
<?php else :?>
<form  action="./index.php" method="post">
    <input type="hidden" name="newfriend_id" value="<?php htmlout($userid)?>">
    <input type="submit" name="action" value="Add Friend">
</form>
<?php endif; ?>
<?php include $_SERVER['DOCUMENT_ROOT'].$path.'/includes/logout.inc.html.php'; ?>

<?php if(!(empty($posts))): ?>

<?php foreach ($posts as $post): ?>
<p><?php htmlout($post['caption']) ?>
    <br/>
    <?php htmlout($post['time']) ?><br/>
    <?php endforeach ; ?>

</p>
    <?php else : ?>
<p> NO posts to show </p>
<?php endif; ?>
<p>
    <?php foreach ($user_info   as $info): ?>
        <?php if($info['nick_name'] !== NULL) :?>
            <?php htmlout($info['nick_name']) ?>
        <?php else :?>
            <?php htmlout($info['first_name'].$info['last_name']) ?>
        <?php endif; ?>

        <?php htmlout($info['birth_date']) ?>
        <?php htmlout($info['martial_status']) ?>
        <?php htmlout($info['about_me'])?>
        <?php htmlout($info['email'])?>
        <?php htmlout($info['about_me'])?>
        <?php htmlout($info['home_town'])?>

    <?php endforeach ; ?>
</p>
</body>
</html>
