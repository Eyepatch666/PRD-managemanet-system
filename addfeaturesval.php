<?php
session_start();

if (!isset($_COOKIE['status'])) {
    header('Location: login.php?error=bad_request');
    exit;
}

$fname = $_POST['fname'];
$selectedSpecifications = $_POST['selectedSpecifications'];

if ($fname == "") {
    header('Location: addfeatures.php?error=null');
    exit;
} else {
    $con = mysqli_connect('localhost', 'root', '', 'finalb');
    if (!$con) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    $insertFeatureQuery = "INSERT INTO features (fname) VALUES ('$fname')";
    $result = mysqli_query($con, $insertFeatureQuery);

    if (!$result) {
        echo "Error inserting feature: " . mysqli_error($con);
        exit;
    }

    $insertedFeatureId = mysqli_insert_id($con);

    foreach ($selectedSpecifications as $specId) {
        $insertAssocQuery = "INSERT INTO featspec (fid, specid) VALUES ('$insertedFeatureId', '$specId')";
        $assocResult = mysqli_query($con, $insertAssocQuery);

        if (!$assocResult) {
            echo "Error inserting association: " . mysqli_error($con);
            exit;
        }
    }

    header('Location: addfeatures.php?message=success');
    exit;

    mysqli_close($con);
}
?>
