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
    // Form submission, process the data and update the database
    $player_id = $_POST['player_id'];
    $playername = $_POST['playername'];
    $age = $_POST['age'];
    $country = $_POST['country'];
    $type = $_POST['type'];
    $style = $_POST['style'];
    $team_id = $_POST['team_id'];

    // Perform the SQL query to update data in the 'players' table
    $sql = "UPDATE players SET playername = '$playername', age = '$age', country = '$country', type = '$type', style = '$style', team_id = '$team_id' WHERE player_id = '$player_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Player updated successfully";
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
    <title>Update Player</title>
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
        <h2>Update Player</h2>
        <form method="post" action="">
            <label for="player_id">Player ID:</label>
            <input type="text" id="player_id" name="player_id" required>

            <label for="playername">Player Name:</label>
            <input type="text" id="playername" name="playername" required>

            <label for="age">Age:</label>
            <input type="text" id="age" name="age" required>

            <label for="country">Country:</label>
            <input type="text" id="country" name="country" required>
<p>
            <label for="type">Type:</label>
            <input type="text" id="type" name="type" required>

            <label for="style">Style:</label>
            <input type="text" id="style" name="style" required>

            <label for="team_id">Team ID:</label>
            <input type="text" id="team_id" name="team_id" required>
</p>
            <input type="submit" value="Update Player">
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
