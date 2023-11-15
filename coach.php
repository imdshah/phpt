<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coach Page</title>
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

        .search-container {
            text-align: center;
            margin: 20px 0;
        }

        .search-label {
            font-size: 18px;
            margin-right: 10px;
        }

        .search-input {
            font-size: 16px;
            padding: 8px;
        }

        .search-button {
            font-size: 16px;
            padding: 10px;
            background-color: #004080;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }

        .search-button:hover {
            background-color: #005599;
        }

        .coach-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .coach-table th, .coach-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        .coach-table th {
            background-color: #f2f2f2;
        }

        .manage-teams {
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
            <li class="logout"><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="content">
        <h2>Coach Search</h2>
        <div class="search-container">
            <form method="post" action="">
                <label for="coachName" class="search-label">Search by Coach Name:</label>
                <input type="text" id="coachName" name="coachName" placeholder="Enter coach name" class="search-input">
                <input type="submit" value="Search" class="search-button">
            </form>
        </div>

        <h2>Coach List</h2>

        <?php
        $host = "localhost";
        $user = "root";
        $password = '';
        $db_name = "sports";

        $conn = mysqli_connect($host, $user, $password, $db_name);
        if(mysqli_connect_errno()) {
            die("Failed to connect with MySQL: ". mysqli_connect_error());
        }

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $searchTerm = $_POST['coachName'];

            //$sql = "SELECT * FROM coach WHERE coachname LIKE '%$searchTerm%'";
            $sql = "SELECT c.coach_id, c.coachname, c.coach_age, c.coach_type, c.team_id, c.experience_in_years, t.teamname FROM coach c JOIN team t ON c.team_id = t.team_id WHERE c.coachname LIKE '%$searchTerm%'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table class='coach-table'>";
                echo "<tr><th>Coach ID</th><th>Coach Name</th><th>Coach Age</th><th>Coach Type</th><th>Team Name</th><th>Experience (years)</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["coach_id"] . "</a></td>";
                    echo "<td>" . $row["coachname"] . "</td>";
                    echo "<td>" . $row["coach_age"] . "</td>";
                    echo "<td>" . $row["coach_type"] . "</td>";
                    echo "<td>" . $row["teamname"] . "</td>";
                    echo "<td>" . $row["experience_in_years"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No coaches found</p>";
            }
        } else {
            //$sql = "SELECT * FROM coach";
            $sql = "SELECT c.coach_id, c.coachname, c.coach_age, c.coach_type, c.team_id, c.experience_in_years, t.teamname FROM coach c JOIN team t ON c.team_id = t.team_id ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table class='coach-table'>";
                echo "<tr><th>Coach ID</th><th>Coach Name</th><th>Coach Age</th><th>Coach Type</th><th>Team Name</th><th>Experience (years)</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["coach_id"] . "</a></td>";
                    echo "<td>" . $row["coachname"] . "</td>";
                    echo "<td>" . $row["coach_age"] . "</td>";
                    echo "<td>" . $row["coach_type"] . "</td>";
                    echo "<td>" . $row["teamname"] . "</td>";
                    echo "<td>" . $row["experience_in_years"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No coaches found</p>";
            }
        }

        $conn->close();
        ?>

        <div class="manage-teams">
        <a class="button" href="acoach.php">Add Coach</a> |
        <a class="button" href="dcoach.php">Delete Coach</a> |
        <a class="button" href="ucoach.php">Update Coach</a>
        </div>
    </div>
</body>
</html>
