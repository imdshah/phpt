<?php
$host = "localhost";
$user = "root";
$password = '';
$db_name = "sports";
$j = 0;
$conn = mysqli_connect($host, $user, $password, $db_name);

if (mysqli_connect_errno()) {
    die("Failed to connect with MySQL: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form submission, process the data and delete from the database
    $playername = mysqli_real_escape_string($conn, $_POST['playername']);

    // Retrieve team_id for the deleted player
    $teamIdQuery = "SELECT team_id FROM players WHERE playername LIKE '%$playername%' LIMIT 1";
    $teamIdResult = $conn->query($teamIdQuery);

    if ($teamIdResult->num_rows > 0) {
        $teamIdRow = $teamIdResult->fetch_assoc();
        $team_id = $teamIdRow['team_id'];

        // Perform the SQL query to delete the player from the 'players' table
        $sql = "DELETE FROM players WHERE playername LIKE '%$playername%'";

        if ($conn->query($sql) === TRUE) {
            $deletedRows = $conn->affected_rows;
            echo "$deletedRows player(s) deleted successfully";
            $j = 1;
            // Add more player details as needed
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Player not found";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Player</title>
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
            font-size: 18px;
            margin-bottom: 10px;
            color: #333;
        }

        input {
            padding: 12px;
            width: 300px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            margin-bottom: 20px;
        }

        input[type="submit"] {
            background-color: #004080;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            width: 300px;
        }

        input[type="submit"]:hover {
            background-color: #005599;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
            text-align: center;
        }

        th, td {
            padding: 10px;
        }

        th {
            background-color: #f2f2f2;
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
        <h2>Delete Player</h2>
        <form method="post" action="">
            <label for="playername">Search and Delete Player by Player Name:</label>
            <input type="text" id="playername" name="playername" required>

            <input type="submit" value="Delete Player">
        </form>

        <?php
        if ($j > 0) {
            // Display Player Details
            echo "<h3>Player Details</h3>";
            $playerDetailsQuery = "SELECT p.player_id, p.playername, p.age, p.country, p.type, p.style, p.team_id, t.team_id, t.teamname FROM players p INNER JOIN team t ON t.team_id = p.team_id  WHERE p.team_id = '$team_id'";
            $playerResult = $conn->query($playerDetailsQuery);

            if ($playerResult->num_rows > 0) {
                echo "<table>";
                echo "<tr>
                        <th>Player ID</th>
                        <th>Player Name</th>
                        <th>Age</th>
                        <th>Country</th>
                        <th>Type</th>
                        <th>Style</th>
                      </tr>";
                while ($row = $playerResult->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["player_id"] . "</td>";
                    echo "<td>" . $row["playername"] . "</td>";
                    echo "<td>" . $row["age"] . "</td>";
                    echo "<td>" . $row["country"] . "</td>";
                    echo "<td>" . $row["type"] . "</td>";
                    echo "<td>" . $row["style"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No player details found</p>";
            }
        }
        ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>