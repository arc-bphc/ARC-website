<?php 

session_start();
header("Content-Type: application/json; charset=UTF-8");
$obj = json_decode($_GET["x"], false);

$name = $obj->name;
$email = $obj->email;
$passwordA = $obj->id;
$isadmin = 0;


// insert into database
$servername = "localhost";
$username = "root";
$password = "Aegis@123";
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

if ($result->num_rows == 0) {
  $status = "<font color = red> Invalid email </font>";

}
elseif ($result->num_rows > 1) {
  $status = "<font color = red> Database error: more than 1 entry </font>";

}
else{
  $row = $result->fetch_assoc();

  // to execute on password verification
  if($row['password'] == $passwordA){
      if($row['isadmin'] == 1){
          $_SESSION["login-status"] = 2; 
          $_SESSION["user"] = $row['name'];
          $status = "success";
      }
      else{
          $_SESSION["login-status"] = 1;
          $_SESSION["user"] = $row['name'];
          $status = "success";
      }
  }
  else{
    $status = "<font color = red> Incorrect password </font>";

  }
}
mysqli_close($conn);
echo json_encode($status,JSON_UNESCAPED_SLASHES);

?>
