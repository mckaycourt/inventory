<style>
    #printer {
        position: absolute;
        margin-left: 80%;
    }

    #computer {
        position: absolute;
        margin-left: 20%;
    }

    #monitor {
        position: absolute;
        margin-left: 40%;
    }

    #peripheral {
        position: absolute;
        margin-left: 60%;
    }
</style>

<script type="text/javascript"
        src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script>
    function callAjax(nug) {
        var column = nug.options[nug.selectedIndex].innerHTML;
        var table = nug.parentElement.id;
        var sql = "SELECT " + table + ".ICN, " + table + ".Make, " + table + ".Model, ";
        if (table !== "printer") {
            sql += table + ".HomeCheckout, ";
        }
        sql += table + ".Notes, employee.FirstName, employee.LastName, employee.officeLocation, " + table + ".`" + column + "` FROM " + table + " LEFT JOIN employee ON " + table + ".EmployeeID = employee.employeeId WHERE " + table + ".`" + column + "`" + "= 'No'";

        console.log(sql);
        $.ajax({
            url: 'getInventoried.php?sql=' + sql + "&column=" + column,
            success: function (data) {
                console.log(data);
                $('#' + table).append(data);
            }
        });

        $("#" + table).attr("data-sql", sql);

    }

    function createReport() {
        var computerSQL = $("#computer").attr("data-sql");
        var monitorSQL = $("#monitor").attr("data-sql");
        var peripheralSQL = $("#peripheral").attr("data-sql");
        var printerSQL = $("#printer").attr("data-sql");

//        var computerCol = $("#computer").children("select");
        var e = document.getElementById("computerSel");
        var computerCol = e.options[e.selectedIndex].value;

        var f = document.getElementById("monitorSel");
        var monitorCol = f.options[f.selectedIndex].value;

        var g = document.getElementById("peripheralSel");
        var peripheralCol = g.options[g.selectedIndex].value;

        var h = document.getElementById("printerSel");
        var printerCol = h.options[h.selectedIndex].value;
        console.log(computerCol);

        window.location.href = "/createReport.php?computerSQL=" + computerSQL + "&monitorSQL=" + monitorSQL + "&peripheralSQL=" + peripheralSQL + "&printerSQL=" + printerSQL + "&computerCol=" + computerCol + "&monitorCol=" + monitorCol + "&peripheralCol=" + peripheralCol + "&printerCol=" + printerCol;

    }
</script>
<?php include 'credentials.php'; ?>
<?php
/**
 * Created by PhpStorm.
 * User: mckaycourt
 * Date: 8/4/17
 * Time: 8:04 PM
 */


$sql = "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N'computer' && COLUMN_NAME LIKE '%inventoried%'";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query($sql);
echo "<div id='computer'>";
echo "<h1>Computers</h1>";
if ($result->num_rows > 0) {
    echo "<select onchange='callAjax(this)' id='computerSel'>";
    while ($row = $result->fetch_assoc()) {
        echo "<option>";
        echo $row["COLUMN_NAME"];
        echo "</option>";

    }
    echo "</select>";
}
echo "</div>";
$conn->close();

$conn = $conn = new mysqli($servername, $username, $password, $dbname);

$sql2 = "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N'monitor' && COLUMN_NAME LIKE '%inventoried%'";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query($sql2);
echo "<div id='monitor'>";
echo "<h1>Monitors</h1>";
if ($result->num_rows > 0) {
    echo "<select onchange='callAjax(this)' id='monitorSel'>";
    while ($row = $result->fetch_assoc()) {
        echo "<option>";
        echo $row["COLUMN_NAME"];
        echo "</option>";

    }
    echo "</select>";
}
echo "</div>";

$conn->close();

$conn = $conn = new mysqli($servername, $username, $password, $dbname);

$sql3 = "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N'peripheral' && COLUMN_NAME LIKE '%inventoried%'";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query($sql3);
echo "<div id='peripheral'>";
echo "<h1>Peripherals</h1>";
if ($result->num_rows > 0) {
    echo "<select onchange='callAjax(this)' id='peripheralSel'>";
    while ($row = $result->fetch_assoc()) {
        echo "<option>";
        echo $row["COLUMN_NAME"];
        echo "</option>";
    }
    echo "</select>";
}
echo "</div>";
$conn->close();

$conn = $conn = new mysqli($servername, $username, $password, $dbname);

$sql4 = "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N'printer' && COLUMN_NAME LIKE '%inventoried%'";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query($sql4);
echo "<div id='printer'>";
echo "<h1>Printers</h1>";
if ($result->num_rows > 0) {
    echo "<select onchange='callAjax(this)' id='printerSel'>";
    while ($row = $result->fetch_assoc()) {
        echo "<option>";
        echo $row["COLUMN_NAME"];
        echo "</option>";
    }
    echo "</select>";
}
echo "</div>";

$conn->close();

?>

<button onclick="createReport();">Create Report</button>


