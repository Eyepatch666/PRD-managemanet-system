<?php 
   function getAllConts(){
    $con = mysqli_connect('localhost', 'root', '', 'finalb');
    $sql = "select * from features";
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
    <title>Contentlist</title>
    <link rel="stylesheet" type="text/css" href="featliststyle.css">
</head>
<body>
<br><br>
        <p align="center"><a href="analysthome.php"> Back </a> |
        <a href="logout.php"> Logout </a></p>
        <br><br>

        <table border="1">
            <tr>
                <td>Features</td>
            </tr>
            <?php for($i=0; $i < count($allconts); $i++){ ?>
            <tr>
                <td><?=$allconts[$i]['fname']?></td>
                <td> 
                    <a href="edit.php?id=<?=$allconts[$i]['fid']?>">Edit</a> | 
                    <a href="delete.php?id=<?=$allconts[$i]['fid']?>">Delete</a>
                </td>
            </tr>
            <?php } ?>

        </table>
</body>
</html>
