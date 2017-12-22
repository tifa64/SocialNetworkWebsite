<?php
    $ini_array = parse_ini_file("config.ini");
    $path = $ini_array['path']; 
    include_once $_SERVER['DOCUMENT_ROOT'].$path.
    '/includes/helpers.inc.php';
include_once $_SERVER['DOCUMENT_ROOT'].$path.
    '/includes/header.inc.html.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <?php include $_SERVER['DOCUMENT_ROOT'].$path.'/includes/notifications.html.php'; ?>
    <meta charset="UTF-8">
</head>
<body>
<?php if (!empty($my_friends)): ?>
<table>
    <tr >
        <th>Name</th>
        <th>Gender</th>
    </tr>

    <?php foreach ($my_friends as $friend): ?>
    <form action=" " method="get" >
        <tr>
            <td><?php htmlout($friend['friendname']) ;    ?></td>
            <td><?php htmlout($friend['gender']) ;    ?></td>
            <input type="hidden" name="i" value="<?php htmlout($friend['userid']);?>">
            <td>
                <input type="submit" name="action" value="Profile"> </td>
        </tr>
    </form>
<?php endforeach ; ?>

    <?php else :?>
    No Friends to show
<?php endif ;?>


</table>
</body>
</html>
