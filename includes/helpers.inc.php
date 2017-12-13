<?php
/**
 * Created by PhpStorm.
 * User: abdullah
 * Date: 19/10/17
 * Time: 12:07 ص
 */
function html($text){
    return htmlspecialchars($text,ENT_QUOTES,'utf-8');
}
function htmlout($text){
    echo html($text);
}
function check_phone ($pdo,$phonenumber,$email){
    try {
        $sql = 'SELECT COUNT(*) FROM phone_numbers
          WHERE phone_number=:phonenumber ' ;
        $s = $pdo->prepare($sql);
        $s->bindValue(':phonenumber', $phonenumber);
        $s->execute();
    }catch (PDOException $e){
        $error ='Cannot fetch for phonenumbers from database';
        include 'error.html.php';
        exit();
    }
    $row = $s->fetch();
    if ($row[0] > 0){
        try {
            $sql='DELETE  FROM user WHERE email =:email';
            $s = $pdo->prepare($sql);
            $s->bindValue(':email', $email);
            $s->execute();

        }
        catch (PDOException $e){
            $error = 'Error fetching user !' ;
            include  'error.html.php';
            exit();
            }
        $SignupError2 = 'Phone-number already exists !';
        unset($_SESSION['loggedIn']);
        unset($_SESSION['username']);
        unset($_SESSION['password']);
        include'registration.html.php';
        exit();
    }
}
function setimage ($pdo,$email,$gender){
    if ($gender =="male"){
        $sql="UPDATE user SET image_url='/images/male.jpg'  WHERE email =:email";
        $s = $pdo->prepare($sql);
        $s->bindValue(':email', $email);
        $s->execute();
    }
    else {
        $sql="UPDATE user SET image_url='/images/female.jpg'  WHERE email=:email";
        $s = $pdo->prepare($sql);
        $s->bindValue(':email', $email);
        $s->execute();
    }
}