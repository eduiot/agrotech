<form action="" method="post">
  <label for="devicekey">devicekey:</label>
  <input type="text" id="devicekey" name="devicekey" value="agricaltural"><br><br>

  <input type="submit" value="Submit">
</form>

<?php
require_once 'conf.php';

$devicekey = $temperature = $humidity = $moisture = "1";

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}




if (!empty($_POST["devicekey"])) $devicekey = ($_POST["devicekey"]);  //  "agricaltural"
if (!empty($_POST["temperature"])) $temperature = test_input($_POST["temperature"]);
if (!empty($_POST["humidity"])) $humidity = test_input($_POST["humidity"]);
if (!empty($_POST["moisture"])) $moisture = test_input($_POST["moisture"]);

/*
echo $devicekey;
echo $temperature;
echo $humidity;
echo $moisture;
*/


if($_SERVER["REQUEST_METHOD"] == "POST"){

    foreach ($_POST as $key => $value) {
        echo "<br>";
        echo "<tr> ";
        echo "<td> ";
        echo $key . ":";
        echo "</td> ";
        echo "<td> ";
        echo $value;
        echo "</td> ";
        echo "</tr> ";
        echo "<br>";
    }

// Create connection
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT devicekey, temperature, humidity, moisture  FROM devicedata ";
$result = $link->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        {
        if ($row["devicekey"] == $devicekey){
        echo "devicekey: " . $row["devicekey"]. " - temperature: " . $row["temperature"].  " - humidity: " . $row["humidity"].  " - moisture: " . $row["moisture"].  " </br> ";
        // echo $row["devicekey"];
        }
        }
    }
} else {
    echo "0 results";
}


$conn->close();
}
?>
