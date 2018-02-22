<?php include 'credentials.php'; ?>
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
echo "<div id='getType' style='display:none;'>".$type."</div>";
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
echo "<div class='right'>";
$sql2 = "SELECT * FROM " . $type;
if($where != ""){
    if($type == "employee"){
        $sql2 = $sql2." WHERE employeeId LIKE '%".$where."%' OR firstName LIKE '%".$where."%' OR lastName LIKE '%".$where."%'";
    }
    else{
        $sql2 = $sql2." WHERE ICN LIKE '%".$where."%'";
    }
    echo "<script>console.log('".$sql2."');</script>";
}
$result = $conn->query($sql2);

//echo "<tr>";
$test = 0;
while ($row = $result->fetch_assoc()) {

//    $row2 = $result2[$test];
//    echo "nug";
//    echo $row2;

    $array = array_values($row);
    for ($i = 0; $i < sizeof($array); $i++) {
        echo $result2->fetch_assoc()[$i];
        echo "<div>";
        $val = $array[$i];
        echo "<input id='val-$test-$i' type='text' value='$val'>";
        echo "</input>";
        echo "</div>";
    }
    $test++;
}
echo "<div id='size'>$test</div>";
//echo "</tr>";

//echo "</table>";
echo "</div>";

?>
<html>
<table id="table"></table>
</html>
<script>

    var size = document.getElementById("size").innerHTML;
    console.log(size);
    size = parseInt(size);

    var k = 0;
    var table = document.getElementById("table");
    var row2 = table.insertRow(-1);

    while (document.getElementById("" + k) !== null) {
//        if (k !== 0 && k !== 12) {

            var cell1 = row2.insertCell(k);
//            var cell2 = row.insertCell(1);
            cell1.innerHTML = document.getElementById("" + k).innerHTML;
//            cell2.innerHTML = document.getElementById("val-"+j+"-"+i).value;
//        }
        k++;
    }

    var cell = row2.insertCell(k);
    cell.innerHTML = "Edit";

    for (var j = 0; j < size; j++) {
        var i = 0;
//        var table = document.getElementById("table");
        var row = table.insertRow(-1);
        var id = "";

        while (document.getElementById("" + i) !== null) {
//            if (i !== 0 && i !== 12) {
//            var cell1 = row.insertCell(i);
                var cell2 = row.insertCell(i);
//            cell1.innerHTML = document.getElementById(""+i).innerHTML;
                cell2.innerHTML = document.getElementById("val-" + j + "-" + i).value;
                if (i === 0) {
                    id = document.getElementById("val-" + j + "-" + i).value;
                }
//            }
            i++;
        }
        var cell3 = row.insertCell(i);
        cell3.innerHTML = "<a href='itemDetails.php?type=" + document.getElementById("getType").innerHTML + "&id=" + id + "'>Edit</a>";
    }


</script>
