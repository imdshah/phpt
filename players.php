<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Players Page</title>
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
        <h2>Players Search</h2>
        <form method="post" action="">
            <label for="playerName">Search by Player Name:</label>
            <input type="text" id="playerName" name="playerName" placeholder="Enter player name">
            <input type="submit" value="Search">
        </form>
    
        <h2>Players List</h2>
        <?php
        $host = "localhost";
        $user = "root";
        $password = '';
        $db_name = "sports";

        $conn = mysqli_connect($host, $user, $password, $db_name);
        if(mysqli_connect_errno()) {
            die("Failed to connect with MySQL: ". mysqli_connect_error());
        }

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $searchTerm = $_POST['playerName'];

            $sql = "SELECT * FROM players WHERE playername LIKE '%$searchTerm%'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table border='1'>";
                echo "<tr><th>Player ID</th><th>Player Name</th><th>Age</th><th>Country</th><th>Type</th><th>Style</th><th>Team ID</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["player_id"] . "</a></td>";
                    echo "<td>" . $row["playername"] . "</td>";
                    echo "<td>" . $row["age"] . "</td>";
                    echo "<td>" . $row["country"] . "</td>";
                    echo "<td>" . $row["type"] . "</td>";
                    echo "<td>" . $row["style"] . "</td>";
                    echo "<td>" . $row["team_id"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No players found</p>";
            }
        } else {
            // Display all players if no search is performed
            $sql = "SELECT * FROM players";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table border='1'>";
                echo "<tr><th>Player ID</th><th>Player Name</th><th>Age</th><th>Country</th><th>Type</th><th>Style</th><th>Team ID</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["player_id"] . "</a></td>";
                    echo "<td>" . $row["playername"] . "</td>";
                    echo "<td>" . $row["age"] . "</td>";
                    echo "<td>" . $row["country"] . "</td>";
                    echo "<td>" . $row["type"] . "</td>";
                    echo "<td>" . $row["style"] . "</td>";
                    echo "<td>" . $row["team_id"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No players found</p>";
            }
        }

        $conn->close();
        ?>
    
        <div class="manage-teams">
        <a class="button" href="aplayer.php">Add Player</a> |
        <a class="button" href="dplayer.php">Delete Player</a> |
        <a class="button" href="uplayer.php">Update Player</a>
        </div>
    </div>
</body>
</html>
