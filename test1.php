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
            <li><a href="test1.php">Team</a></li>
            <li><a href="coach.html">Coach</a></li>
            <li><a href="matches.html">Matches</a></li>
            <li><a href="players.html">Players</a></li>
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
        <ul id="teamList">
        </ul>

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

            // Use %LIKE% in SQL query for searching
            $sql = "SELECT `teamname`, `home_ground` FROM team WHERE teamname LIKE '%$searchTerm%'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table border='1'>";
                echo "<tr><th>Teamname</th><th>Home Ground</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["teamname"] . "</td>";
                    echo "<td>" . $row["home_ground"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<li>No teams found</li>";
            }
        }

        $conn->close();
        ?>
    
        <div class="manage-teams">
            <a href="ateam.html">Add Team</a> |
            <a href="dteam.html">Delete Team</a>
        </div>
    </div>
</body>
</html>
