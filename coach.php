<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coach Page</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
    <div class="taskbar">
        <ul>
            <li><a href="home.html">Home</a></li>
            <li><a href="test1.php">Team</a></li>
            <li><a href="coach.php">Coach</a></li>
            <li><a href="matches.html">Matches</a></li>
            <li><a href="players.html">Players</a></li>
            <li style="float: right;"><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="content">
        <h2>Coach Search</h2>
        <form method="post" action="">
            <label for="coachName">Search by Coach Name:</label>
            <input type="text" id="coachName" name="coachName" placeholder="Enter coach name">
            <input type="submit" value="Search">
        </form>
    
        <h2>Coach List</h2>
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
            $searchTerm = $_POST['coachName'];

            //$sql = "SELECT * FROM coach WHERE coachname LIKE '%$searchTerm%'";
            $sql = "SELECT c.coach_id, c.coachname, c.coach_age, c.coach_type, c.team_id, c.experience_in_years, t.teamname FROM coach c JOIN team t ON c.team_id = t.team_id WHERE c.coachname LIKE '%$searchTerm%'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table border='1'>";
                echo "<tr><th>Coach ID</th><th>Coach Name</th><th>Coach Age</th><th>Coach Type</th><th>Team Name</th><th>Experience (years)</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["coach_id"] . "</a></td>";
                    echo "<td>" . $row["coachname"] . "</td>";
                    echo "<td>" . $row["coach_age"] . "</td>";
                    echo "<td>" . $row["coach_type"] . "</td>";
                    echo "<td>" . $row["teamname"] . "</td>";
                    echo "<td>" . $row["experience_in_years"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No coaches found</p>";
            }
        } else {
            // Display all coaches if no search is performed
            //$sql = "SELECT * FROM coach";
            $sql = "SELECT c.coach_id, c.coachname, c.coach_age, c.coach_type, c.team_id, c.experience_in_years, t.teamname FROM coach c JOIN team t ON c.team_id = t.team_id ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table border='1'>";
                echo "<tr><th>Coach ID</th><th>Coach Name</th><th>Coach Age</th><th>Coach Type</th><th>Team Name</th><th>Experience (years)</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["coach_id"] . "</a></td>";
                    echo "<td>" . $row["coachname"] . "</td>";
                    echo "<td>" . $row["coach_age"] . "</td>";
                    echo "<td>" . $row["coach_type"] . "</td>";
                    echo "<td>" . $row["teamname"] . "</td>";
                    echo "<td>" . $row["experience_in_years"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No coaches found</p>";
            }
        }

        $conn->close();
        ?>
    
        <div class="manage-teams">
            <a href="acoach.php">Add Coach</a> |
            <a href="dcoach.php">Delete Coach</a> |
            <a href="ucoach.php">Update Coach</a>
        </div>
    </div>
</body>
</html>
