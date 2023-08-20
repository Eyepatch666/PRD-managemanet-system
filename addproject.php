<?php
function featureName(){
    $conn=mysqli_connect('localhost', 'root', '', 'finalb');
    $sql="SELECT fname FROM features";
    $result=mysqli_query($conn,$sql);
    return $result;
}
$result=featureName();

$message = $_GET['message'] ?? '';
if (!isset($message)) 
if ($message=== 'success'){
    echo "<p>added failed.</p>";
}else{
    echo "<p>addition was a success.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Project Page</title>
    <link rel="stylesheet" type="text/css" href="projstyle.css">
</head>
<body>
    <p align="center">Create Project</p>
    <form action="addprojectval.php" method="post">
        <table align="center">
            <tr>
                <td class="label">Project Name:</td>
            </tr>
            <tr>
                <td><input type="text" name="projectname"></td>
            </tr>
            <tr>
                <td>List of Features:</td>
            </tr>
            <tr>
                <td>
                    <select name="selectedFeatures[]" multiple>
                        <?php
                        if(mysqli_num_rows($result) > 0){
                            $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
                            foreach($options as $option){
                                echo "<option value='{$option['fname']}'>{$option['fname']}</option>";
                            }
                        } else {
                            echo "<option value='' disabled>No Feature Found</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><br></td>
            </tr>
            <tr align="right">
                <td><input type="submit" name="submit" value="Create Project"></td>
            </tr>
            <a href="analysthome.php">Back</a> | <a href="logout.php">Logout</a>
        </table>
    </form>
</body>
</html>
