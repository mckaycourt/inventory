<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        padding: 8px;
        text-align: center;
    }

    a, a:visited {
        color: black;
        text-decoration: none;
    }

</style>
<?php include 'credentials.php'; ?>
<?php
include 'menu.html';
?>
<div class="page">
    <h1>Inventory</h1>


    <?php

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM employee ORDER BY employeeId";
    $result = $conn->query($sql);
    echo "<table id=\"list\">";

    if ($result->num_rows > 0) {
        $inc = 0;
// output data of each row
        echo "<tr>";
        while ($row = $result->fetch_assoc()) {
            if ($row["firstName"] != "") {
                echo "<td id='option$inc'>";
                $url = "/inventory/employeeProfile.php?id=" . $row["employeeId"];
                $pic = $row["PictureURL"];
                echo "<a href='$url'>";
                echo "<img src='$pic'><br>";
                echo "<p>";
                echo $row["firstName"];
                echo " ";
                echo $row["lastName"];
                echo "</p>";
                echo "</a>";
                echo "</td>";
                $inc++;
            }
            if ($inc % 7 == 0) {
                echo "</tr>";
            }

        }
    } else {
        echo "0 results";
    }
    $conn->close();
    echo "</table>";
    ?>

</div>
