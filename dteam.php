<?php
$host = "localhost";
$user = "root";
$password = '';
$db_name = "sports";

$conn = mysqli_connect($host, $user, $password, $db_name);

if(mysqli_connect_errno()) {
    die("Failed to connect with MySQL: ". mysqli_connect_error());
}

$j = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form submission, process the data and delete from the database
    $teamname = mysqli_real_escape_string($conn, $_POST['teamname']);

    // Perform the SQL query to delete the team from the 'team' table
    $sql = "DELETE FROM team WHERE teamname LIKE '%$teamname%'";

    if ($conn->query($sql) === TRUE) {
        $j = 1;
        echo "Team(s) deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$sql = "SELECT * FROM team";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Team</title>
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
        <h2>Delete Team</h2>
        <form method="post" action="">
            <label for="teamname">Search and Delete Team by Name:</label>
            <input type="text" id="teamname" name="teamname" required>

            <input type="submit" value="Delete Team" class="button">
        </form>

        <?php
        if ($j > 0) {
            // Display teams after successfully deleting a team
            echo "<h2>Team List</h2>";
            if ($result->num_rows > 0) {
                echo "<table border='1' style='width: 100%; border-collapse: collapse;'>";
                echo "<tr style='background-color: #f2f2f2;'><th>Team ID</th><th>Coach ID</th><th>Team Name</th><th>Captain Name</th><th>Home Ground</th><th>Team Logo</th></tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td style='text-align: center;'>" . $row["team_id"] . "</td>";
                    echo "<td style='text-align: center;'>" . $row["coach_id"] . "</td>";
                    echo "<td style='text-align: center;'>" . $row["teamname"] . "</td>";
                    echo "<td style='text-align: center;'>" . $row["captainname"] . "</td>";
                    echo "<td style='text-align: center;'>". $row["home_ground"] . "</td>";
                    echo "<td style='text-align: center;'><img src='images/" . $row["image"] . "' alt='Team Logo' style='width: 80px; height: 80px;'></td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "<p>No teams found</p>";
            }
        }
        ?>

    </div>
</body>
</html>

<?php
$conn->close();
?>
