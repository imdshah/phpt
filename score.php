<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scores Page</title>
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
            <li><a href="score.php">Scores</a></li>
            <li style="float: right;"><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="content">
        <h2>Scores List</h2>
        <?php
        $host = "localhost";
        $user = "root";
        $password = '';
        $db_name = "sports";

        $conn = mysqli_connect($host, $user, $password, $db_name);
        if(mysqli_connect_errno()) {
            die("Failed to connect with MySQL: ". mysqli_connect_error());
        }

        // Assuming the table name is 'scores'
        $sql = "SELECT * FROM score";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table border='1'>";
            echo "<tr><th>Match ID</th><th>Winning Team</th><th>Losing Team</th><th>Winning Team Score</th><th>Losing Team Score</th><th>Ground</th><th>Date</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["match_id"] . "</td>";
                echo "<td>" . $row["won_teamname"] . "</td>";
                echo "<td>" . $row["lost_teamname"] . "</td>";
                echo "<td>" . $row["won_teamscore"] . "</td>";
                echo "<td>" . $row["lost_teamscore"] . "</td>";
                echo "<td>" . $row["ground"] . "</td>";
                echo "<td>" . $row["date"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No scores found</p>";
        }

        $conn->close();
        ?>
    
        <div class="manage-scores">
                <a href="ascore.php">Add Score</a> |
                <a href="dscore.php">Delete Score</a> |
                <a href="uscore.php">Update Score</a>
        </div>
    </div>
</body>
</html>
