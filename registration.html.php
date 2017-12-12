<?php include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<<<<<<< HEAD
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>
    <meta charset="UTF-8">
    <title>Social Network System</title>
  <!-- <link rel="stylesheet" href="css/style.css" /> -->
</head>
<body>
<div id ="page">
        <h1> Social Network System </h1>
=======
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div id ="page">
        <h1> Registration System </h1>
    <div id="first">
>>>>>>> 3789c86d3020d1cd2ecff32793f4a72f98a4f647
        <button onclick="show_hide_login()" id="login_button">login?</button>
<form  action="?login" method="post" onsubmit="return validatelogin()" id="login">
    <?php if (isset($SignupError)): ?>
        <p><?php htmlout($SignupError); ?></p>
    <?php endif; ?>
    <fieldset>
        <legend>Login</legend>
<<<<<<< HEAD
     <div>  <label for="email">Email:<input type="email" name="email" id="email1" value="" required > </label></div>
       <div> <label for="password">Password:<input type="password" name="password"id="password1" value="" required></label></div>
        <input type="submit" name="action" value="login">
    </fieldset>
</form>
        <button onclick="show_hide_signup()" id="signup_button">singup?</button>

<form  action ="?signup" method="post" onsubmit=""  id="signup"  onsubmit="return checkUsername_pass()">
    <fieldset>
        <legend>Sign up</legend>
        <label for="firstname">Firstname *:<input type="text" name="firstname" id="firstname" value="" onblur="checkUsername_pass()" required> </label>
        <div id="feedback_user"> </div>
        <label for="lastname">Lastname *:<input type="text" name="lastname" id="lastname" value="" onblur="checkUsername_pass()" required> </label>
        <div id="feedback_user1"> </div>
        <label for="nickname">Nickname:<input type="text" name="nickname"id="nickname" value=""> </label> <br/>
        Phone number1( xx-xxxx-xxxx) :<input id="telNo1" name="telNo1" type="tel"  pattern="[0-9]{3}-[0-9]{4}-[0-9]{4}"><br/>
        Phone number2( xx-xxxx-xxxx) :<input id="telNo2" name="telNo2" type="tel"  pattern="[0-9]{3}-[0-9]{4}-[0-9]{4}"><br/>
        Phone number3( xx-xxxx-xxxx) :<input id="telNo3" name="telNo3" type="tel"  pattern="[0-9]{3}-[0-9]{4}-[0-9]{4}"><br/>
        <label for="password">Password *:<input type="password" name="password"id="password" value="" onblur="checkUsername_pass()" required> </label>
        <div id="feedback_pass"> </div>
        <label for="email">Email *:<input type="email" name="email" id="email" value="" onblur="checkUsername_pass()" required> </label><br/>
        <div id="feedback_email"> </div>
        Gender *:<input id="female" type="radio" name="gender" value="female" required><label for="female">Female</label>
        <input id="male" type="radio" name="gender" value="male" required> <label for="male">Male</label> <br/>
        Marital status:<input id="single" type="radio" name="status" value="single" > <label for="single">Single</label>
        <input id="Engaged" type="radio" name="status" value="engaged"> <label for="Engaged">Engaged</label>
        <input id="Married" type="radio" name="status" value="married"> <label for="Married">Married</label><br/>
        <label for="Birthdate">Birthdate *:<input type="date" name="birthdate"  min="1900-01-01" max="2010-01-01" id="birthdate" required> </label> <br/>
        <label for="Hometown">Hometown :<input type="text" name="hometown"id="hometown" value=""> </label><br/>
        <label for="aboutme"> Tell us more about you !</label><br/>
        <textarea name="aboutme" cols="40" rows="6" id="aboutme">Here you go ...</textarea><br/>
        <input type="submit" name="action" value="SignUp">
    </fieldset>
</form>

=======
     <div>  <label for="username">Username:<input type="text" name="username" id="username1" value="" > </label></div>
       <div> <label for="password">Password:<input type="password" name="password"id="password1" value=""></label></div>
        <input type="submit" name="action" value="login">
    </fieldset>
</form>
    </div>
    <div id="second">
        <button onclick="show_hide_signup()" id="signup_button">singup?</button>
<form  action ="?signup" method="post" onsubmit="return validatesignup()" id="signup">
    <fieldset>
        <legend>Sign up</legend>
        <label for="email">Email:</br>
            <input type="text" name="email" id="email" value="" onblur="checkUsername_pass()" > </label>
        <div id="feedback_email"> </div>
        <label for="username">Username:<input type="text" name="username" id="username" value="" onblur="checkUsername_pass()"> </label>
        <div id="feedback_user"> </div>
        <label for="password">Password:<input type="password" name="password"id="password" value="" onblur="checkUsername_pass()"> </label>
        <div id="feedback_pass"> </div>
        <input type="submit" name="action" value="SignUp">
    </fieldset>
</form>
    </div>
    </div>
>>>>>>> 3789c86d3020d1cd2ecff32793f4a72f98a4f647
<script type="text/javascript" src="/js/validation.js" > </script>
</body>
</html>