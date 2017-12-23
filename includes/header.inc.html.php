<?php
	$ini_array = parse_ini_file("config.ini");
	$path = $ini_array['path'];
	include_once $_SERVER['DOCUMENT_ROOT'].
    $path.'/includes/helpers.inc.php';
?>
<div class="header">
	<ul id="left-list">
        <li><a href=<?php echo '"'.$path.'"'?>>Home</a></li>
        <li><form action="./index.php" method="get"><input type="hidden" name="i" value="<?php htmlout($_SESSION['userid']);?>"><input type="submit" name="action" value="Profile"></form></li>
        <li><form action="" method="post"><div><input type="submit" name="action" value="Notifications"><span id="notifications-count">0</span></div></form></li>
        <li><form action="" method="post"><input type="submit" name="action" value="Friend Requests"></form></li>
	</ul>
	<ul id="right-list">
		<li><?php include $_SERVER['DOCUMENT_ROOT'].$path.'/includes/logout.inc.html.php'; ?></li>
		<li><?php include $_SERVER['DOCUMENT_ROOT'].$path.'/includes/search.inc.html.php'; ?></li>
	</ul>
</div>
