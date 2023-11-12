<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Page</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
    <div class="taskbar">
        <ul>
            <li><a href="home.html">Home</a></li>
            <li><a href="team.php">Team</a></li>
            <li><a href="coach.php">Coach</a></li>
            <li><a href="matches.php">Matches</a></li>
            <li><a href="players.php">Players</a></li>
            <li style="float: right;"><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="content">
        <h2>Team Search</h2>
        <form method="post" action="">
            <label for="teamName">Search by Team Name:</label>
            <input type="text" id="teamName" name="teamName" placeholder="Enter team name">
            <input type="submit" value="Search">
        </form>
    
        <h2>Team List</h2>
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
            $searchTerm = $_POST['teamName'];

            
            $sql = "SELECT `team_id`, `teamname`, `captainname`, `home_ground` FROM team WHERE teamname LIKE '%$searchTerm%'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table border='1'>";
                echo "<tr><th>Teamname</th><th>Captain Name</th><th>Home Ground</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><a href='team_details.php?team_id={$row["team_id"]}'>" . $row["teamname"] . "</a></td>";
                    echo "<td>" . $row["captainname"] . "</td>";
                    echo "<td>" . $row["home_ground"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No teams found</p>";
            }
        } else {
            // Display all teams if no search is performed
            $sql = "SELECT `team_id`, `teamname`, `captainname`, `home_ground` FROM team";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table border='1'>";
                echo "<tr><th>Teamname</th><th>Captain Name</th><th>Home Ground</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><a href='team_details.php?team_id={$row["team_id"]}'>" . $row["teamname"] . "</a></td>";
                    echo "<td>" . $row["captainname"] . "</td>";
                    echo "<td>" . $row["home_ground"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No teams found</p>";
            }
        }

        $conn->close();
        ?>
    
        <div class="manage-teams">
            <a href="ateam.php">Add Team</a> |
            <a href="dteam.php">Delete Team</a> |
            <a href="uteam.php">Update Team</a>
        </div>
    </div>
</body>
</html>
