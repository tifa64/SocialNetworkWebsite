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
function get_profile_info ($pdo,$id){
    global $posts ;
    global $user_info;
    $posts=array();
    $user_info=array();

    try {
        $sql='SELECT * FROM posts WHERE  
          user_id = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $id);
        $s->execute();
    }catch (PDOException $e){
        $error='canot get posts for profiles !';
        include 'error.html.php';
        exit();}
    $result=$s->fetchAll();
    foreach ($result as $row){
        $posts[]=array('publicity'=>$row['isPublic'] ,'caption'=>$row['caption'],'time'=>$row['time']);
    }

    try {
        $sql='SELECT * FROM user WHERE
              user_id=:id';
        $s=$pdo->prepare($sql);
        $s->bindValue(':id', $id);
        $s->execute();
    }catch (PDOException $e){
        $error='canot get userinfo for profiles !';
        include 'error.html.php';
        exit();}

    $result=$s->fetchAll();
    foreach ($result as $row){
        $user_info[]=array('first_name'=>$row['first_name'] ,'last_name'=>$row['last_name'],'image_url'=>$row['image_url']
        ,'nick_name'=>$row['nick_name'] ,'birth_date'=>$row['birth_date'],'martial_status'=>$row['martial_status']
        ,'about_me'=>$row['about_me'],'gender'=>$row['gender'],'email'=>$row['email'],'home_town'=>$row['home_town']);



}
$userid=$id;
include $_SERVER['DOCUMENT_ROOT'] . '/profile.html.php';}
function display_posts(){
    $servername = "localhost";
    $username = "databaseuser";
    $password = "mypassword";
    $dbname = "newdatabase";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $result = $conn->query("SELECT * FROM posts ORDER BY time DESC") ;
    if ($result->num_rows > 0){
        while($row = $result->fetch_assoc())
        {
            // if the post is public or this post is mine show the posts
            if ($row['isPublic']== "Public" || ($row['isPublic']== "Private" && $row['user_id'] == $_SESSION['userid']) ){
                $usersinfo = $conn->query("SELECT * FROM user WHERE user_id = '".$row['user_id']."'");
                $rowuser = $usersinfo->fetch_assoc();
                echo $rowuser['first_name']." ".$rowuser['last_name']."<br>" ;
                echo $row['title']."<br>";
                echo $row['caption']."<br>";
                if($row['image_url'] != NULL){
                    $img = $row['image_url'];
                    echo '<img src="images/'.$img.'">';
                }
                echo "<hr>";
            }else if ($row['isPublic']== "Private") {
                // the post is private but the two users are friends
                $friends = $conn->query("SELECT *
                                                 FROM friendships
                                                 WHERE  user_id1 = ".$row['user_id']." and user_id2 = ".$_SESSION['userid']."
                                                 or (user_id2 = ".$row['user_id']." and user_id1 = ".$_SESSION['userid'].") ");
                //echo $friends . "here <br>" ;
                if ($friends && $friends->num_rows >0) {
                    $usersinfo = $conn->query("SELECT * FROM user WHERE user_id = '".$row['user_id']."'");
                    $rowuser = $usersinfo->fetch_assoc();
                    echo $rowuser['first_name']." ".$rowuser['last_name']."<br>" ;
                    echo $row['title']."<br>";
                    echo $row['caption']."<br>";
                    echo "<hr>";
                }else {echo "not friends";
                    echo  " <br>Query failed: " . mysqli_error($conn)."<br>";}
            }
        }
    }else {
        echo "zero rows";
    }}
function check_friendship ($pdo,$id1,$id2){
    try{
        $sql='SELECT COUNT(*) FROM friendships WHERE (user_id1=:id1 AND user_id2=:id2) OR(user_id1=:id2 AND user_id2=:id1) ';
        $s=$pdo->prepare($sql);
        $s->bindValue(':id1', $id1);
        $s->bindValue(':id2', $id2);
        $s->execute();
    }catch (PDOException $e){
        $error ="cannot check friendships!";
        include 'error.html.php';
        exit();
    }
    $row = $s->fetch();
    if ($row[0] > 0){
        return TRUE ;
    }
    else {
    return FALSE ;
    }
}