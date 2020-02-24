<?php
// Create connection
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$devicekey = "agricaltural";
$founddata = 0;

$sql = "SELECT * FROM devicedata WHERE devicekey='$devicekey'";
$result = $conn->query($sql);


if ($result->num_rows == 0){
    $sql2 = "INSERT INTO devicedata (devicekey, temperature, humidity, moisture)
    VALUES ('agricaltural', '25.0', '36','40')";

    if ($conn->query($sql2) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql2 . "<br>" . $conn->error;
    }
}
$conn->close();

?>