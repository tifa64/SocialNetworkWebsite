<?php include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>
    <meta charset="UTF-8">
    <title>Social Network System</title>
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-theme.css" />
    <link rel="stylesheet" href="css/bootstrap-theme.min.css" />
    <script type="text/javascript" src="js/validation.js" > </script>
</head>
<body>
<br>
<div class="container">
        <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                        <h3 class="panel-title">Social Network System  </h3>
                        </div>
                        <div class="panel-body">
                        <form role="form" action="?login" method="post" onsubmit="return validatelogin()" id="login" >
                                <?php if (isset($SignupError)): ?>
                                <p><?php htmlout($SignupError); ?></p>
                                <?php endif; ?>
                                <?php if (isset($SignupError2)): ?>
                                <p><?php htmlout($SignupError2); ?></p>
                                <?php endif; ?>        
                            <div class="form-group">
                                <input type="email" name="email" id="email" value="" required class="form-control input-sm" placeholder="Email Address">
                            </div>                                
                            <div class="form-group">
                                 <input type="password" name="password" id="password" value="" required class="form-control input-sm" placeholder="Password">
                            </div>                                                
                            <input type="submit" name="action" value="login" class="btn btn-info btn-block">                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="container">
   <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                        <h3 class="panel-title">Sign up <small>It's free!</small></h3>
                 </div>
                        <div class="panel-body">
                        <form role="form" action ="?signup" method="post" onsubmit=""  id="signup"  onsubmit="return checkUsername_pass()">
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                            <input type="text" name="firstname" id="first_name" value="" onblur="checkUsername_pass()" required class="form-control input-sm" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="lastname" id="last_name" value="" onblur="checkUsername_pass()" required class="form-control input-sm" placeholder="Last Name">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" name="nickname" value="" id="nickname" class="form-control input-sm" placeholder="Nickname">
                            </div>

                            <div class="form-group">
                                <input id="telNo1" name="telNo1" type="tel"  pattern="[0-9]{3}-[0-9]{4}-[0-9]{4}"  class="form-control input-sm" placeholder="Phone number1( xxx-xxxx-xxxx)">
                            </div>
                            <div class="form-group">
                                <input id="telNo2" name="telNo2" type="tel"  pattern="[0-9]{3}-[0-9]{4}-[0-9]{4}" class="form-control input-sm" placeholder="Phone number2( xxx-xxxx-xxxx)">
                            </div>
                            <div class="form-group">
                                <input id="telNo3" name="telNo3" type="tel"  pattern="[0-9]{3}-[0-9]{4}-[0-9]{4}"  class="form-control input-sm" placeholder="Phone number3( xxx-xxxx-xxxx)">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" id="email" value="" onblur="checkUsername_pass()" required class="form-control input-sm" placeholder="Email Address">
                            </div>
                            <div class="form-group">
                                 <input type="password" name="password" id="password" value="" onblur="checkUsername_pass()" required class="form-control input-sm" placeholder="Password">
                            </div>
                            <div class="form-group">
                                 <input type="text" name="hometown" id="hometown" value="" class="form-control input-sm" placeholder="Home Town">
                            </div>                    
                            <div class="form-group">
                            <input type = "textarea" name="aboutme" cols="40" rows="6" id="aboutme" class="form-control input-sm" placeholder="Tell us more about you !" >
                            </div>
                <div>
                <div class="form-group">
                    <label class="control-label col-sm-4">Gender</label>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-8">
                                <label class="radio-inline">
                                    <input id="female" type="radio" name="gender" value="female" required id="femaleRadio" >Female
                                </label>
                            </div>
                            <div class="col-sm-6">
                                <label class="radio-inline">
                                     <input id="male" type="radio" name="gender" value="male" required" id="maleRadio">Male
                                </label>
                            </div>
                        </div>
                    </div>
                </div> <!-- /.form-group -->
                </div>
                <div>
                <div class="form-group">
                    <label class="control-label col-sm-4">Status</label>
                    <div class="col-sm-7">
                        <div class="row">
                            <div class="col-sm-8">
                                <label class="radio-inline">
                                    <input id="single" type="radio" name="status" value="single" >Single
                                </label>
                            </div>
                            <div class="col-sm-8">
                                <label class="radio-inline">
                                    <input id="Engaged" type="radio" name="status" value="engaged">Engaged
                                </label>
                            </div>
                            <div class="col-sm-8">
                                <label class="radio-inline">
                                   <input id="Married" type="radio" name="status" value="married">Married
                                </label>
                            </div>
                        </div>
                    

                </div>                
                <div class="">
                    <div class="form-group">                                  
                        <label >Date of birth  <input type="date" name="birthdate"  min="1900-01-01" max="2010-01-01" id="birthdate" required> </label>
                    </div>
                </div>
                            <input type="submit" name="action" value="SignUp" class="btn btn-info btn-block">
                        </form>
                    </div>
                </div>

</body>
</html>