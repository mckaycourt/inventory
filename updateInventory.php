<?php include 'credentials.php'; ?>
<?php
/**
 * Created by PhpStorm.
 * User: mckaycourt
 * Date: 10/30/17
 * Time: 9:22 AM
 */


$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$icn = $_GET['ICN'];
$id =  $_GET['id'];

$sql = "UPDATE inventory SET lastUpdated = CURRENT_TIMESTAMP, inventoried = 1 WHERE ICN = $icn";
if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}
$conn->close();