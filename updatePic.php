<?php include 'credentials.php'; ?>
<?php
/**
 * Created by PhpStorm.
 * User: mckaycourt
 * Date: 8/4/17
 * Time: 5:02 PM
 */

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$url = $_GET['url'];
$id =  $_GET['id'];

$sql = "UPDATE employee SET PictureURL = '$url' WHERE employeeID = $id";
echo $sql;
if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}
$conn->close();

header("Location: employeeDB.php");