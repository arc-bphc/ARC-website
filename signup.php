<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$firstname = $_POST["firstName"];
$lastname = $_POST["lastName"];
$name = $firstname . " " . $lastname;
$email = $_POST["email"];
$passwordB = $_POST["passwordB"];

// echo $passwordB; 
session_start();

if($firstname == ""){
  $_SESSION["signup-status"] = "<font color = \"red\"> Empty first name </font>";
  header("Location: sign.php");
    return false;
}
else if($lastname == ""){
  $_SESSION["signup-status"] = "<font color = \"red\"> Empty last name </font>";
  header("Location: sign.php");
    return false;
}
else if($email == ""){
  $_SESSION["signup-status"] = "<font color = \"red\"> Empty email </font>";
  header("Location: sign.php");
    return false;
}
else if($passwordB == ""){
  $_SESSION["signup-status"] = "<font color = \"red\"> Empty password </font>";
  header("Location: sign.php");
    return false;
}

$isadmin = 0;

//insert into database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM users WHERE email = '$email'";
// echo $sql;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $_SESSION["signup-status"] = "<font color = \"red\"> Email already exists </font>";
  header("Location: sign.php");

  return false;
}

$sql = "INSERT INTO users (name, email, password, isadmin)
VALUES ('$name', '$email', '$passwordB', $isadmin)";

if ($conn->query($sql)) {
    $_SESSION["signup-status"] = "<font color = \"green\"> User created successfully </font>";
    header("Location: sign.php");
    return true;
}
else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

?>
