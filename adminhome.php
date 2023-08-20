<?php
session_start();

if (!isset($_COOKIE['status'])) {
    header('Location: login.php?error=bad_request');
    exit;
}

$con = mysqli_connect('localhost', 'root', '', 'finalb');
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM projects";
$result = mysqli_query($con, $query);

$projects = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $projects[] = $row;
    }
} else {
    echo "Error fetching projects: " . mysqli_error($con);
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Home</title>
    <link rel="stylesheet" type="text/css" href="adminhomestyle.css">
</head>
<body>
    <h1>Welcome, Admin!</h1>
    <h2>List of Projects:</h2>
    <ol>
        <?php foreach ($projects as $project) { ?>
            <li>
                <?php echo $project['pname']; ?> |
                <a href="viewproject.php?project_name=<?php echo urlencode($project['pname']); ?>">View</a>
            </li>
        <?php } ?>
    </ol>
    <br>
    <a href="logout.php">Logout</a>
</body>
</html>
