<?php
$host = "localhost";
$user = "root";
$password = '';
$db_name = "sports";

$conn = mysqli_connect($host, $user, $password, $db_name);

if(mysqli_connect_errno()) {
    die("Failed to connect with MySQL: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form submission, process the data and insert into the database
    $player_id = $_POST['player_id'];
    $playername = $_POST['playername'];
    $age = $_POST['age'];
    $country = $_POST['country'];
    $type = $_POST['type'];
    $style = $_POST['style'];
    $team_id = $_POST['team_id'];

    // Perform the SQL query to insert data into the 'players' table
    $sql = "INSERT INTO players (player_id, playername, age, country, type, style, team_id) VALUES ('$player_id', '$playername', '$age', '$country', '$type', '$style', '$team_id')";

    if ($conn->query($sql) === TRUE) {
        echo "Player added successfully";
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
    <title>Add Player</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
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
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin-top: 10px;
            font-size: 18px;
        }

        input {
            padding: 8px;
            margin-top: 5px;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #004080;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
            margin-top: 20px;
        }

        input[type="submit"]:hover {
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
        <h2>Add Player</h2>
        <form method="post" action="">
            <label for="player_id">Player ID:</label>
            <input type="text" id="player_id" name="player_id" required>

            <label for="playername">Player Name:</label>
            <input type="text" id="playername" name="playername" required>

            <label for="age">Age:</label>
            <input type="text" id="age" name="age" required>

            <label for="country">Country:</label>
            <input type="text" id="country" name="country" required>

            <label for="type">Type:</label>
            <input type="text" id="type" name="type" required>

            <label for="style">Style:</label>
            <input type="text" id="style" name="style" required>

            <label for="team_id">Team ID:</label>
            <input type="text" id="team_id" name="team_id" required>

            <input type="submit" value="Add Player">
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
