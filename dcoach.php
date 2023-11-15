<?php
$host = "localhost";
$user = "root";
$password = '';
$db_name = "sports";

$conn = mysqli_connect($host, $user, $password, $db_name);

if(mysqli_connect_errno()) {
    die("Failed to connect with MySQL: ". mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $coachname = mysqli_real_escape_string($conn, $_POST['coachname']);
    
    $sql = "DELETE FROM coach WHERE coachname LIKE '%$coachname%'";

    if ($conn->query($sql) === TRUE) {
        $deletedRows = $conn->affected_rows;
        echo "$deletedRows coach(es) deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Coach</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
    <div class="taskbar">
        <ul>
            <li><a href="home.html">Home</a></li>
            <li><a href="test1.php">Team</a></li>
            <li><a href="coach.php">Coach</a></li>
            <li><a href="matches.php">Matches</a></li>
            <li><a href="players.php">Players</a></li>
            <li style="float: right;"><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="content">
        <h2>Delete Coach</h2>
        <form method="post" action="">
            <label for="coachname">Search and Delete Coach by Name:</label>
            <input type="text" id="coachname" name="coachname" required>

            <input type="submit" value="Delete Coach" class="button">
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
