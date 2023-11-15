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
    <style>
        /* Add your custom styles here */
        /* For example: */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .taskbar {
            background-color: #004080;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .taskbar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .taskbar li {
            float: left;
        }

        .taskbar li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
        }

        .taskbar li a:hover {
            background-color: #005599;
            color: #fff;
        }

        .taskbar li.logout {
            margin-left: auto;
        }

        .content {
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-top: 20px;
        }

        h2 {
            color: #004080;
            margin-bottom: 20px;
        }

        form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            justify-content: center;
            align-items: center;
            text-align: left;
        }

        label {
            font-size: 16px;
            margin-bottom: 5px;
            color: #333;
        }

        input, select {
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .button {
            background-color: #004080;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
            margin-top: 20px;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
        }

        .button:hover {
            background-color: #005599;
        }
    </style>
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

            <label for="coach_type">Coach Type:</label>
            <select id="coach_type" name="coach_type" required>
                <option value="Head Coach">Head Coach</option>
                <option value="Batting Coach">Batting Coach</option>
                <option value="Bowling Coach">Bowling Coach</option>
            </select>

            <label for="team_id">Team ID:</label>
            <input type="text" id="team_id" name="team_id" required>

            <label for="experience_in_years">Experience (in years):</label>
            <input type="text" id="experience_in_years" name="experience_in_years" required>

            <input type="submit" value="Add Coach" class="button">
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>


<?php
$conn->close();
?>
