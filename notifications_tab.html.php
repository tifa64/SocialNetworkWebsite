<?php
	$ini_array = parse_ini_file("config.ini");
	$path = $ini_array['path'];
	include_once $_SERVER['DOCUMENT_ROOT'].$path.
    '/includes/helpers.inc.php'; ?>

<head>
	<?php include $_SERVER['DOCUMENT_ROOT'].$path.'/includes/notifications.html.php'; ?>
	<script type="text/javascript" src="js/notifications_tab.js?<?php echo time(); ?>"></script>
	<link rel="stylesheet" type="text/css" href="css/notifications_tab.css?">
	<meta charset='utf-8'>
</head>
<body>
	<?php include $_SERVER['DOCUMENT_ROOT'].$path.'/includes/header.inc.html.php'; ?>
	<h3 id="main-title">Your Notifications</h3>
	<hr>
</body>	