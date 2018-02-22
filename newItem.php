<?php include 'credentials.php'; ?>
<?php
/**
 * Created by PhpStorm.
 * User: mmcourt
 * Date: 11/1/2017
 * Time: 1:05 PM
 */

include 'menu.html';
?>
<head>
        <link rel="stylesheet" type="text/css" href="table.css">
</head>
<style>
    .left {
        position: absolute;
        left: 0;
        width 45%;
        text-align: right;
        display: none;
    }

    .right {
        position: absolute;
        right: 0;
        width 45%;
        display: none;
    }

    input {
        background: none;
    }
</style>

<?php
/**
 * Created by PhpStorm.
 * User: mckaycourt
 * Date: 8/5/17
 * Time: 10:52 PM
 */


$id = $_GET['id'];
$type = $_GET['type'];
$where = $_GET['where'];

$sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N'" . $type . "'";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//$sql = "SELECT * FROM employee WHERE employeeId = $id";
$result2 = $conn->query($sql);
$total = 0;
echo "<div class='left'>";
//echo "<table>";
if ($result2->num_rows > 0) {
//    echo "<tr>";

    while ($row = $result2->fetch_assoc()) {
//        echo "<th>";
        echo "<div id='$total'>";
        $array = array_values($row);
        echo $array[0]; //bar
        echo "</div>";
//        echo "</th>";
        $total++;
    }
//    echo "</tr>";

}
$conn->close();

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "</div>";

?>

<html>
<table id="table" style="width: fit-content; margin-left: 100px;"></table>
<script>

    var i = 0;
    while (document.getElementById("" + i) !== null && i < 20) {
        var table = document.getElementById("table");
        var row = table.insertRow(-1);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        cell1.innerHTML = "<div class='tableLeft' style='text-align: right'>" + document.getElementById("" + i).innerHTML + "</div>";
        cell2.innerHTML = "<input id='" + document.getElementById("" + i).innerHTML + "' placeholder='" + document.getElementById("" + i).innerHTML + "'>";
        i++;
    }

</script>
</html>