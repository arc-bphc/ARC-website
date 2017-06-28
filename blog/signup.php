<?php 
$passwordMail = "suraya123";
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


require './PHPMailer/PHPMailerAutoload.php';
  $mail = new PHPMailer();
  $mail->IsSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->Port = 587;
  $mail->SMTPAuth = true;
  $mail->Username = "yashdeep97@gmail.com";
  $mail->Password = $passwordMail;
  $mail->SMTPSecure = 'tls';
  $mail->SMTPDebug = 0;
  $mail->From = 'yashdeep97@gmail.com';
  $mail->FromName = 'Yashdeep';
  $mail->isHTML(true);
  $mail->addReplyTo('yashdeep97@gmail.com', 'Yashdeep thorat');
 
//random confirmation code
$code=substr(md5(mt_rand()),0,15);
echo $code;

//insert into database--------------
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

if ($result->num_rows > 0) {
  $_SESSION["signup-status"] = "<font color = \"red\"> Email already exists </font>";
  header("Location: sign.php");

  return false;
}


$sql = "INSERT INTO unverified_users (name, email, password, activationCode,isadmin)
VALUES ('$name', '$email', '$passwordB', '$code', $isadmin)";

if ($conn->query($sql)) {
    
  $mail->addAddress($email);
  $mail->Subject = "Activation for ARC Blog";
  $mail->Body    = 'Your Activation Code is '.$code.' Please Click On This link <a href="http://localhost/2/sign.php?email='.$email.'&code='.$code.'"> here </a>to activate your account.';
  if(!$mail->send()) {
    $_SESSION["signup-status"] = "<font color = \"red\">Message could not be sent.<br>Mailer Error:". $mail->ErrorInfo ."</font>";
    header("Location: sign.php");
  } 
  else {
    $_SESSION["signup-status"] = "<font color = \"green\"> Please Verify e-mail ID<br>An e-mail has been sent to your account</font>";
    header("Location: sign.php");
    return true;
  }
}
else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

?>
