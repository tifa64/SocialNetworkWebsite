<?php
/**
 * Created by PhpStorm.
 * User: abdullah
 * Date: 19/10/17
 * Time: 12:07 ุต
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
            $sql='DELETE FROM user WHERE email =:email';
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

function get_profile_info ($pdo,$email){
    try {
        $sql='SELECT * FROM posts WHERE
          user_id = (SELECT user_id FROM user
                      WHERE  email=:email)';
        $s = $pdo->prepare($sql);
        $s->bindValue(':email', $email);
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
              email=:email';
        $s=$pdo->prepare($sql);
        $s->bindValue(':email', $email);
        $s->execute();
    }catch (PDOException $e){
        $error='canot get userinfo for profiles !';
        include 'error.html.php';
        exit();}
    $result=$s->fetchAll();
    foreach ($result as $row) {
        $user_info[] = array('first_name' => $row['first_name'], 'last_name' => $row['last_name'], 'image_url' => $row['image_url']
        , 'nick_name' => $row['nick_name'], 'birth_date' => $row['birth_date'], 'martial_status' => $row['martial_status']
        , 'about_me' => $row['about_me'], 'gender' => $row['gender'], 'email' => $row['email'], 'home_town' => $row['home_town']);
    }}
    function deletePost($pdo, $post_id) {
      include $_SERVER['DOCUMENT_ROOT'].'/includes/db.inc.php';
    try {
          $sql='DELETE FROM posts WHERE post_id =:post_id';
          $s = $pdo->prepare($sql);
          $s->bindValue(':post_id', $post_id);
          $s->execute();
      }
      catch (PDOException $e){
          $error = 'Error fetching post !' ;
          include  'error.html.php';
          exit();
          }
    }
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
    $allPosts[] = array();
    global $myPosts, $friendsPosts;
    if ($result->num_rows > 0){
            while($row = $result->fetch_assoc())
            {
                $usersinfo = $conn->query("SELECT * FROM user WHERE user_id = '".$row['user_id']."'");
                $rowuser = $usersinfo->fetch_assoc();
                // if the post is public
                if ($row['isPublic']== "Public" && $row['user_id'] != $_SESSION['userid']) {
                    $friendsPosts[] = array('first_name' => $rowuser['first_name'], 'last_name' => $rowuser['last_name'],
                    'title' => $row['title'], 'caption' => $row['caption'], 'post_id' => $row['post_id'], 'image_url' => $row['image_url']);
                }
                // or this post is mine show the posts
                else if($row['user_id'] == $_SESSION['userid']) {
                  $myPosts[] = array('first_name' => $rowuser['first_name'], 'last_name' => $rowuser['last_name'],
                  'title' => $row['title'], 'caption' => $row['caption'], 'post_id' => $row['post_id'], 'image_url' => $row['image_url']);
                }
                else if ($row['isPublic']== "Private" && $row['user_id'] != $_SESSION['userid']) {
                        // the post is private but the two users are friends
                        $friends = $conn->query("SELECT *FROM friendships
                        WHERE  user_id1 = ".$row['user_id']." and user_id2 = ".$_SESSION['userid']."
                        or (user_id2 = ".$row['user_id']." and user_id1 = ".$_SESSION['userid'].") ");
                       //echo $friends . "here <br>" ;
                        if ($friends && $friends->num_rows >0) {
                          $friendsPosts[] = array('first_name' => $rowuser['first_name'], 'last_name' => $rowuser['last_name'],
                          'title' => $row['title'], 'caption' => $row['caption'], 'post_id' => $row['post_id'], 'image_url' => $row['image_url']);
                        }
                        else {
                           mysqli_error($conn)."<br>";
                        }
                }
            }
            $allPosts = array_merge((array)$myPosts, (array)$friendsPosts);
            usort($allPosts, function ($item1, $item2) {
            if ($item1['post_id'] == $item2['post_id']) return 0;
                return $item2['post_id'] < $item1['post_id'] ? -1 : 1;
            });
            $_SESSION['allPosts'] = $allPosts;
            $_SESSION['myPosts'] = $myPosts;
            $_SESSION['friendsPosts'] = $friendsPosts;
    }else {
        echo "zero rows";
    }}
