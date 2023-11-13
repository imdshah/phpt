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
    // Form submission, process the data and delete from the database
    $match_id = mysqli_real_escape_string($conn, $_POST['match_id']);

    // Perform the SQL query to delete the score from the 'score' table
    $sql = "DELETE FROM score WHERE match_id LIKE '%$match_id%'";

    if ($conn->query($sql) === TRUE) {
        $deletedRows = $conn->affected_rows;
        echo "$deletedRows score(s) deleted successfully";
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
    <title>Delete Score</title>
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
        <h2>Delete Score</h2>
        <form method="post" action="">
            <label for="match_id">Search and Delete Score by Match ID:</label>
            <input type="text" id="match_id" name="match_id" required>

            <input type="submit" value="Delete Score">
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
