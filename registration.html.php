<?php include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
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
        <button onclick="show_hide_login()" id="login_button">login?</button>
<form  action="?login" method="post" onsubmit="return validatelogin()" id="login">
    <?php if (isset($SignupError)): ?>
        <p><?php htmlout($SignupError); ?></p>
    <?php endif; ?>
    <fieldset>
        <legend>Login</legend>
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
<script type="text/javascript" src="/js/validation.js" > </script>
</body>
</html>