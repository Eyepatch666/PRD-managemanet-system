<?php 
   function getAllConts(){
    $con = mysqli_connect('localhost', 'root', '', 'finalb');
    $sql = "select * from spec";
    $result = mysqli_query($con, $sql);
    $users = [];

    while($row = mysqli_fetch_assoc($result)){
        array_push($users, $row);
    }

    return $users;
}

    $allconts = getAllConts();

?>


<html lang="en">
<head>
    <title>Spec</title>
    <link rel="stylesheet" type="text/css" href="specliststyle.css">

</head>
<body>
    <br><br>

        <p align="center"><a href="analysthome.php"> Back </a> |
        <a href="logout.php"> Logout </a></p>
        <br><br>

        <table border="1">
            <tr>
                <td>Specification</td>
                <td>User Story</td>
                <td>Acceptance Criteria</td>
                <td>Tag</td>
            </tr>
            <?php for($i=0; $i < count($allconts); $i++){ ?>
            <tr>
                <td><?=$allconts[$i]['specname']?></td>
                <td><?=$allconts[$i]['ustory']?></td>
                <td><?=$allconts[$i]['ac']?></td>
                <td><?=$allconts[$i]['tag']?></td>
                <td> 
                    <a href="edit.php?id=<?=$allconts[$i]['specid']?>">Edit</a> | 
                    <a href="delete.php?id=<?=$allconts[$i]['specid']?>">Delete</a> 
                </td>
            </tr>
            <?php } ?>

        </table>
</body>
</html>
