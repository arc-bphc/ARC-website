<?php

header("Content-Type: application/json; charset=UTF-8");
$obj = json_decode($_GET["x"], false);

$name = $obj->name;
$email = $obj->email;
$passwordB = $obj->id;
$isadmin = 0;


$servername = "localhost";
$username = "root";
$password = "Aegis@123";
$dbname = "blog";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    $status = "Connection failed: " . $conn->connect_error;
}

$sql = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $status = "<font color=red> Email already exists</font>";
}
else{
	$sql = "INSERT INTO users (name, email, password, isadmin)
	VALUES ('$name', '$email', '$passwordB', $isadmin)";

	if ($conn->query($sql)) {
	    $status = "<font color = \"green\"> User created successfully.<br>Please Sign In</font>";
	}
	else {
	    $status = "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}
mysqli_close($conn);
echo json_encode($status,JSON_UNESCAPED_SLASHES);


?>
