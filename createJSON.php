<?php include 'credentials.php'; ?>
<?php
/**
 * Created by PhpStorm.
 * User: mckaycourt
 * Date: 9/26/17
 * Time: 9:05 PM
 */

$id = $_GET['id'];
$type = $_GET['type'];
$where = $_GET['where'];
$join = $_GET['join'];
$employeeId = $_GET['employeeId'];

$sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N'" . $type . "'";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result2 = $conn->query($sql);
$total = 0;
$titles = [];
if ($result2->num_rows > 0) {

    while ($row = $result2->fetch_assoc()) {
        $array = array_values($row);
        array_push($titles, $array[0]);
        $total++;
    }
}
$conn->close();
if($join == true) {
    $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N'inventory'";

    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $result2 = $conn->query($sql);

    if ($result2->num_rows > 0) {

        while ($row = $result2->fetch_assoc()) {
            $array = array_values($row);
            if ($array[0] != "ICN") {

                array_push($titles, $array[0]);
                $total++;
            }
        }
    }
    $conn->close();
    $where = "JOIN inventory ON ".$type.".ICN = inventory.ICN and ".$type.".employeeId = ".$employeeId;
}

$sql = "SELECT * FROM " . $type;
if ($where != "") {
    $sql = $sql . " " . $where;
}
//echo $sql;
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result2 = $conn->query($sql);
$inc = 0;
if ($result2->num_rows > 0) {
    echo "{";
    while ($row = $result2->fetch_assoc()) {
        $array = array_values($row);
        $size = sizeof($array) - 1;
        echo "\"" . $inc . "\":{";
        for ($i = 0; $i < sizeof($array); $i++) {
            echo "\"" . $titles[$i % $total] . "\":";
            echo "\"" . $array[$i] . "\"";
            if ($i % $size != 0 || $i == 0) {
                echo ",";
            }
//            echo "size of the array: ".$size;
//            echo "i: ".$i;
        }

        echo "}";
        if ($result2->num_rows != $inc + 1) {
            echo ",";
        }
        $inc++;
    }
    echo "}";
}


