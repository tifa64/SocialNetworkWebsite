<div class="header">
	<ul id="left-list">
        <li><a href=<?php echo '"'.$path.'"'?>>Home</a></li>
        <li><a href="#">Profile</a></li>
        <li><a href="notifications_tab.html.php">Notifications</a></li>
        <li><a href="#">Friend Requests</a></li>
	</ul>
	<ul id="right-list">
		<li><?php include $_SERVER['DOCUMENT_ROOT'].$path.'/includes/logout.inc.html.php'; ?></li>
		<li><?php include $_SERVER['DOCUMENT_ROOT'].$path.'/includes/search.inc.php'; ?></li>
	</ul>
</div>
