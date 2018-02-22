<head>
    <link rel="stylesheet" type="text/css" href="style/table.css">
</head>
<?php include 'credentials.php'; ?>
<?php
/**
 * Created by PhpStorm.
 * User: mckaycourt
 * Date: 8/4/17
 * Time: 11:35 PM
 */


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//$sql = "SELECT * FROM employee WHERE employeeId = $id";
//$sql = "SELECT employee.employeeId, employee.firstName, employee.lastName, computer.ComputerICN, computer.Make, computer.Model, computer.HardwareId, computer.SerialNumber FROM employee LEFT JOIN computer ON computer.EmployeeId=employee.employeeId";

$sql = $_GET['computerSQL'];
$col = $_GET['computerCol'];

$result = $conn->query($sql);
echo "<div>";
echo "<table>";
echo "<tr><th>Computer ICN</th><th>Make</th><th>Model</th><th>Room Number</th><th>Inventoried</th></tr>";
if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        if ($row["employeeId"] == $id) {
            echo "<tr>";
            echo "<td>";
            echo $row["ICN"];
            echo "</td>";
            echo "<td>";
            echo $row["Make"];
            echo "</td>";
            echo "<td>";
            echo $row["Model"];
            echo "</td>";
            echo "<td>";
            echo $row["officeLocation"];
            echo "</td>";
            echo "<td>";
            echo $row[$col];
            echo "</td>";
            echo "</tr>";
        }
    }
//    echo "<tr>";
//    echo "<td>";
//    echo "<input style='padding: 0;' type='text'>";
//    echo "</td>";
//    echo "<td>";
//    echo "<input type='text'>";
//    echo "</td>";
//    echo "<td>";
//    echo "<input type='text'>";
//    echo "</td>";
//    echo "<td>";
//    echo "<input type='text'>";
//    echo "</td>";
//    echo "</tr>";
    echo "</table>";
    echo "</div>";
}
$conn->close();

//$sql2 = "SELECT employee.employeeId, employee.firstName, employee.lastName, monitor.MonitorICN, monitor.Make, monitor.Model, monitor.SerialNumber FROM employee LEFT JOIN monitor ON monitor.EmployeeId=employee.employeeId";
$sql2 = $_GET['monitorSQL'];
$col2 = $_GET['monitorCol'];

$conn2 = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn2->connect_error) {
    die("Connection failed: " . $conn2->connect_error);
}
$result2 = $conn2->query($sql2);
echo "<br>";
echo "<div>";
echo "<table>";
echo "<tr><th>Monitor ICN</th><th>Make</th><th>Model</th><th>Room Number</th><th>Inventoried</th></tr>";
if ($result2->num_rows > 0) {

    while ($row = $result2->fetch_assoc()) {
        if ($row["employeeId"] == $id) {
            echo "<tr>";
            echo "<td>";
            echo $row["ICN"];
            echo "</td>";
            echo "<td>";
            echo $row["Make"];
            echo "</td>";
            echo "<td>";
            echo $row["Model"];
            echo "</td>";
            echo "<td>";
            echo $row["officeLocation"];
            echo "</td>";
            echo "<td>";
            echo $row[$col2];
            echo "</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
    echo "</div>";
}
$conn2->close();

//$sql3 = "SELECT employee.employeeId, employee.firstName, employee.lastName, peripheral.PeripheralICN, peripheral.Make, peripheral.Model, peripheral.SerialNumber FROM employee LEFT JOIN peripheral ON peripheral.EmployeeId=employee.employeeId";
$sql3 = $_GET['peripheralSQL'];
$col3 = $_GET['peripheralCol'];

$conn3 = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn3->connect_error) {
    die("Connection failed: " . $conn3->connect_error);
}
$result3 = $conn3->query($sql3);
echo "<br>";
echo "<div>";
echo "<table>";
echo "<tr><th>Peripheral ICN</th><th>Make</th><th>Model</th><th>Room Number</th><th>Inventoried</th></tr>";
if ($result3->num_rows > 0) {

    while ($row = $result3->fetch_assoc()) {
        if ($row["employeeId"] == $id) {
            echo "<tr>";
            echo "<td>";
            echo $row["ICN"];
            echo "</td>";
            echo "<td>";
            echo $row["Make"];
            echo "</td>";
            echo "<td>";
            echo $row["Model"];
            echo "</td>";
            echo "<td>";
            echo $row["officeLocation"];
            echo "</td>";
            echo "<td>";
            echo $row[$col3];
            echo "</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
    echo "</div>";
}
$conn3->close();

?>