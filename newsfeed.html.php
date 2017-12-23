<?php
      $ini_array = parse_ini_file("config.ini");
	    $path = $ini_array['path'];
     include_once $_SERVER['DOCUMENT_ROOT'] .$path.
    '/includes/helpers.inc.php';
     ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include $_SERVER['DOCUMENT_ROOT'].$path.'/includes/notifications.html.php'; ?>
    <meta charset="UTF-8">
</head>
<body>
  <?php include $_SERVER['DOCUMENT_ROOT'].$path.'/includes/header.inc.html.php'; ?>
<link rel="stylesheet" type="text/css" href="css/newsfeed.css">
<input type="hidden" name="userid" value="<?php htmlout($_SESSION['userid']);?>">
<?php include $_SERVER['DOCUMENT_ROOT'].$path.'/includes/poster.inc.html.php'; ?></p>
<input type = "hidden" value="newsfeed" name="comeFrom">
<input type="submit" name="action" value="Posting">
<?php
  display_posts ();
?>
</form>
</div>
<?php
$allPosts = $_SESSION['allPosts'];
$myPosts = $_SESSION['myPosts'];
$friendsPosts  = $_SESSION['friendsPosts'];
?>
<?php for($i = 0; $i < count($allPosts); $i++): ?>
  <?php
    $fn = ($allPosts[$i]['first_name']);
    $ln = ($allPosts[$i]['last_name']);
    ?>
    <p id="para1"><?php htmlout($fn) ?> <?php htmlout($ln) ?></p>
    <?php
    $title = ($allPosts[$i]['title']);
    ?>
    <p id="para2"><?php htmlout($title)?></p>
    <?php
    $caption = ($allPosts[$i]['caption']);
    ?>
    <p id="para3"><?php echo $caption; ?></p>
    <?php
    if (($allPosts[$i]['image_url']) != NULL){
       $image = ($allPosts[$i]['image_url']);
       echo '<img src ="'.$image.'" width=300px height=300px>';
    }

    ?>
    <?php if(!empty($myPosts)) :?>
      <?php if(in_array($allPosts[$i], $myPosts)): ?>
        <?php $post_id = $allPosts[$i]['post_id']; ?>
        <form action="" method="post">
          <div>
            <input type="hidden" value="<?php htmlout($post_id) ?>" name="postid">
            <input id="DeletePost" type="submit" name="action" value="DeletePost">
          </div>
        </form>
    <?php endif ?>
  <?php endif ?>
  <?php echo "<br>";
  echo "<hr>"; ?>
<?php endfor ?>

</body>
</html>
