<!DOCTYPE html>
<html>
<head>
   <?php include $_SERVER['DOCUMENT_ROOT'].$path.'/includes/notifications.html.php';?>
    <title></title>
</head>
<body>
<form  action ="" method="post"   id="editprofile">
	<fieldset>
  	<legend>Edit profile</legend>
      <label for="firstname">Firstname *:<input type="text" name="firstname" id="firstname" value="" onblur="" > </label>
	</fieldset>
  <input type="submit" name="action" value="editProfile">

</form>
</body>
</html>
