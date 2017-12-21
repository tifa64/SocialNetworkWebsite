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
<?php
$allPosts = $_SESSION['allPosts'];
$myPosts = $_SESSION['myPosts'];
$friendsPosts  = $_SESSION['friendsPosts'];
echo "First name ---- Last name ---- Title  ---- Caption ---- ImageURL";
echo "<hr>";
echo "<hr>";
?>
<?php for($i = 0; $i < count($allPosts); $i++): ?>
  <?php if(in_array($allPosts[$i], $myPosts)): ?>
    <?php $post_id = $allPosts[$i]['post_id']; ?>
    <form action="" method="post">
      <div>
        <input type="text" visibility="hidden" value="<?php htmlout($post_id) ?>" name="postid">
        <input type="submit" name="action" value="DeletePost">
      </div>
    </form>
<?php endif ?>
  <?php
    print_r ($allPosts[$i]['first_name']);
    echo " ---- ";
    print_r ($allPosts[$i]['last_name']);
    echo " ---- ";
    print_r ($allPosts[$i]['title']);
    echo " ---- ";
    print_r ($allPosts[$i]['caption']);
    echo " ---- ";
    print_r ($allPosts[$i]['image_url']);
    echo " ---- ";
    echo "<br>";
    echo "<hr>";
    ?>
<?php endfor ?>

</body>
</html>
