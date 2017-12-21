<div class="header">
	<ul id="left-list">
        <li><a href=<?php echo '"'.$path.'"'?>>Home</a></li>
        <li><form action="" method="post"><input type="submit" name="action" value="Profile"></form></li>
        <li><form action="" method="post"><div><input type="submit" name="action" value="Notifications"><span id="notifications-count">0</span></div></form></li>
        <li><form action="" method="post"><input type="submit" name="action" value="Friend Requests"></form></li>
	</ul>
	<ul id="right-list">
		<li><?php include $_SERVER['DOCUMENT_ROOT'].$path.'/includes/logout.inc.html.php'; ?></li>
		<li><?php include $_SERVER['DOCUMENT_ROOT'].$path.'/includes/search.inc.php'; ?></li>
	</ul>
</div>
