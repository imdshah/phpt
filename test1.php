<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Page</title>
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
    <h2>Team Search</h2>
    <form method="post" action="">
        <label for="teamName" style="font-size: 18px;">Search by Team Name:</label>
        <input type="text" id="teamName" name="teamName" placeholder="Enter team name" style="font-size: 16px;">
        <input type="submit" value="Search" style="font-size: 16px;">
        </form>
    
        <br>
        <h2>Team List</h2>
        <br><br>
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
            $searchTerm = $_POST['teamName'];

            
            $sql = "SELECT `team_id`, `teamname`, `captainname`, `home_ground`, `image` FROM team WHERE teamname LIKE '%$searchTerm%'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table border='1' style='width: 50%; border-collapse: collapse;'>";
                echo "<tr style='background-color: #f2f2f2;'><th>Team Logo</th><th>Team Name</th><th>Captain Name</th><th>Home Ground</th></tr>";
                
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    $img = $row["image"];
                    $teamId = $row["team_id"];
                    $imagePath = "images/" . $img; 
                    echo "<td style='padding: 5px; text-align: center;'><img src=" . $imagePath . " alt='Team Logo' style='width: 80px; height: 80px;'></td>";
                    echo "<td style='padding: 5px; text-align: center;'><a href='team_details.php?team_id={$row["team_id"]}'>" . $row["teamname"] . "</a></td>";
                    echo "<td style='padding: 5px; text-align: center;'>" . $row["captainname"] . "</td>";
                    echo "<td style='padding: 5px; text-align: center;'>" . $row["home_ground"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No teams found</p>";
            }

        } else {
            
            $sql = "SELECT `team_id`, `teamname`, `captainname`, `home_ground`, `image` FROM team ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<div style='display: flex; flex-wrap: wrap; justify-content: space-around;'>";
                $i = 1;

                while ($row = $result->fetch_assoc()) {
                    $img = $row["image"];
                    $teamname = $row["teamname"];
                    $imagePath = "images/" . $img; 
            
                    echo "<div class='player-card'>";
                    //echo "<div style='border: 1px solid #ccc; margin: 10px; padding: 10px; text-align: center; width: 100px;'>";
                    echo "<a href='team_details.php?team_id={$row["team_id"]}'>" . "<img src='$imagePath' alt='Team Logo' style='width: 80px; height: 80px;'><br>$teamname" . "</a>";
                    echo "</div>";

                    if ($i % 4 == 0) {
                        echo "</div>"; 
                        echo "<div style='display: flex; flex-wrap: wrap; justify-content: space-around;'>"; // Start a new row
                    }
            
                    $i++; 
                }
            
                echo "</div>";
            } else {
                echo "<p>No teams found</p>";
            }
            
        }

        $conn->close();
        ?>
    
        <div class="manage-teams">
            <a href="ateam.php">Add Team</a> |
            <a href="dteam.php">Delete Team</a> |
            <a href="uteam.php">Update Team</a>
        </div>
    </div>
</body>
</html>
