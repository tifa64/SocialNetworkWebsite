<?php include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Social Network</title>
</head>
<body>
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
  			<textarea name="postname" rows="1" cols="80" ></textarea><br>
  			<textarea name="caption" rows="4" cols="80" ></textarea><br>
  			<input type="radio" name="poststate" value="public" checked> Public
  			<input type="radio" name="poststate" value="private"> Private
  			<input type="file" name="postimage" value="post">
  			<input type="submit" name="post" value="post"><br>
  		</form>
  	</div>
  </body>
<p> MOSTAFA GOES HERE </p>
<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/logout.inc.html.php'; ?></p>
</body>
</html>
