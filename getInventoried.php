<?php include 'credentials.php'; ?>
<?php
/**
 * Created by PhpStorm.
 * User: mckaycourt
 * Date: 8/4/17
 * Time: 9:01 PM
 */

$sql4 = $_GET['sql'];
$column = $_GET['column'];

$conn4 = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn4->connect_error) {
    die("Connection failed: " . $conn4->connect_error);
}
$result4 = $conn4->query($sql4);

echo "<div>";

if ($result4->num_rows > 0) {

    while ($row = $result4->fetch_assoc()) {
        if ($row["$column"] == "False" || $row["$column"] == "No") {

            echo "<div class='info'>";
//            echo "<p>";
//            echo $row["FirstName"] . " " . $row["LastName"];
//            echo "</p>";
            echo "<p>";
            echo $row["ICN"];
            echo "</p>";
            echo "<p>";
//            echo $row["Make"];
//            echo "<p>";
//            echo $row["Model"];
//            echo "<p>";
//            echo "HC: " . $row["HomeCheckout"];
//            echo "</p>";
//            echo "<p>";
//            echo "Inventoried: " . $row["$column"];
//            echo "</p>";
//            echo "<p>";
//            echo $row["Notes"];
//            echo "</p>";
            echo "</div>";
        }

    }
    echo "</div>";
    echo "<br>";
}
$conn4->close();