<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Details</title>
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

    <?php
    // Assuming you have a database connection established and the necessary functions to fetch data
    $host = "localhost";
    $user = "root";
    $password = '';
    $db_name = "sports";

    $conn = mysqli_connect($host, $user, $password, $db_name);

    if(mysqli_connect_errno()) {
        die("Failed to connect with MySQL: ". mysqli_connect_error());
    }

    // Check if team_id is set in the query string
    if (isset($_GET['team_id'])) {
        $team_id = $_GET['team_id'];

        // Fetch team details based on team_id using a JOIN
        $sql = "SELECT t.team_id, t.coach_id, teamname, t.captainname, home_ground, image,
                p.player_id, playername, p.age, country, type, style, p.team_id,
                c.coach_id, c.coachname, c.coach_age, c.coach_type, c.team_id, c.experience_in_years
                FROM team t
                JOIN coach c ON t.team_id = c.team_id
                JOIN players p ON t.team_id = p.team_id
                WHERE t.team_id = '$team_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h2>Team Details</h2>";

            // Display Players Table
            echo "<h3>Players</h3>";
            echo "<table border='1' style='width: 100%; border-collapse: collapse;'>";
            echo "<tr style='background-color: #f2f2f2;'>
                    <th>Player ID</th>
                    <th>Player Name</th>
                    <th>Player Age</th>
                    <th>Country</th>
                    <th>Player Type</th>
                    <th>Player Style</th>
                    </tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td style='padding: 5px; text-align: center;'>" . $row["player_id"] . "</td>";
                echo "<td style='padding: 5px; text-align: center;'>" . $row["playername"] . "</td>";
                echo "<td style='padding: 5px; text-align: center;'>" . $row["age"] . "</td>";
                echo "<td style='padding: 5px; text-align: center;'>" . $row["country"] . "</td>";
                echo "<td style='padding: 5px; text-align: center;'>" . $row["type"] . "</td>";
                echo "<td style='padding: 5px; text-align: center;'>" . $row["style"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";

            // Display Coaches Table
            echo "<h3>Coaches</h3>";
            echo "<table border='1' style='width: 100%; border-collapse: collapse;'>";
            echo "<tr style='background-color: #f2f2f2;'>
                    <th>Coach ID</th>
                    <th>Coach Name</th>
                    <th>Coach Age</th>
                    <th>Coach Type</th>
                    <th>Experience (years)</th>
                    </tr>";

            $result->data_seek(0); // Reset result pointer to fetch data again
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td style='padding: 5px; text-align: center;'>" . $row["coach_id"] . "</td>";
                echo "<td style='padding: 5px; text-align: center;'>" . $row["coachname"] . "</td>";
                echo "<td style='padding: 5px; text-align: center;'>" . $row["coach_age"] . "</td>";
                echo "<td style='padding: 5px; text-align: center;'>" . $row["coach_type"] . "</td>";
                echo "<td style='padding: 5px; text-align: center;'>" . $row["experience_in_years"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No team found with the given ID.";
        }
    } else {
        echo "Invalid request. Please provide a team_id.";
    }

    $conn->close();
    ?>
</body>
</html>
