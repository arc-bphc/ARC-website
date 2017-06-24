<?php
header("Content-Type: application/json; charset=UTF-8");
$obj = json_decode($_GET["x"], false);

$servername = "localhost";
$username = "root";
$password = "Aegis@123";
$dbname = "blog";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($obj->managepost == 1) {

	$conn->query("UPDATE posts SET status = " . (string)$obj->managepost . " where id = " . (string)$obj->postid);
}
else if ($obj->managepost == 0) {

	$conn->query("DELETE from posts where id = " . (string)$obj->postid);
}
else{

	$conn->query("UPDATE posts SET status = 0 where id = " . (string)$obj->postid);
}

$result = $conn->affected_rows;
echo json_encode($obj);


?>