<?php

$blogTitle = $_POST["blogTitle"];
$author = $_SESSION["user"];
$content = $_POST['editor1'];

if($blogTitle == ""){
	die("invalid title");
    return false;
}

else if($content == ""){
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

$sql = "INSERT INTO blogPosts (title, author, content,uploadtime,status)
VALUES ('$blogTitle', '$author','$content',now(),0)";

if (mysqli_query($conn, $sql)) {
    echo "<br>New record created successfully";


} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

echo "<div><a href = \"./display-posts.php\">See posts</a>";
?>

?>