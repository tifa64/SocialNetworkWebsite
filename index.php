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
        unset($_SESSION['username']);
        unset($_SESSION['password']);
        unset($_SESSION['departmentid']);
        include'registration.html.php';
        exit();
}
if (isset($_POST['action']) and $_POST['action'] == 'login') {
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
    if(!isset($_POST['username']) or $_POST['username']==' 'or !isset($_POST['password']) or $_POST['password'] == '' ){
        $GLOBALS['SignupError'] = 'Please fill in missing fields';
        include'registration.html.php';
        exit();}
    try
    {$password= md5($_POST['password'].'database');
        $sql = 'SELECT * FROM user
WHERE user_name = :username ';
        $s = $pdo->prepare($sql);
        $s->bindValue(':username', $_POST['username']);
      
        $s->execute();
    }
    catch (PDOException $e)
    {
        $error = 'Error searching for author.';

    }

    $row = $s->fetch();
    if ($row['password']==$password)
    {		
    		
            $_SESSION['loggedIn'] = TRUE;
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['departmentid']=$row['department_id'];
            if(!isset($_SESSION['departmentid']) and is_null($_SESSION['departmentid']) )
            {
          try {
            $sql='SELECT * FROM department ';
            $rows=$pdo->query($sql);
        }
        catch (PDOException $e){
            $error='cannot fetch departments from database';
            include 'error.html.php';
            exit();
        }
        foreach ($rows as $row){
            $dept[]=array('id'=>$row['dept_id'],'name'=>$row['name'],'description'=>$row['description']);
        }

        $username=$_POST['username'];
        include 'chooseDepartment.html.php';

        exit();
            }else {

            	  try {
      $sql='SELECT * FROM course WHERE  department_id=:depid';
        $s=$pdo->prepare($sql);
        $s->bindValue(':depid',$_SESSION['departmentid']);
        $s->execute();
    }catch (PDOException $e){
        $error='cannot get courses of this department';
        include 'error.html.php';
        exit();
    }
    $result=$s->fetchAll();
    foreach ($result as $row){
        $courses[]=array('name'=>$row['course_name'] ,'description'=>$row['course_description'],'credithours'=>$row['credit_hours'],
            'instructor'=>$row['instructor_name']);
    }
        include'courses.html.php';
        exit();
            }
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
<<<<<<< HEAD
=======
        unset($_SESSION['username']);
>>>>>>> 1433b5621d46e646c6aec5b78f9b310c2ef5221f
        unset($_SESSION['password']);
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
                  SET status =:status
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
                  SET hometown =:hometown
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
        if (isset($_POST['telNo1']) and $_POST['telNo1']!=NULL)
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
        }
    if (isset($_POST['telNo2']) and $_POST['telNo2']!=NULL)
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
        }




exit();

}
if (isset($_SESSION['loggedIn'])and $_SESSION['loggedIn'] == TRUE){
    include $_SERVER['DOCUMENT_ROOT'].'/includes/db.inc.php';
    try {
        $sql='SELECT * FROM user WHERE user_name =:username';
        $s=$pdo->prepare($sql);
        $s->bindValue(':username',$_SESSION['username']);
        $s->execute();
    }catch(PDOException $e){
        $error='cannot get info of logged in user';
        include 'error.html.php';
        exit();
    }


}

include 'registration.html.php';