<?php
session_start();

if (!isset($_COOKIE['status'])) {
    header('Location: login.php?error=bad_request');
    exit;
}

    $specname = $_POST['specname'];
    $ustory = $_POST['ustory'];
    $ac = $_POST['ac'];
    $tag = $_POST['tag']; 

    if ($specname == "" || $ustory == "" || $ac == "" || $tag == "") {
        header('Location: addspec.php?error=null');
        exit;
    } else {
        $con = mysqli_connect('localhost', 'root', '', 'finalb');
        if (!$con) {
            die("Database connection failed: " . mysqli_connect_error());
        }

        $query = "INSERT INTO spec (specname, ustory, ac, tag) VALUES ('$specname', '$ustory', '$ac', '$tag')";
        $result = mysqli_query($con, $query);

        if ($result) {
            header('Location: addspec.php?message=success');
            exit;
        } else {
            echo "Error: " . mysqli_error($con);
        }

        mysqli_close($con);
    }
?>
