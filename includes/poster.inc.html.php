<?php include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/helpers.inc.php'; ?>

<head>
    <title>Social Network</title>
    <link rel="stylesheet" type="text/css" href="css/styleNewsFeed.css">
</head>
<body>
<div class="header">
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
        <input type="radio" name="Poststate" value="public" id="Poststate" checked> Public
        <input type="radio" name="Poststate" value="private" id="Poststate"> Private
        <input type="file" name="Postimage" value="post" id="image">
        <input type="submit" name="action" value="Posting"><br>
        <?php
          display_posts ();
          $allPosts = $_SESSION['allPosts'];
          $size = count($allPosts);
          echo "First name ---- Last name ---- Title  ---- Caption ---- ImageURL";
          echo "<hr>";
          echo "<hr>";
          for($i = 0; $i < count($allPosts); $i++) {
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
          }
        ?>
    </form>
</div>
</body>
</html>
