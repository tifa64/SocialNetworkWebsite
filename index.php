<?php
/**
 * Created by PhpStorm.
 * User: abdullah
 * Date: 24/10/17
 * Time: 09:15 م
 */
include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/magicquotes.inc.php';
session_start();
if(isset($_POST['action']) and $_POST['action']=='Logout'){
    $_SESSION['loggedIn']=FALSE;
    unset($_SESSION['email']);
    include'registration.html.php';
    exit();
}
if(isset($_POST['action']) and $_POST['action'] == 'Search') {
    include 'search_results.php';
    exit();
}
if (isset($_POST['action']) and $_POST['action'] == 'login') {
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
    if(!isset($_POST['email']) or $_POST['email']==' 'or !isset($_POST['password']) or $_POST['password'] == '' ){
        $GLOBALS['SignupError'] = 'Please fill in missing fields';
        include'registration.html.php';
        exit();}
    try
    {$password= md5($_POST['password'].'database');
        $sql = 'SELECT * FROM user
WHERE email= :email ';
        $s = $pdo->prepare($sql);
        $s->bindValue(':email', $_POST['email']);
        $s->execute();
    }
    catch (PDOException $e)
    {
        $error = 'Error searching for user.';
    }
    $row = $s->fetch();
    if ($row['password']==$password)
    {

        $_SESSION['loggedIn'] = TRUE;
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['userid'] = $row['user_id'];
        if($row['nick_name'] !== NULL)
            $_SESSION['nickname'] = $row['nick_name'];
        else
            $_SESSION['nickname'] = $row['first_name'].' '.$row['last_name'];
        // FETCHING POSTS THEN CALLING NEWSFEED TEMPLATE
        include 'newsfeed.html.php';
        exit();
    }
    else{
        $GLOBALS['SignupError']="Wrong username or password !";
        include 'registration.html.php';
        exit();
    }
}
if (isset($_POST['action']) and $_POST['action'] == 'SignUp')
{
    include $_SERVER['DOCUMENT_ROOT'].'/includes/db.inc.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';
    if(!isset($_POST['firstname']) or $_POST['firstname']==' 'or !isset($_POST['password']) or $_POST['password'] == ''
        or !isset($_POST['email']) or $_POST['email'] == ''){
        $GLOBALS['SignupError'] = 'Please fill in missing fields';
        include'registration.html.php';
        exit();
    }
    try {
        $sql = 'SELECT COUNT(*) FROM user
          WHERE email=:email ' ;
        $s = $pdo->prepare($sql);
        $s->bindValue(':email', $_POST['email']);
        $s->execute();
    }catch (PDOException $e){
        $error ='Cannot fetch for users from database';
        include 'error.html.php';
        exit();
    }
    $row = $s->fetch();
    if ($row[0] > 0){
        $GLOBALS['SignupError'] = 'email  already exists !';
        unset($_SESSION['loggedIn']);
        unset($_SESSION['password']);
        unset(  $_SESSION['userid']);
        include'registration.html.php';
        exit();
    }
    unset($_SESSION['email']);
    try{
        $sql ='INSERT INTO user SET
                first_name=:firstname,
                last_name=:lastname,
                reg_date=CURDATE(),
                email=:email,
                gender=:gender,
                password=:password
                ';
        $s=$pdo->prepare($sql);
        $s->bindValue(':firstname',$_POST['firstname']);
        $s->bindValue(':lastname',$_POST['lastname']);
        $s->bindValue(':email',$_POST['email']);
        $s->bindValue(':password',md5($_POST['password'].'database'));
        $s->bindValue(':gender',$_POST['gender']);
        $s->execute();
    }catch (PDOException $e)
    {
        $error='cannot insert user into database !';
        include 'error.html.php';
        exit();
    }
    if (isset($_POST['status']) and $_POST['status']!=NULL)
        try {
            $sql='UPDATE user
                  SET martial_status =:status
                  WHERE  email=:email';
            $s=$pdo->prepare($sql);
            $s->bindValue(':email',$_POST['email']);
            $s->bindValue(':status',$_POST['status']);
            $s->execute();
        }
        catch (PDOException $e){
            $error='cannot insert status';
            include 'error.html.php';
            exit();
        }
    if (isset($_POST['hometown']) and $_POST['hometown']!=NULL )
        try {
            $sql='UPDATE user
                  SET home_town =:hometown
                  WHERE  email=:email';
            $s=$pdo->prepare($sql);
            $s->bindValue(':email',$_POST['email']);
            $s->bindValue(':hometown',$_POST['hometown']);
            $s->execute();
        }
        catch (PDOException $e){
            $error='cannot insert hometown';
            include 'error.html.php';
            exit();
        }
    if (isset($_POST['aboutme']) and $_POST['aboutme']!=NULL )
        try {
            $sql='UPDATE user
                  SET about_me =:aboutme
                  WHERE  email=:email';
            $s=$pdo->prepare($sql);
            $s->bindValue(':email',$_POST['email']);
            $s->bindValue(':aboutme',$_POST['aboutme']);
            $s->execute();
        }
        catch (PDOException $e){
            $error='cannot insert aboutme';
            include 'error.html.php';
            exit();
        }
    if (isset($_POST['nickname']) and $_POST['nickname']!=NULL )
        try {
            $sql='UPDATE user
                  SET nick_name =:nickname
                  WHERE  email=:email';
            $s=$pdo->prepare($sql);
            $s->bindValue(':email',$_POST['email']);
            $s->bindValue(':nickname',$_POST['nickname']);
            $s->execute();
        }
        catch (PDOException $e){
            $error='cannot insert nickname';
            include 'error.html.php';
            exit();
        }
    if (isset($_POST['telNo1']) and $_POST['telNo1']!=NULL){
        check_phone($pdo,$_POST['telNo1'],$_POST['email']);
        try {
            $sql=$sql=' INSERT INTO phone_numbers
                  SET phone_number =:phonenumber , user_id=(SELECT u.user_id FROM user u WHERE   u.email=:email)
                ';
            $s=$pdo->prepare($sql);
            $s->bindValue(':email',$_POST['email']);
            $s->bindValue(':phonenumber',$_POST['telNo1']);
            $s->execute();
        }
        catch (PDOException $e){
            $error='cannot insert phone number 1';
            include 'error.html.php';
            exit();
        }}
    if (isset($_POST['telNo2']) and $_POST['telNo2']!=NULL){
        check_phone($pdo,$_POST['telNo2'],$_POST['email']);
        try {
            $sql=' INSERT INTO phone_numbers
                  SET phone_number =:phonenumber , user_id=(SELECT u.user_id FROM user u WHERE   u.email=:email)
                ';
            $s=$pdo->prepare($sql);
            $s->bindValue(':email',$_POST['email']);
            $s->bindValue(':phonenumber',$_POST['telNo2']);
            $s->execute();
        }
        catch (PDOException $e){
            $error='cannot insert phone number 2';
            include 'error.html.php';
            exit();
        }}
    if (isset($_POST['telNo3']) and $_POST['telNo3']!=NULL){
        check_phone($pdo,$_POST['telNo3'],$_POST['email']);
        try {
            $sql=' INSERT INTO phone_numbers
                  SET phone_number =:phonenumber , user_id=(SELECT u.user_id FROM user u WHERE   u.email=:email)
                ';
            $s=$pdo->prepare($sql);
            $s->bindValue(':email',$_POST['email']);
            $s->bindValue(':phonenumber',$_POST['telNo3']);
            $s->execute();
        }
        catch (PDOException $e){
            $error='cannot insert phone number 3';
            include 'error.html.php';
            exit();
        }}

    $username = '';
    if (isset($_POST['nickname']) and $_POST['nickname']!=NULL ){
        $username=$_POST['nickname'];
    }
    else {
        $username=$_POST['firstname'].' '.$_POST['lastname'];
    }
    try {
        $sql=' SELECT user_id  FROM user  WHERE   email=:email';
        $s=$pdo->prepare($sql);
        $s->bindValue(':email',$_POST['email']);
        $s->execute();
        $result=$s->fetch();
    }
    catch (PDOException $e)
    {
        $error='cannot get userid ';
        include 'error.html.php';
        exit();
    }
    $_SESSION['loggedIn'] = TRUE;
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['userid']=$result['user_id'];
    $_SESSION['nickname'] = $username;
    setimage($pdo,$_POST['email'],$_POST['gender']);
    header('location:./welcome.html.php');
    exit();
}
if (isset($_POST['submit']) and $_POST['submit'] == "Upload Image"){
    include $_SERVER['DOCUMENT_ROOT'].'/includes/db.inc.php';
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        //echo "File is not an image.";
        $uploadOk = 0;
    }
    if (file_exists($target_file)) {
        //echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    if (file_exists($target_file)) {
        //echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        //echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        //echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            //echo "Sorry, there was an error uploading your file.";
        }
    }
    try {
        $sql= "UPDATE user SET  image_url =:url WHERE user_id=:id";
        $_SESSION['url']=$target_file;
        $s=$pdo->prepare($sql);
        $s->bindValue(':url',$target_file);
        $s->bindValue(':id',$_POST['userid']);
        $s->execute();
    }catch (PDOException $e){
        $error='Failed to set pp url';
        include 'error.html.php';
        exit();
    }
    include 'newsfeed.html.php';
    exit();
}

if(isset($_POST['action']) and $_POST['action']=='Posting') {
    include $_SERVER['DOCUMENT_ROOT'].'/includes/db.inc.php';
    include $_SERVER['DOCUMENT_ROOT'].'/includes/helpers.inc.php';
    try{
        $sql ='INSERT INTO posts SET
                title=:Postname,
                caption=:Caption,
                isPublic=:Poststate,
                user_id =:user_id,
                image_url=:Postimage,
                time=CURRENT_TIMESTAMP
                ';
        $s=$pdo->prepare($sql);
        $s->bindValue(':Postname',$_POST['Postname']);
        $s->bindValue(':Caption',$_POST['Caption']);
        $s->bindValue(':Poststate',$_POST['Poststate']);
        $s->bindValue(':user_id',  $_SESSION['userid']);
        $s->bindValue(':Postimage',$_POST['Postimage']);
        $s->execute();
    }catch (PDOException $e)
    {
        $error='cannot insert post into database !';
        include 'error.html.php';
        exit();
    }
    header('Location: .');
    exit();
}
if(isset($_POST['action']) and $_POST['action']=='DeletePost') {
  include $_SERVER['DOCUMENT_ROOT'].'/includes/helpers.inc.php';
  deletePost($pdo, $_POST['postid']);
  header('Location: .');
  exit();
}
if (isset($_SESSION['loggedIn'])and $_SESSION['loggedIn'] == TRUE){
    include $_SERVER['DOCUMENT_ROOT'].'/includes/db.inc.php';
    include 'newsfeed.html.php';
    // FETCHING POSTS AND SAVING THEM THEN LOADING NEWSFEED TEMPLATE
    exit();
}
include 'registration.html.php';
