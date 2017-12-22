<?php include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
<link rel="stylesheet" type="text/css" href="css/newsfeed.css">
<input type="hidden" name="userid" value="<?php htmlout($_SESSION['userid']);?>">
<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/logout.inc.html.php'; ?></p>
<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/poster.inc.html.php'; ?></p>
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
    <p id="para3"><?php htmlout($caption)?></p>
    <?php
    $image = ($allPosts[$i]['image_url']);
    echo $image;
    ?>
    <?php if(in_array($allPosts[$i], $myPosts)): ?>
      <?php $post_id = $allPosts[$i]['post_id']; ?>
      <form action="" method="post">
        <div>
          <input type="hidden" value="<?php htmlout($post_id) ?>" name="postid">
          <input id="DeletePost" type="submit" name="action" value="DeletePost">
        </div>
      </form>
  <?php endif ?>
  <?php echo "<br>";
  echo "<hr>"; ?>
<?php endfor ?>

</body>
</html>
