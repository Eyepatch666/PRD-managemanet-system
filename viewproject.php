<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="vprjstyle.css">
    <title>Document</title>
</head>

<body>


    <?php
    $project_name = $_GET['project_name'];

    $con = mysqli_connect('localhost', 'root', '', 'finalb');
    if (!$con) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    $query = "SELECT p.pid, f.fname, s.specname, s.ustory, s.tag
          FROM projects p
          JOIN projfeat pf ON p.pid = pf.pid
          JOIN features f ON pf.fid = f.fid
          JOIN featspec fs ON f.fid = fs.fid
          JOIN spec s ON fs.specid = s.specid
          WHERE p.pname = '$project_name'";

    $result = mysqli_query($con, $query);

    if ($result) {
        echo "<html>";
        echo "<head>";
        echo "<title>View Project</title>";
        echo "<link rel='stylesheet' type='text/css' href='vprjstyle.css'>";
        echo "</head>";
        echo "<body>";
        echo "<h2>Project Name: $project_name</h2>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='feature-table'>";
            echo "<div class='feature-name'><strong>Feature Name:</strong> {$row['fname']}</div>";
            echo "<table class='spec-table'>";
            echo "<tr><th>Spec Name</th><th>User Story</th><th>Tag</th></tr>";
            echo "<tr>";
            echo "<td>{$row['specname']}</td>";
            echo "<td>{$row['ustory']}</td>";
            echo "<td>{$row['tag']}</td>";
            echo "</tr>";
            echo "</table>";
            echo "</div>";
        }
        echo "</body>";
        echo "</html>";
    } else {
        echo "Error: " . mysqli_error($con);
    }

    mysqli_close($con);
    ?>
    
        <p align="center"><a href="adminhome.php">Back</a> | <a href="logout.php">Logout</a></p>
</body>

</html>