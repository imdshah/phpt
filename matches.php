<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matches Page</title>
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
        <h2>Matches Search</h2>
        <form method="post" action="">
            <label for="matchDate">Search by Match Date:</label>
            <input type="text" id="matchDate" name="matchDate" placeholder="Enter match date">
            <input type="submit" value="Search">
        </form>
    
        <h2>Matches List</h2>
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
            $searchTerm = $_POST['matchDate'];

            $sql = "SELECT * FROM matches WHERE date LIKE '%$searchTerm%'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table border='1'>";
                echo "<tr><th>Match ID</th><th>Home Team ID</th><th>Away Team ID</th><th>Date</th><th>Ground</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["match_id"] . "</a></td>";
                    echo "<td>" . $row["hometeam_id"] . "</td>";
                    echo "<td>" . $row["awayteam_id"] . "</td>";
                    echo "<td>" . $row["date"] . "</td>";
                    echo "<td>" . $row["ground"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No matches found</p>";
            }
        } else {
            // Display all 
            //$sql = "SELECT * FROM matches";
            $sql = "SELECT m.match_id, m.hometeam_id, m.awayteam_id, m.date, m.ground, th.team_id AS hometeam_id, th.teamname AS hometeam_name, ta.team_id AS awayteam_id, ta.teamname AS awayteam_name FROM matches m JOIN team th ON m.hometeam_id = th.team_id  JOIN team ta ON m.awayteam_id = ta.team_id";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table border='1'>";
                echo "<tr><th>Match ID</th><th>Home Team Name</th><th>Away Team Name</th><th>Date</th><th>Ground</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["match_id"] . "</a></td>";
                    //echo "<td>" . $row["hometeam_id"] . "</td>";
                    echo "<td>" . $row["hometeam_name"] . "</td>";
                    
                    //echo "<td>" . $row["awayteam_id"] . "</td>";
                    echo "<td>" . $row["awayteam_name"] . "</td>";
    
                    echo "<td>" . $row["date"] . "</td>";
                    echo "<td>" . $row["ground"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No matches found</p>";
            }
        }

        $conn->close();
        ?>
    
        <div class="manage-teams">
        <a class="button" href="amatch.php">Add Match</a> 
        <a class="button" href="dmatch.php">Delete Match</a> 
        <a class="button" href="umatch.php">Update Match</a>
        </div>
    </div>
</body>
</html>
