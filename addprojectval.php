<?php
session_start();

if (!isset($_COOKIE['status'])) {
    header('Location: login.php?error=bad_request');
    exit;
}

if (isset($_POST['submit'])) {
    $projectname = $_POST['projectname'];
    $selectedFeatures = $_POST['selectedFeatures'];

    if ($projectname == "" || empty($selectedFeatures)) {
        header('Location: addproject.php?error=null');
        exit;
    } else {
        $con = mysqli_connect('localhost', 'root', '', 'finalb');
        if (!$con) {
            die("Database connection failed: " . mysqli_connect_error());
        }

        $insertProjectQuery = "INSERT INTO projects (pname) VALUES ('$projectname')";
        $result = mysqli_query($con, $insertProjectQuery);

        if (!$result) {
            echo "Error inserting project: " . mysqli_error($con);
            exit;
        }

        $insertedProjectId = mysqli_insert_id($con);

        foreach ($selectedFeatures as $feature) {
            $getFidQuery = "SELECT fid FROM features WHERE fname = '$feature'";
            $fidResult = mysqli_query($con, $getFidQuery);

            if ($fidResult && mysqli_num_rows($fidResult) > 0) {
                $row = mysqli_fetch_assoc($fidResult);
                $fid = $row['fid'];
                $insertAssocQuery = "INSERT INTO projfeat (pid, fid) VALUES ('$insertedProjectId', '$fid')";
                $assocResult = mysqli_query($con, $insertAssocQuery);

                if (!$assocResult) {
                    echo "Error inserting association: " . mysqli_error($con);
                    exit;
                }
            } else {
                echo "Error retrieving fid for feature: $feature";
                exit;
            }
        }

        header('Location: addproject.php?message=success');
        exit;

        mysqli_close($con);
    }
}
?>
