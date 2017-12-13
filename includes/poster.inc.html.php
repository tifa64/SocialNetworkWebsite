<?php include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/helpers.inc.php'; ?>
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
      Post name* :     <textarea name="Postname" rows="1" cols="80" id="postname" required ></textarea><br>
      Post caption* : <textarea name="Caption" rows="4" cols="80" id="caption" required></textarea><br>
      <input type="radio" name="Poststate" value="public" checked> Public
      <input type="radio" name="Poststate" value="private"> Private
      <input type="file" name="Postimage" value="post">
      <input type="hidden" name="Userid" value="<?php htmlout($userid);?>">
      <input type="submit" name="action" value="posting"><br>
    </form>
  </div>
</body>
