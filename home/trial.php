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
    
    header("Location: index.html");
    echo "<script type=\"text/javascript\">window.alert('Your response has been recorded. Thank you!'); window.location.href = '/index.html';</script>"; 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>