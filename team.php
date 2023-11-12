<?php
            
    
    
            $host = "localhost";  
            $user = "root";  
            $password = '';  
            $db_name = "sports";  
            
            $conn = mysqli_connect($host, $user, $password, $db_name);  
            if(mysqli_connect_errno()) {  
                die("Failed to connect with MySQL: ". mysqli_connect_error());  
            }
            $sql = "SELECT `teamname`, `captainname`, `home_ground` FROM team";
            $result = $conn->query($sql);
    
            if ($result->num_rows > 0) {
                echo "<table border='1'>";
                echo "<tr><th>Teamname</th><th>Captain Name</th><th>Home Ground</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";

                    echo "<td>" . $row["teamname"] . "</td>";
                    echo "<td>" . $row["captainname"] . "</td>";
                    echo "<td>" . $row["home_ground"] . "</td>";

                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<li>No teams found</li>";
            }
    
            $conn->close();
?>