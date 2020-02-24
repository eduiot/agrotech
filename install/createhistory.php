<?php
// Create connection
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

  if(mysqli_num_rows(mysqli_query($conn,"SHOW TABLES LIKE 'devicedata'"))) {
    echo "DB EXIST";
  } else {
     echo "DB Not Exist";

    $sql = "CREATE TABLE devicedata (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    devicekey VARCHAR(30) NOT NULL,
    temperature VARCHAR(6),
    humidity VARCHAR(6),
    moisture VARCHAR(6),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    if ($conn->query($sql) === TRUE) {
      echo "Table Devices created successfully";
    } else {
      echo "Error creating table: " . $conn->error;
    }
  }

$conn->close();

?>