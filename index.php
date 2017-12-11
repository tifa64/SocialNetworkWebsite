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
    if(!isset($_POST['username']) or $_POST['username']==' 'or !isset($_POST['password']) or $_POST['password'] == ''
        or !isset($_POST['email']) or $_POST['email'] == ''){
        $GLOBALS['SignupError'] = 'Please fill in missing fields';
        include'registration.html.php';
        exit();

    }
    try {
        $sql = 'SELECT COUNT(*) FROM user
          WHERE email=:email OR  user_name=:username' ;
        $s = $pdo->prepare($sql);
        $s->bindValue(':email', $_POST['email']);
        $s->bindValue(':username',$_POST['username']);
        $s->execute();
    }catch (PDOException $e){
        $error ='Cannot fetch for users from database';
        include 'error.html.php';
        exit();
    }
    $row = $s->fetch();
    if ($row[0] > 0){
        $GLOBALS['SignupError'] = 'email or username already exists !';
        unset($_SESSION['loggedIn']);
        unset($_SESSION['username']);
        unset($_SESSION['password']);
        include'registration.html.php';
        exit();
    }
    else {
        try {
            $username=$_POST['username'];
            $sql= "SELECT user_id FROM user WHERE  user_name ='$username' ";
            $result = $pdo->query($sql);
            $_SESSION['loggedIn'] = TRUE;
            $_SESSION['username'] = $_POST['username'];
            foreach ($result as $row){
                $_SESSION['userid']=$row['user_id'];
            }

        }
        catch (PDOException $e){
            $error="unable to fetch userid";
            include 'error.html.php';
            exit();
        }

        try{
            $sql ='INSERT INTO user SET 
                user_name=:username,
                reg_date=CURDATE(),
                email=:email,
                password=:password
                ';
            $s=$pdo->prepare($sql);
            $s->bindValue(':username',$_POST['username']);
            $s->bindValue(':email',$_POST['email']);
            $s->bindValue(':password',md5($_POST['password'].'database'));
            $s->execute();
        }catch (PDOException $e)
        {
            $error='cannot insert user into database !';
            include 'error.html.php';
            exit();
        }

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
    }



}
if ($_SESSION['loggedIn'] == TRUE){
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