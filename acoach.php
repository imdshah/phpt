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
    
    $coach_id = $_POST['coach_id'];
    $coachname = $_POST['coachname'];
    $coach_age = $_POST['coach_age'];
    $coach_type = $_POST['coach_type'];
    $team_id = $_POST['team_id'];
    $experience_in_years = $_POST['experience_in_years'];

    
    $sql = "INSERT INTO coach (coach_id, coachname, coach_age, coach_type, team_id, experience_in_years) VALUES ('$coach_id', '$coachname', '$coach_age', '$coach_type', '$team_id', '$experience_in_years')";

    if ($conn->query($sql) === TRUE) {
        echo "Coach added successfully";
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
    <title>Add Coach</title>
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
        <h2>Add Coach</h2>
        <form method="post" action="">
            <label for="coach_id">Coach ID:</label>
            <input type="text" id="coach_id" name="coach_id" required>

            <label for="coachname">Coach Name:</label>
            <input type="text" id="coachname" name="coachname" required>

            <label for="coach_age">Coach Age:</label>
            <input type="text" id="coach_age" name="coach_age" required>
            <p>
            <label for="coach_type">Coach Type:</label>
            <input type="text" id="coach_type" name="coach_type" required>

            <label for="team_id">Team ID:</label>
            <input type="text" id="team_id" name="team_id" required>

            <label for="experience_in_years">Experience (in years):</label>
            <input type="text" id="experience_in_years" name="experience_in_years" required>
            </p>
            <input type="submit" value="Add Coach" class="button">
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
