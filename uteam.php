<?php
$host = "localhost";
$user = "root";
$password = '';
$db_name = "sports";
$j = 0;

$conn = mysqli_connect($host, $user, $password, $db_name);

if(mysqli_connect_errno()) {
    die("Failed to connect with MySQL: ". mysqli_connect_error());
}

$teamDetails = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form submission, process the data and update the database
    $team_id = $_POST['team_id'];
    $coach_id = $_POST['coach_id'];
    $teamname = $_POST['teamname'];
    $captainname = $_POST['captainname'];
    $home_ground = $_POST['home_ground'];

    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_folder = "images/";

    move_uploaded_file($image_tmp, $image_folder . $image_name);

    // Perform the SQL query to update data in the 'team' table
    $sql = "UPDATE team SET coach_id = '$coach_id', teamname = '$teamname', captainname = '$captainname', home_ground = '$home_ground', image = '$image_name' WHERE team_id = '$team_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Team updated successfully";
        $j = 1;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} elseif (isset($_GET['teamname'])) {
    // Fetch team details when a teamname is provided
    $teamname = $_GET['teamname'];
    $sql = "SELECT * FROM team WHERE teamname LIKE '%$teamname%'";
    $result = $conn->query($sql);
    $teamDetails = $result->fetch_assoc();
}

$sql = "SELECT * FROM team";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Team</title>
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
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            width: 80px;
            height: 80px;
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
        <h2>Update Team</h2>
        <form method="get" action="">
            <label for="teamname_search">Search Team By Team Name:</label>
            <input type="text" id="teamname_search" name="teamname" required>
            <input type="submit" value="Search Team">
        </form>

        <?php
        if ($teamDetails) {
            ?>
            <form method="post" action="" enctype="multipart/form-data">
                <label for="team_id">Team ID:</label>
                <input type="text" id="team_id" name="team_id" value="<?php echo $teamDetails['team_id']; ?>" readonly required>

                <label for="coach_id">Coach ID:</label>
                <input type="text" id="coach_id" name="coach_id" value="<?php echo $teamDetails['coach_id']; ?>" required>

                <label for="teamname">Team Name:</label>
                <input type="text" id="teamname" name="teamname" value="<?php echo $teamDetails['teamname']; ?>" required>

                <label for="captainname">Captain Name:</label>
                <input type="text" id="captainname" name="captainname" value="<?php echo $teamDetails['captainname']; ?>" required>

                <label for="home_ground">Home Ground:</label>
                <input type="text" id="home_ground" name="home_ground" value="<?php echo $teamDetails['home_ground']; ?>" required>

                <label for="image">Team Logo (Image):</label>
                <input type="file" id="image" name="image" accept="image/*">

                <input type="submit" value="Update Team" class="button">
            </form>
        <?php
        }
        if ($j == 1) {
            // Display teams after updating a team
            echo "<h2>Team Details</h2>";
            if ($result->num_rows > 0) {
                echo "<table border='1' style='width: 100%; border-collapse: collapse;'>";
                echo "<tr style='background-color: #f2f2f2;'><th>Team ID</th><th>Coach ID</th><th>Team Name</th><th>Captain Name</th><th>Home Ground</th><th>Team Logo</th></tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td style='text-align: center;'>" . $row["team_id"] . "</td>";
                    echo "<td style='text-align: center;'>" . $row["coach_id"] . "</td>";
                    echo "<td style='text-align: center;'>" . $row["teamname"] . "</td>";
                    echo "<td style='text-align: center;'>" . $row["captainname"] . "</td>";
                    echo "<td style='text-align: center;'>" . $row["home_ground"] . "</td>";
                    echo "<td style='text-align: center;'><img src='images/" . $row["image"] . "' alt='Team Logo' style='width: 80px; height: 80px;'></td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "<p>No teams found</p>";
            }
        }
        ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>
