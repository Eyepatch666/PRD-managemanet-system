<?php
session_start();
if (!isset($_COOKIE['status'])) {
    header('location: login.php?error=bad_request');
}

$con = mysqli_connect('localhost', 'root', '', 'finalb');
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

$userid = $_SESSION['user']['userid'];
$query = "SELECT username FROM user WHERE userid = '$userid'";
$result = mysqli_query($con, $query);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $username = isset($row['username']) ? $row['username'] : '';
} else {
    $username = '';
}
mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Analyst Home</title>
    <link rel="stylesheet" type="text/css" href="analysthomestyle.css">
</head>

<body>
    
    <table align="center">
    <tr>
        <td>
            <p style="text-align:left;">
                <?php echo "Logged in as " . $username . " | " ?>
            </p>
        </td>
    </tr>
    
    <tr>
        <td>
        <a href="addspec.php">Add Specs</a> 
        </td>
    </tr>

    <tr>
        <td>
        <a href="specs.php">Added Specifications</a> 
        </td>
    </tr>
    <tr>
        <td>
        <a href="addfeatures.php">Add Features</a> 
        </td>
    </tr>
    <tr>
        <td>
        <a href="addproject.php">Add Project</a> 
        </td>
    </tr>
    <tr>
        <td>
        <a href="logout.php">Logout</a> 
        </td>
    </tr>
    </table>
</body>

</html>