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
    $team_id = $_POST['team_id'];
    $coach_id = $_POST['coach_id'];
    $teamname = $_POST['teamname'];
    $captainname = $_POST['captainname'];
    $home_ground = $_POST['home_ground'];


    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_folder = "images/";

    move_uploaded_file($image_tmp, $image_folder.$image_name);
    // Perform the SQL query to insert data into the 'team' table
    $sql = "INSERT INTO team (team_id, coach_id, teamname, captainname, home_ground, image) VALUES ('$team_id', '$coach_id', '$teamname', '$captainname', '$home_ground', '$image_name')";

    if ($conn->query($sql) === TRUE) {
        echo "Team added successfully";
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
    <title>Add Team</title>
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
        <h2>Add Team</h2>
        <form method="post" action="" enctype="multipart/form-data">
            
            <label for="team_id">Team ID:</label>
            <input type="text" id="team_id" name="team_id" required>

            <label for="coach_id">Coach ID:</label>
            <input type="text" id="coach_id" name="coach_id" required>

            <label for="teamname">Team Name:</label>
            <input type="text" id="teamname" name="teamname" required>
<p>
            <label for="captainname">Captain Name:</label>
            <input type="text" id="captainname" name="captainname" required>

            <label for="home_ground">Home Ground:</label>
            <input type="text" id="home_ground" name="home_ground" required>

            <label for="image">Team Logo (Image):</label>
            <input type="file" id="image" name="image" accept="image/*">
</p>
<p>
            <input type="submit" value="Add Team">
            </p>
        </form>

        

    </div>
</body>
</html>

<?php
$conn->close();
?>
