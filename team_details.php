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

    // $team_id = $_POST['team_id'];
    // $coach_id = $_POST['coach_id'];
    // $teamname = $_POST['teamname'];
    // $captainname = $_POST['captainname'];
    // $home_ground = $_POST['home_ground'];

    // Fetch team details based on team_id
    $sql = "SELECT * FROM team WHERE team_id = '$team_id' ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Display team details in a table
        echo "<h2>Team Details</h2>";
        echo "<table border='1' style='width: 50%; border-collapse: collapse;'>";
        echo "<tr><th>Attribute</th><th>Value</th></tr>";
        
        echo "<tr><td>Team ID</td><td>" . $row['team_id'] . "</td></tr>";
        echo "<tr><td>Coach ID</td><td>" . $row['coach_id'] . "</td></tr>";
        echo "<tr><td>Team Name</td><td>" . $row['teamname'] . "</td></tr>";
        echo "<tr><td>Captain Name</td><td>" . $row['captainname'] . "</td></tr>";
        echo "<tr><td>Home Ground</td><td>" . $row['home_ground'] . "</td></tr>";
        // Add more details if needed

        // You can also display the team logo if it's stored in the database
        echo "<tr><td>Team Logo</td><td><img src='images/" . $row['image'] . "' alt='Team Logo'></td></tr>";

        echo "</table>";
    } else {
        echo "No team found with the given ID.";
    }
} else {
    echo "Invalid request. Please provide a team_id.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
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

    
</body>
</html>
