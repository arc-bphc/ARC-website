<?php 

session_start();
header("Content-Type: application/json; charset=UTF-8");
$obj = json_decode($_GET["x"], false);

$name = $obj->name;
$email = $obj->email;
$passwordA = $obj->id;
$picture = $obj->picture;
$isadmin = 0;


// insert into database
require_once '../config.php';

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM users WHERE email = '$email'";
// echo $sql;
$result = $conn->query($sql);

if ($result->num_rows == 0) {
  $sql = "INSERT INTO users (name, email, password, isadmin, picture)
  VALUES ('$name', '$email', '$passwordA', $isadmin, '$picture')";
  
  $sql = "SELECT * FROM users WHERE email = '$email'";
  $result = $conn->query($sql);
  if ($conn->query($sql)) {
      $_SESSION["id"] = $row['id'];
      $_SESSION["user"] = $row['name'];
      $_SESSION["picture"] = $row['picture'];
      if($row['isadmin'] == 1){
        $_SESSION["login-status"] = 2;
      }
      else{
        $_SESSION["login-status"] = 1; 
      }
      $status = "success";
  }
  else {
      $status = "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

}
elseif ($result->num_rows > 1) {
  $status = "<font color = red> Database error: more than 1 entry </font>";

}
else{
  $row = $result->fetch_assoc();

  // to execute on password verification
      $_SESSION["id"] = $row['id'];
      $_SESSION["user"] = $row['name'];
      $_SESSION["picture"] = $row['picture'];
      if($row['isadmin'] == 1){
        $_SESSION["login-status"] = 2;
      }
      else{
        $_SESSION["login-status"] = 1; 
      }
      $status = "success";

}
mysqli_close($conn);
echo json_encode($status,JSON_UNESCAPED_SLASHES);

?>
