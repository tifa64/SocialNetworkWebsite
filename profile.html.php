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
<link rel="stylesheet" type="text/css" href="css/newsfeed.css">
<form action="" method="post">
	<input id="editp" type="submit" name="action" value="edit">
</form>
<?php
//rint_r ((array)$userinfo);
//print_r(array_values($info));
$img = $userinfo[0]['image_url'];
echo '<img src="images/'.$img.'" >';
echo "<br>";
?>
<p id="para1"> First Name: <?php htmlout($userinfo[0]['first_name']); ?></p>
<p id="para1"> Last Name: <?php htmlout($userinfo[0]['last_name']); ?></p>
<p id="para1"> Nickname: <?php
if (!is_null($userinfo[0]['nick_name'])){
    htmlout($userinfo[0]['nick_name']);
}
else {
  htmlout('');
} ?>
</p>
<p id="para2"> Birthday: <?php
if (($userinfo[0]['birth_date']) != "0000-00-00"){
    htmlout($userinfo[0]['birth_date']);
}
else {
  htmlout('');
} ?>
</p>
<p id="para2"> Martial Status: <?php
if (!is_null($userinfo[0]['martial_status'])){
    htmlout($userinfo[0]['martial_status']);
}
else {
  htmlout('');
} ?>
</p>
<p id="para3"> About Me: <?php
if (($userinfo[0]['about_me']) != "Here you go ..."){
    htmlout($userinfo[0]['about_me']);
}
else {
  htmlout('I am NOT interesting enough');
} ?>
</p>
<p id="para3"> Gender : <?php htmlout($userinfo[0]['gender']); ?></p>
<p id="para3"> Home Town : <?php htmlout($userinfo[0]['home_town']); ?></p>

<?php  $myPosts = $_SESSION['myPosts'];?>
<?php for($i = 0; $i < count($myPosts); $i++): ?>
  <?php
    $fn = ($myPosts[$i]['first_name']);
    $ln = ($myPosts[$i]['last_name']);
    ?>
    <p id="para1"><?php htmlout($fn) ?> <?php htmlout($ln) ?></p>
    <?php
    $title = ($myPosts[$i]['title']);
    ?>
    <p id="para2"><?php htmlout($title)?></p>
    <?php
    $caption = ($myPosts[$i]['caption']);
    ?>
    <p id="para3"><?php htmlout($caption)?></p>
    <?php
    if (($myPosts[$i]['image_url']) != NULL){
       $image = ($myPosts[$i]['image_url']);
       echo '<img src ="images/'.$image.'" width=300px height=300px>';
    }

    ?>
    <?php if(in_array($myPosts[$i], $myPosts)): ?>
      <?php $post_id = $myPosts[$i]['post_id']; ?>
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
