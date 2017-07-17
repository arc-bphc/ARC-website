<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tada";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO store ( name, email, comment)
VALUES ('".$_POST["name"]."','".$_POST["email"]."','".$_POST["comments"]."')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>