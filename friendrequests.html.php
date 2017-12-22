<?php include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
<p><a href="./index.php">HomePage</a></p>
<?php if (!isset($pending_friends) ):?>
<p> No FriendRequests YOU ARE LONELY ! </p>
<?php else :?>
<?php foreach ( $pending_friends   as $pending_friend): ?>
   <div>
       <p>Please Accept this poor Guy :<?php htmlout($pending_friend['sender_name']) ?><br/> Ps (Friend Requests aren't marriage proposals)</p>
       <form action=" " method="post" >
           <input type="hidden" name="pending_id" value="<?php htmlout($pending_friend['id']);?>">
           <input type="submit" name="action" value="Accept">
           <input type="submit" name="action" value="Decline">
       </form>

   </div>
<?php endforeach ; ?>

<?php endif;?>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/includes/logout.inc.html.php'; ?></p>


</table>
</body>
</html>

