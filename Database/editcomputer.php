<?php
/**
 * Created by PhpStorm.
 * User: mckaycourt
 * Date: 9/9/17
 * Time: 9:41 PM
 */

$ICN = $_GET['ICN'];
$EmployeeID = $_GET['EmployeeID'];
$Make = $_GET['Make'];
$Model = $_GET['Model'];
$SerialNumber = $_GET['SerialNumber'];
$ServiceTag = $_GET['ServiceTag'];
$ExpressServiceCode = $_GET['ExpressServiceCode'];
$Type = $_GET['Type'];
$HardwareID = $_GET['HardwareID'];
$DateAcquired = $_GET['DateAcquired'];
$Warranty = $_GET['Warranty'];
$HomeCheckout = $_GET['HomeCheckout'];
$Notes = $_GET['Notes'];


$oldICN = $_GET['oldICN'];
$oldEmployeeID = $_GET['oldEmployeeID'];
$oldMake = $_GET['oldMake'];
$oldModel = $_GET['oldModel'];
$oldSerialNumber = $_GET['oldSerialNumber'];
$oldServiceTag = $_GET['oldServiceTag'];
$oldExpressServiceCode = $_GET['oldExpressServiceCode'];
$oldType = $_GET['oldType'];
$oldHardwareID = $_GET['oldHardwareID'];
$oldDateAcquired = $_GET['oldDateAcquired'];
$oldWarranty = $_GET['oldWarranty'];
$oldHomeCheckout = $_GET['oldHomeCheckout'];
$oldNotes = $_GET['oldNotes'];

//echo $ICN;
echo " ";
//echo $EmployeeID;
//echo $oldICN;

$servername = "localhost";
$username = "mckayfil";
$password = "6SZhx40s8y";
$dbname = "mckayfil_inventory";

$id = $_GET['id'];
$type = $_GET['type'];
$where = $_GET['where'];

$sql = "INSERT INTO computerHistory (ICN, EmployeeID, Make, Model, SerialNumber, ServiceTag, ExpressServiceCode, Type, HardwareID, DateAcquired, Warranty, HomeCheckout, Notes) VALUES (".$oldICN.", '".$oldEmployeeID."', '".$oldMake."', '". $oldModel."', '".$oldSerialNumber."', '".$oldServiceTag."', '".$oldExpressServiceCode."', '".$oldType."', ". $oldHardwareID.", '".$oldDateAcquired."', '".$oldWarranty."', '".$oldHomeCheckout."', '".$oldNotes."')";
//echo $sql;
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//$sql = "SELECT * FROM employee WHERE employeeId = $id";
$result2 = $conn->query($sql);


$conn->close();

$sql = "UPDATE computer SET ICN = ".$ICN.", EmployeeID = ".$EmployeeID.", Make = '".$Make."', Model = '".$Model."', SerialNumber = '".$SerialNumber."', ServiceTag ='".$ServiceTag."', ExpressServiceCode = '".$ExpressServiceCode."', Type = '".$Type."', HardwareID = ".$HardwareID.", DateAcquired = '".$DateAcquired."', Warranty = '".$Warranty."', HomeCheckout = '".$HomeCheckout."', Notes = '".$Notes."' WHERE ICN = ".$ICN;
echo $sql;
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//$sql = "SELECT * FROM employee WHERE employeeId = $id";
$result2 = $conn->query($sql);


$conn->close();

header('Location: /inventory/itemDetails.php?type=computer&id='.$ICN);