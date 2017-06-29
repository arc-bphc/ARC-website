<?php

  session_start();
  session_destroy();

if(isset($_GET['email']) && isset($_GET['code'])){
  $email=$_GET['email'];
  $code=$_GET['code'];

  require_once '../config.php';

  // Create connection
  $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);


  $sql = "SELECT name,email,password,isadmin from unverified_users where email='$email' and activationCode ='$code'";
  $result = $conn->query($sql);

  if($result->num_rows == 1){
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $isadmin = $row['isadmin'];
    $passworddb = $row['password'];
    $insert_user = "INSERT INTO users (name, email, password, isadmin) VALUES ('$name', '$email', '$passworddb', $isadmin)";
    if($conn->query($insert_user)){
      $_SESSION["signup-status"] = "<font color = \"green\"> User created successfully.<br>Please Sign In</font>";
    }
    $delete = "DELETE FROM unverified_users where email='$email' and activationCode='$code'";
    $conn->query($delete);    
  }
  else{
    $_SESSION["signup-status"] = "<font color = \"red\"> Incorrect Authentication code</font>";
  }
  mysqli_close($conn);
}



?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign In</title>
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
    <link rel="icon" href="images/arclogo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="sign.css">
    <script src="./jquery.min.js"></script>
    <script src="https://use.fontawesome.com/1523c943cd.js"></script>
    <script src="https://apis.google.com/js/api:client.js"></script>
    <script src="./bootstrap/js/bootstrap.min.js"></script>
    <script src="sign.js"></script>
</head>
<body>

<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9&appId=122099171720574";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

  <header>
<img src="./images/arc-logo-full.jpg" height="30%" width="30%">
</header>

<div id = "container" class="row row-eq-height">
  <div id="signin" class="col-sm-4 col-sm-offset-2">
    <h2 class="col-sm-offset-5">Log In</h2>
    <form class="form-horizontal" name="signinForm" action="signin.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label class="col-sm-3 control-label">Email Id:</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="email2" name="email" placeholder="Enter email">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Password:</label>
        <div class="col-sm-8">
          <input type="Password" class="form-control" id="passwordA" name="passwordA" placeholder="Enter password">
        </div>
      </div>
      <div class="buttons">
      <div class="form-group">
        <div class="col-sm-offset-5 col-sm-10">
          <button type="submit" id="submit-signin" name="submit" class="submit btn btn-default">Sign In</button>
        </div>
      </div>
        <div class="button-wrapper">
          <button id="customSignInBtn" class="loginBtn loginBtn--google" type="button">
            <span>
              <i aria-hidden="true" class="fa fa-google"></i>
            </span>
            <span>Login with Google</span>
          </button>
        </div>
        <div class="button-wrapper">
          <button onclick="FBsignin()" class="loginBtn loginBtn--facebook" type="button">
            <span>
              <i aria-hidden="true" class="fa fa-facebook-official"></i>
            </span>
            <span>Login with Facebook</span>
          </button>
        </div>
     </div>
   </form>
  </div>


  <div id = "signup" class="col-sm-4">
    <h2 class="col-sm-offset-5">Sign Up</h2>
    <form class="form-horizontal" name="signupForm" action="signup.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label class="col-sm-3 control-label">First Name:</label>
        <div class="col-sm-8">
          <input type="text" class="form-control alphabetsOnly" id="firstName" name="firstName" placeholder="Enter first name">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Last Name:</label>
        <div class="col-sm-8">
          <input type="text" class="form-control alphabetsOnly" id="lastName" name="lastName" placeholder="Enter last name">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Email Id:</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="email1" name="email" placeholder="Enter email">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Password:</label>
        <div class="col-sm-8">
          <input type="password" class="form-control" id="passwordB" name="passwordB" placeholder="password">
          <p class="help-block"></p>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Confirm Password:</label>
        <div class="col-sm-8">
          <input type="password" class="form-control" id="repassword" name="repassword" placeholder="re-enter password">
        </div>
      </div>
      <div class = "buttons">
      <div class="form-group">
        <div class="col-sm-offset-5 col-sm-10">
          <button type="submit" id="submit-signup" name="submit" class="submit btn btn-default">Sign Up</button>
        </div>
      </div>
      <div class="button-wrapper">
        <button id="customSignUpBtn" class="loginBtn loginBtn--google" type="button">
          <span>
            <i aria-hidden="true" class="fa fa-google"></i>
          </span>
          <span>Sign up with Google</span>
        </button>
      </div>
      <div class="button-wrapper">
          <button onclick="FBsignup()" class="loginBtn loginBtn--facebook" type="button">
            <span>
              <i aria-hidden="true" class="fa fa-facebook-official"></i>
            </span>
            <span>Sign up with Facebook</span>
          </button>
        </div>
    </div>
    </form>
  </div>
</div>
<div id = "error">
  <p>
    <?php
    if(isset($_SESSION["signup-status"]) && !empty($_SESSION["signup-status"])){
      echo $_SESSION["signup-status"];
      session_destroy();
    }
    ?>
  </p> 
</div>



</body>
</html> 
