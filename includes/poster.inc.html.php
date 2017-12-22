<?php include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/helpers.inc.php'; ?>

<head>
    <title>Social Network</title>
    <link rel="stylesheet" type="text/css" href="css/posts.css">
</head>
<body>
<div class="header">
    <div id = "menu">
         <form action="?profile" method="get">
             <input id="profile" type="submit" name="loadprofile" value="<?php htmlout( $_SESSION['nickname']) ?>"><br>
        </form>
    </div>
</div>
<div class="post" >
    <form action="" method="post">
        Post name* :     <textarea name="Postname" rows="1" cols="80" id="Postname" required ></textarea><br>
        Post caption* : <textarea name="Caption" rows="4" cols="80" id="Caption" required></textarea><br>
        <input type="radio" name="Poststate" value="public" id="Poststate" checked> Public
        <input type="radio" name="Poststate" value="private" id="Poststate"> Private
        <input type="file" name="Postimage" value="post" id="image">
        <input type="hidden" name="Userid" value="<?php htmlout($userid);?>">
        <input type="submit" name="action" value="Posting"><br>
        <?php
          display_posts ();
        ?>
    </form>
</div>

</body>
</html>
