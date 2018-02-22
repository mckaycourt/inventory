<head>
    <link rel="stylesheet" type="text/css" href="table.css">
</head>
<style>
    .left {
        position: absolute;
        left: 0;
        width 45%;
        text-align: center;
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
    #oldInfo{
        display: none;
    }
</style>
<?php include 'credentials.php'; ?>
<?php
include 'menu.html';
?>
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
echo "<div class='right'>";
$sql2 = "SELECT * FROM " . $type . " WHERE " . $type . ".ICN =" . $id;
if($where != ""){
//    echo $where;
    $sql2 = "SELECT * FROM " . $type . " WHERE " . $type . ".id =" . $where;
    echo $sql2;
}
if ($type == "employee") {
    $sql2 = "SELECT * FROM " . $type . " WHERE " . $type . ".employeeId =" . $id;
}
if ($type == "hardware") {
    $sql2 = "SELECT * FROM " . $type . " WHERE " . $type . ".HardwareId =" . $id;
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
        echo "<input id='val$i' type='text' value='$val'>";
        echo "</input>";
        echo "</div>";
    }
    $test++;
}
//echo "</tr>";

//echo "</table>";
echo "</div>";
echo "<div style='display:none;' id='getType'>" . $type . "</div>";
echo "<div style='display:none;' id='where'>" . $where . "</div>";

$conn->close();




?>
<html>
<form action="Database/editcomputer.php" method="get" id="form">
    <table id="table" style="margin-left: 100px; width: fit-content;"></table>
    <input type="submit" value="Submit">
    <div id="oldInfo"></div>
</form>
</html>
<script src="jquery.js"></script>
<script>

    var type = $("#getType").html();
    document.getElementById("form").action = "Database/edit"+ type +".php";
    var i = 0;
    if(document.getElementById("where").innerHTML !== ""){
        i++;
    }
    while (document.getElementById("" + i) !== null && i < 20) {
        var table = document.getElementById("table");
        var row = table.insertRow(-1);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        cell1.innerHTML = "<div class='tableLeft' style='text-align: right'>" + document.getElementById("" + i).innerHTML + "</div>";
        cell2.innerHTML = "<input class='tableRight' name='" + document.getElementById("" + i).innerHTML + "' value='" + document.getElementById("val" + i).value + "'>";
        i++;
    }
    createOldInfo();

    function edit() {
        console.log(document.getElementById("oldInfo").attributes[1]);

//        $("#oldInfo").attr().each(function(){
//            console.log((this));
//        });
//        var url = "edit" + $("#getType").html() + ".php?";
//        var test = [];
//        $(".tableRight").each(function(){
//            test.push((this).value);
//        });
//        $(".tableLeft").each(function(m){
//            url += (this).innerHTML;
//            url += "=";
//            url += test[m];
//            url += "&";
//        });
//        url = url.substr(0, url.length - 1);
//        console.log(url);

    }

    function createOldInfo() {

        var test = [];
        $(".tableRight").each(function () {
            test.push((this).value);
        });

        $(".tableLeft").each(function (m) {
            console.log((this).innerHTML);
            var input = document.createElement("input");
            input.setAttribute("class", "info");
            input.setAttribute("name", "old" + (this).innerHTML);
            input.setAttribute("value", test[m]);
//            input.innerHTML = test[m];
            document.getElementById("oldInfo").appendChild(input);
//            $("#oldInfo").attr((this).innerHTML, test[m]);
        });
    }

</script>

<?php

$sql = "SELECT ICN, id, updated FROM ".$type."History WHERE ICN=".$id;
//echo $sql;

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//$sql = "SELECT * FROM employee WHERE employeeId = $id";
$result2 = $conn->query($sql);
$total = 0;
echo "<div>";
//echo "<table>";
if ($result2->num_rows > 0) {

    while ($row = $result2->fetch_assoc()) {
        $array = array_values($row);
        echo "<div>";
        echo "<a href='itemDetails.php?id=".$array[0]."&type=".$type."History&where=".$array[1]."'>";
        echo "Updated: ".$array[2]; //bar
        echo "</a>";
//        echo $array[1]; //bar
        echo "</div>";
        $total++;
    }

}
$conn->close();

?>
