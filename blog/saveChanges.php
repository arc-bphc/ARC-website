<?php

session_start();

$postID = $_SESSION["postID"];
$blogTitle = $_POST["blogTitle"];
$content = $_POST['editor1'];
$category = $_POST["category"];


if($content == ""){
    die("empty content");
    return false;
}


//insert into database
require_once '../config.php';

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "UPDATE blogPosts SET title = '$blogTitle',  content = '$content', category = '$category' WHERE id = $postID";

if($blogTitle == "" && $category != ""){
	$sql = "UPDATE blogPosts SET content = '$content', category = '$category' WHERE id = $postID";
}
else if ($category == "" && $blogTitle != "") {
	$sql = "UPDATE blogPosts SET title = '$blogTitle', content = '$content' WHERE id = $postID";
}
else if($category == "" && $blogTitle == ""){
	$sql = "UPDATE blogPosts SET content = '$content' WHERE id = $postID";
}

if (mysqli_query($conn, $sql)) {
    echo "<br>Changes recorded successfully";


} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

echo "<div><a href = \"./index.php\">See posts</a>";

?>