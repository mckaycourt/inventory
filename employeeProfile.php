<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 50%;
        margin: auto;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;

    }

    h1{
        padding-left: 50px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }

    a {
        color: black;
    }

    a:visited {
        color: black;
    }

    img {
        float: right;
        padding: 50px;
    }

    .info {
        padding-left: 50px;
    }
    form {
        width: 50%;
        margin: auto;
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
 * Date: 8/3/17
 * Time: 10:01 PM
 */

$id = $_GET['id'];


$sql4 = "SELECT * FROM employee";

$conn4 = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn4->connect_error) {
    die("Connection failed: " . $conn4->connect_error);
}
$result4 = $conn4->query($sql4);

echo "<form>";

if ($result4->num_rows > 0) {

    while ($row = $result4->fetch_assoc()) {
        if ($row["employeeId"] == $id) {

            $pic = $row["PictureURL"];
            $firstName = $row["firstName"];
            $lastName = $row["lastName"];
            $fullName = $row["firstName"] . " " . $row["lastName"];
            $category = $row["category"];
            $location = $row["officeLocation"];
            $email =  $row["email"];
            $rotationGroup = $row["rotationGroup"];
            $pictureURl = $row["PictureURL"];
            echo "<h1>$fullName</h1>";
            echo "<img src='$pic'><br>";

//            echo "<div class='info'>";
//            echo "<p>First Name: ";
//            echo "<input type='text' value='$firstName'>";
//            echo " Last Name: ";
//            echo "<input type='text' value='$lastName'>";
//            echo " Category: ";
//            echo "<input type='text' value='$category'>";
//            echo " Location: ";
//            echo "<input type='text' value='$location'><br><br>";
//            echo " Email: ";
//            echo "<input style='width: 50%;' type='text' value='$email'>";
//            echo " Rotation Group: ";
//            echo "<input type='text' value='$rotationGroup'></p>";
//            echo " Picture URL: ";
//            echo "<input style='width: 50%;' type='text' value='$pictureURl'></p>";
//            echo "</div>";

            echo "<div class='info'>";
            echo "<p>First Name: $firstName</p>";
            echo "<p>Last Name: $lastName</p>";
            echo "<p>Category: $category</p>";
            echo "<p>Location: $location</p>";
            echo "<p>Email: $email</p>";
            echo "<p>Rotation Group: $rotationGroup</p>";
            echo "</div>";

        }
    }
    echo "</form>";
    /*echo "<form action=\"updatePic.php\"><div>Update Picture URL: </div><input name=\"url\" type=\"text\"><input name=\"id\" type=\"hidden\" value=\"<?php echo $id ?>\"><input type=\"submit\"/></form>";*/
}
$conn4->close();


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//$sql = "SELECT * FROM employee WHERE employeeId = $id";
$sql = "SELECT employee.employeeId, employee.firstName, employee.lastName, computer.ICN, computer.Make, computer.Model, computer.HardwareId, computer.SerialNumber FROM employee LEFT JOIN computer ON computer.EmployeeId=employee.employeeId";
$result = $conn->query($sql);
echo "<div>";
echo "<table>";
echo "<tr><th>Computer ICN</th><th>Make</th><th>Model</th><th>Serial Number</th><th>Hardware ID</th></tr>";
if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        if ($row["employeeId"] == $id) {
            echo "<tr>";
            echo "<td>";
            $icn = $row["ICN"];
            echo "<a href='itemDetails.php?id=$icn&type=computer'>";
            echo $row["ICN"];
            echo "</td>";
            echo "<td>";
            echo $row["Make"];
            echo "</td>";
            echo "<td>";
            echo $row["Model"];
            echo "</td>";
            echo "<td>";
            echo $row["SerialNumber"];
            echo "</td>";
            echo "<td>";
            echo "<a href='hardwareProfile.php?id=" . $row["HardwareId"] . "'>";
            echo $row["HardwareId"];
            echo "</a>";
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

$sql2 = "SELECT employee.employeeId, employee.firstName, employee.lastName, monitor.ICN, monitor.Make, monitor.Model, monitor.SerialNumber FROM employee LEFT JOIN monitor ON monitor.EmployeeId=employee.employeeId";

$conn2 = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn2->connect_error) {
    die("Connection failed: " . $conn2->connect_error);
}
$result2 = $conn2->query($sql2);
echo "<br>";
echo "<div>";
echo "<table>";
echo "<tr><th>Monitor ICN</th><th>Make</th><th>Model</th><th>Serial Number</th></tr>";
if ($result2->num_rows > 0) {

    while ($row = $result2->fetch_assoc()) {
        if ($row["employeeId"] == $id) {
            echo "<tr>";
            echo "<td>";
            $icn = $row["ICN"];
            echo "<a href='itemDetails.php?id=$icn&type=monitor'>";
            echo $row["ICN"];
            echo "</td>";
            echo "<td>";
            echo $row["Make"];
            echo "</td>";
            echo "<td>";
            echo $row["Model"];
            echo "</td>";
            echo "<td>";
            echo $row["SerialNumber"];
            echo "</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
    echo "</div>";
}
$conn2->close();

$sql3 = "SELECT employee.employeeId, employee.firstName, employee.lastName, peripheral.ICN, peripheral.Make, peripheral.Model, peripheral.SerialNumber FROM employee LEFT JOIN peripheral ON peripheral.EmployeeId=employee.employeeId";

$conn3 = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn3->connect_error) {
    die("Connection failed: " . $conn3->connect_error);
}
$result3 = $conn3->query($sql3);
echo "<br>";
echo "<div>";
echo "<table>";
echo "<tr><th>Peripheral ICN</th><th>Make</th><th>Model</th><th>Serial Number</th></tr>";
if ($result3->num_rows > 0) {

    while ($row = $result3->fetch_assoc()) {
        if ($row["employeeId"] == $id) {
            echo "<tr>";
            echo "<td>";
            $icn = $row["ICN"];
            echo "<a href='itemDetails.php?id=$icn&type=peripheral'>";
            echo $row["ICN"];
            echo "</td>";
            echo "<td>";
            echo $row["Make"];
            echo "</td>";
            echo "<td>";
            echo $row["Model"];
            echo "</td>";
            echo "<td>";
            echo $row["SerialNumber"];
            echo "</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
    echo "</div>";
}
$conn3->close();

?>


