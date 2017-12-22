<script type="text/javascript" src="js/jquery-3.2.1.js"></script>
<script>
	var user_id = <?php echo $_SESSION["userid"]; ?>;
	var user_full_name = <?php echo '"'.$_SESSION['nickname'].'"'; ?>;
</script>
<script type="text/javascript" src="js/notifications.js?<?php echo time(); ?>"></script>
<link rel="stylesheet" href="css/notifications.css">
<link rel="stylesheet" href="css/navbar.css">