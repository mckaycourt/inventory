<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
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

            echo "<div class='info'>";
            echo "<p>First Name: ";
            echo "<input type='text' value='$firstName'></p>";
            echo "<p> Last Name: ";
            echo "<input type='text' value='$lastName'></p>";
            echo "<p> Category: ";
            echo "<input type='text' value='$category'></p>";
            echo "<p> Location: ";
            echo "<input type='text' value='$location'></p>";
            echo "<p> Email: ";
            echo "<input style='width: 50%;' type='text' value='$email'></p>";
            echo "<p> Rotation Group: ";
            echo "<input type='text' value='$rotationGroup'></p>";
            echo "<p> Picture URL: ";
            echo "<input style='width: 50%;' type='text' value='$pictureURl'></p>";
            echo "</div>";
//
//            echo "<div class='info'>";
//            echo "<p>First Name: $firstName</p>";
//            echo "<p>Last Name: $lastName</p>";
//            echo "<p>Category: $category</p>";
//            echo "<p>Location: $location</p>";
//            echo "<p>Email: $email</p>";
//            echo "<p>Rotation Group: $rotationGroup</p>";
//            echo "</div>";

        }
    }
    echo "</form>";
    /*echo "<form action=\"updatePic.php\"><div>Update Picture URL: </div><input name=\"url\" type=\"text\"><input name=\"id\" type=\"hidden\" value=\"<?php echo $id ?>\"><input type=\"submit\"/></form>";*/
}
$conn4->close();