<!DOCTYPE html>
<html>
<head>
  <?php
  $ini_array = parse_ini_file("config.ini");
  $path = $ini_array['path'];
  include $_SERVER['DOCUMENT_ROOT'].$path.'/includes/notifications.html.php';
  include_once $_SERVER['DOCUMENT_ROOT'].$path.'/includes/helpers.inc.php';
  ?>
	<title>Social Network</title>
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
	<?php include $_SERVER['DOCUMENT_ROOT'].$path.'/includes/header.inc.html.php';
	 ?>
	 <?php $uinfo = $_SESSION['info'] ;?>
<br>
<div class="container">
   <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-0 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">
                        <h3 class="panel-title">Edit Profile</h3>
                 </div>
                        <div class="panel-body">
                        <form  action ="" method="post" onsubmit=""  id="editprofile">
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                            <input type="text" name="firstname" id="firstname" value="" onblur=""  class="form-control input-sm" placeholder="First name: <?php htmlout($uinfo[0]['first_name']); ?> ">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="lastname" id="lastname" value="" onblur="" class="form-control input-sm" placeholder="Last name:<?php htmlout($uinfo[0]['last_name']); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" name="nickname" id="nickname" value="" class="form-control input-sm" placeholder="Nick name: <?php htmlout($uinfo[0]['nick_name']); ?>">
                            </div>

                            <div class="form-group">
                                <input id="telNo1" name="telNo1" type="tel" pattern="[0-9]{3}-[0-9]{4}-[0-9]{4}"  class="form-control input-sm" placeholder="Phone number1( xxx-xxxx-xxxx)">
                            </div>
                            <div class="form-group">
                                <input id="telNo2" name="telNo2" type="tel" pattern="[0-9]{3}-[0-9]{4}-[0-9]{4}" class="form-control input-sm" placeholder="Phone number2( xxx-xxxx-xxxx)">
                            </div>
                            <div class="form-group">
                                <input id="telNo3" name="telNo3" type="tel"  pattern="[0-9]{3}-[0-9]{4}-[0-9]{4}"  class="form-control input-sm" placeholder="Phone number3( xxx-xxxx-xxxx)">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" id="email" value="" onblur="" class="form-control input-sm" placeholder="<?php htmlout($uinfo[0]['email']); ?>">
                            </div>
                            <div class="form-group">
                                 <input type="password" name="password" id="password" value="" class="form-control input-sm" placeholder="Password">
                            </div>
                            <div class="form-group">
                                 <input type="text" name="hometown" id="hometown" value="" class="form-control input-sm" placeholder="Home Town: <?php htmlout($uinfo[0]['home_town']); ?>">
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
                <div class="form-group">
                    <input type="textarea"  name="aboutme" cols="40" rows="6" id="aboutme" class="form-control input-sm" placeholder="<?php htmlout($uinfo[0]['about_me']); ?>">
                 </div>
                <div class="">
                    <div class="form-group">
                        <label >Date of birth  <input type="date" name="birthdate"  min="1900-01-01" max="2010-01-01" id="birthdate" > </label>
                    </div>
                <div class="form-group">
                  <label> Upload Image <input type="file" name="fileToUpload" id="fileToUpload" class="form-control input-sm" placeholder="Nickname"> </label>
                </div>

                </div>
                            <input type="submit" name="action" value="editProfile" class="btn btn-info btn-block" style="    background-image: linear-gradient(to bottom,#4f4f4f 0,#4f4f4f 100%);    border-color: #4f4f4f; background-color: #4f4f4f;">
                        </form>
                    </div>
                </div>
</body>
</html>
