<?php
session_start();
$username = $_POST['username'];
$password = $_POST['password'];

if ($username == "" || $password == "") {
    header('Location: login.php?error=null');
    exit();
}

$con = mysqli_connect('localhost', 'root', '', 'finalb');
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
$status = mysqli_query($con, $sql);

if ($status && mysqli_num_rows($status) > 0) {
    $row = mysqli_fetch_assoc($status);
    $user = $row;
    $_SESSION['user'] = $user;
    if ($row['role'] === 'admin') {
        setcookie('status', 'true', time() + 3600, '/');
        header('Location: adminhome.php');
        exit();
    } else {
        setcookie('status', 'true', time() + 3600, '/');
        header('Location: analysthome.php');
        exit();
    }
} else {
    header('Location: login.php?error=invalid');
    exit();
}



mysqli_close($con);
?>