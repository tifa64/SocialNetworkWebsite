<?php include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/helpers.inc.php'; ?>
  <!DOCTYPE html>
  <html lang="en">
  <img src="<?php htmlout($_SESSION['url']);?>" alt="profile picture" />
<head>
  <title>Social Network</title>
  <link rel="stylesheet" type="text/css" href="css/styleNewsFeed.css">
</head>
<body>
  <div class="header">
    <div class="searchbox">
      <form action="" method="Get" id= "search">
        <input type="text" name="" size="60" placeholder="Search">

      </form>
    </div>
    <div id = "menu">
      <a href="#">Home</a>
      <a href="#">Profile</a>
      <a href="#">Notifications</a>
      <a href="#">Friend Requests</a>
    </div>
  </div>

  <div class="post" >
    <form action="" method="post">
      Post name* :     <textarea name="Postname" rows="1" cols="80" id="Postname" required ></textarea><br>
      Post caption* : <textarea name="Caption" rows="4" cols="80" id="Caption" required></textarea><br>
      <input type="radio" name="Poststate" value="Public" id="Poststate" checked> Public
      <input type="radio" name="Poststate" value="Private" id="Poststate"> Private
      <input type="file" name="Postimage" value="post" id="image">
      <input type="hidden" name="Userid" value="<?php htmlout($userid);?>">
      <input type="submit" name="action" value="Posting"><br>
    </form>
  </div>
  <?php display_posts () ;?>
</body>
</html>
