<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scores Page</title>
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

        p {
            color: #333;
            line-height: 1.6;
        }

        .scores-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .scores-table th, .scores-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        .scores-table th {
            background-color: #f2f2f2;
        }

        .manage-scores {
            margin-top: 20px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            background-color: #004080;
            color: #fff;
            border-radius: 5px;
            margin-right: 10px;
            transition: background-color 0.3s, color 0.3s;
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
            <li><a href="score.php">Scores</a></li>
            <li class="logout"><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="content">
        <h2>Scores List</h2>
        <?php
        $host = "localhost";
        $user = "root";
        $password = '';
        $db_name = "sports";

        $conn = mysqli_connect($host, $user, $password, $db_name);
        if(mysqli_connect_errno()) {
            die("Failed to connect with MySQL: ". mysqli_connect_error());
        }

        $sql = "SELECT * FROM score";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table class='scores-table'>";
            echo "<tr><th>Match ID</th><th>Winning Team</th><th>Losing Team</th><th>Winning Team Score</th><th>Losing Team Score</th><th>Ground</th><th>Date</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["match_id"] . "</td>";
                echo "<td>" . $row["won_teamname"] . "</td>";
                echo "<td>" . $row["lost_teamname"] . "</td>";
                echo "<td>" . $row["won_teamscore"] . "</td>";
                echo "<td>" . $row["lost_teamscore"] . "</td>";
                echo "<td>" . $row["ground"] . "</td>";
                echo "<td>" . $row["date"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No scores found</p>";
        }

        $conn->close();
        ?>
    
        <div class="manage-scores">
            <a class="button" href="ascore.php">Add Score</a> |
            <a class="button" href="dscore.php">Delete Score</a> |
            <a class="button" href="uscore.php">Update Score</a>
        </div>
    </div>
</body>
</html>
