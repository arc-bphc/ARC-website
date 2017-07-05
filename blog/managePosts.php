<?php
header("Content-Type: application/json; charset=UTF-8");
$obj = json_decode($_GET["x"], false);

require_once '../config.php';

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($obj->managepost == 1) {

	$conn->query("UPDATE blogPosts SET status = " . (string)$obj->managepost . " where id = " . (string)$obj->postid);
}
else if ($obj->managepost == 0) {

	$conn->query("DELETE from blogPosts where id = " . (string)$obj->postid);
}
else{

	$conn->query("UPDATE blogPosts SET status = 0 where id = " . (string)$obj->postid);
}

$result = $conn->affected_rows;
echo json_encode($obj);


?>