<?php include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
<p><a href="./index.php">HomePage</a></p>
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
                <input type="submit" name="action" value="viewprofile"> </td>
        </tr>
    </form>
<?php endforeach ; ?>

<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/logout.inc.html.php'; ?></p>


</table>
</body>
</html>
