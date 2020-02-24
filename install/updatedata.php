<?php
require_once 'conf.php';

$devicekey = $temperature = $humidity = $moisture = "1";

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


foreach ($_POST as $key => $value) {
    echo "<tr> ";
    echo "<td> ";
    echo $key . ":";
    echo "</td> ";
    echo "<td> ";
    echo $value;
    echo "</td> ";
    echo "</tr> ";
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


// Create connection
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE devicedata SET temperature = '$temperature', humidity = '$temperature', moisture = '$moisture' WHERE devicekey='$devicekey'";
// $conn->query($sq1);
if ($conn->query($sql) === TRUE) {
    echo "Data updated successfully";
  } else {
    echo "Error creating table: " . $conn->error;
}

$sql2 = "INSERT INTO history (devicekey, temperature, humidity, moisture)
VALUES ('$devicekey', '$temperature', '$temperature','$moisture')";

if ($conn->query($sql2) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql2 . "<br>" . $conn->error;
}

$conn->close();
}
?>

<form action="" method="post">
  <label for="devicekey">devicekey:</label>
  <input type="text" id="devicekey" name="devicekey" value="agricaltural"><br><br>

  <label for="temperature">temperature:</label>
  <input type="text" id="temperature" name="temperature" value="20"><br><br>

  <label for="humidity">humidity:</label>
  <input type="text" id="humidity" name="humidity" value="21"><br><br>

  <label for="moisture">moisture:</label>
  <input type="text" id="moisture" name="moisture" value="22"><br><br>
  <input type="submit" value="Submit">
</form>