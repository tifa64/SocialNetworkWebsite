<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form  action ="" method="post" onsubmit=""  id="editprofile">
	<fieldset>
  	<legend>Edit profile</legend>
      <label for="firstname">Firstname :<input type="text" name="firstname" id="firstname" value="" onblur="" > </label> <br/>
			<label for="lastname">Lastname :<input type="text" name="lastname" id="lastname" value="" onblur=""> </label> <br/>
			  <label for="nickname">Nickname:<input type="text" name="nickname"id="nickname" value=""> </label> <br/>
				Phone number1( xxx-xxxx-xxxx) :<input id="telNo1" name="telNo1" type="tel"><br/>
				Phone number2( xxx-xxxx-xxxx) :<input id="telNo2" name="telNo2" type="tel"><br/>
				Phone number3( xxx-xxxx-xxxx) :<input id="telNo3" name="telNo3" type="tel"><br/>
				<label for="email">Email :<input type="email" name="email" id="email" value="" onblur=""> </label><br/>
				Marital status:<input id="single" type="radio" name="status" value="single" > <label for="single">Single</label>
				<input id="Engaged" type="radio" name="status" value="engaged"> <label for="Engaged">Engaged</label>
				<input id="Married" type="radio" name="status" value="married"> <label for="Married">Married</label><br/>
				<label for="Hometown">Hometown :<input type="text" name="hometown"id="hometown" value=""> </label><br/>
				<label for="aboutme"> Tell us more about you !</label><br/>
				<textarea name="aboutme" cols="40" rows="6" id="aboutme">Here you go ...</textarea><br/>
    			Select image to upload:
    			<input type="file" name="fileToUpload" id="fileToUpload"><br/>
	</fieldset>
  <input type="submit" name="action" value="editProfile">
</form>
</body>
</html>
