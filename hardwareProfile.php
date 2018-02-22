<head>
    <link rel="stylesheet" type="text/css" href="table.css">
</head>
<?php include 'credentials.php'; ?>
<?php
include 'menu.html';
?>
<?php
/**
 * Created by PhpStorm.
 * User: mckaycourt
 * Date: 8/4/17
 * Time: 3:58 PM
 */

$id = $_GET['id'];

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//$sql = "SELECT * FROM employee WHERE employeeId = $id";
$sql = "SELECT * FROM hardware WHERE hardware.HardwareID = $id";
$result = $conn->query($sql);
echo "<div>";
echo "<table>";
echo "<tr><th>Hardware ID</th><th>Operating System</th><th>Operating System Version</th><th>Bios</th><th>Processor Type</th><th>Processor Speed</th><th>Memory</th><th>Hard Drive</th></tr>";
if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        echo "<tr>";
        echo "<td>";
        echo $row["HardwareID"];
        echo "</td>";
        echo "<td>";
        echo $row["OperatingSystem"];
        echo "</td>";
        echo "<td>";
        echo $row["OperatingSystemVersion"];
        echo "</td>";
        echo "<td>";
        echo $row["Bios"];
        echo "</td>";
        echo "<td>";
        echo $row["ProcessorType"];
        echo "</td>";
        echo "<td>";
        echo $row["ProcessorSpeed"];
        echo "</td>";
        echo "<td>";
        echo $row["Memory"];
        echo "</td>";
        echo "<td>";
        echo $row["HardDrive"];
        echo "</td>";
        echo "</tr>";

    }
    echo "</table>";
    echo "</div>";
}
$conn->close();