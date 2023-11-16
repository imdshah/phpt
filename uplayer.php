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

// Function to fetch player details by player_id
function getPlayerDetails($conn, $player_id)
{
    $sql = "SELECT * FROM players WHERE player_id = '$player_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
}

$playerDetails = null;

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
        $j = 1;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} elseif (isset($_GET['player_id'])) {
    // Fetch player details when a player_id is provided
    $player_id = $_GET['player_id'];
    $playerDetails = getPlayerDetails($conn, $player_id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Player</title>
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
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
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

        input {
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
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
            text-align: left;
        }

        th, td {
            padding: 12px;
        }

        th {
            background-color: #004080;
            color: white;
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
        <h2>Update Player</h2>

        <!-- Search form -->
        <form method="get" action="">
            <label for="player_id_search">Search Player by Player ID:</label>
            <input type="text" id="player_id_search" name="player_id" required>
            <input type="submit" value="Search Player">
        </form>

        <?php
        
        // Display existing player details in the update form
        if ($playerDetails) {
            ?>
            <!-- Update form -->
            <form method="post" action="">
                <label for="player_id">Player ID:</label>
                <input type="text" id="player_id" name="player_id" value="<?php echo $playerDetails['player_id']; ?>" readonly>

                <label for="playername">Player Name:</label>
                <input type="text" id="playername" name="playername" value="<?php echo $playerDetails['playername']; ?>" required>

                <label for="age">Age:</label>
                <input type="text" id="age" name="age" value="<?php echo $playerDetails['age']; ?>" required>

                <label for="country">Country:</label>
                <input type="text" id="country" name="country" value="<?php echo $playerDetails['country']; ?>" required>

                <label for="type">Type:</label>
                <input type="text" id="type" name="type" value="<?php echo $playerDetails['type']; ?>" required>

                <label for="style">Style:</label>
                <input type="text" id="style" name="style" value="<?php echo $playerDetails['style']; ?>" required>

                <label for="team_id">Team ID:</label>
                <input type="text" id="team_id" name="team_id" value="<?php echo $playerDetails['team_id']; ?>" required>

                <input type="submit" value="Update Player">
            </form>

            <?php
        }
        if ($j == 1) {
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
