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
    // Form submission, process the data and insert into the database
    $match_id = $_POST['match_id'];
    $won_teamname = $_POST['won_teamname'];
    $lost_teamname = $_POST['lost_teamname'];
    $won_teamscore = $_POST['won_teamscore'];
    $lost_teamscore = $_POST['lost_teamscore'];
    $ground = $_POST['ground'];
    $date = $_POST['date'];

    // Perform the SQL query to insert data into the 'score' table
    $sql = "INSERT INTO score (match_id, won_teamname, won_teamscore, lost_teamname, lost_teamscore, ground, date) VALUES ('$match_id', '$won_teamname', '$won_teamscore', '$lost_teamname', '$lost_teamscore', '$ground', '$date')";

    if ($conn->query($sql) === TRUE) {
        echo "Score added successfully";
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
    <title>Add Score</title>
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
        <h2>Add Score</h2>
        <form method="post" action="">
            <label for="match_id">Match ID:</label>
            <input type="text" id="match_id" name="match_id" required>

            <label for="won_teamname">Winning Team Name:</label>
            <input type="text" id="won_teamname" name="won_teamname" required>

            <label for="won_teamscore">Winning Team Score:</label>
            <input type="text" id="won_teamscore" name="won_teamscore" required>
<p>
            <label for="lost_teamname">Losing Team Name:</label>
            <input type="text" id="lost_teamname" name="lost_teamname" required>

            

            <label for="lost_teamscore">Losing Team Score:</label>
            <input type="text" id="lost_teamscore" name="lost_teamscore" required>

            <label for="ground">Ground:</label>
            <input type="text" id="ground" name="ground" required>

            <label for="date">Date:</label>
            <input type="text" id="date" name="date" required>
</p>
            <input type="submit" value="Add Score">
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
