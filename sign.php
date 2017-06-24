<?php

  session_start();
  session_destroy();

if(isset($_GET['email']) && isset($_GET['code'])){
  $email=$_GET['email'];
  $code=$_GET['code'];
  $servername = "localhost";
  $username = "root";
  $password = "Aegis@123";
  $dbname = "blog";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);


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
    <meta name="google-signin-client_id" content="774440701303-rv2gilg9fk78eh25uf6jhd9s9o0k5mio.apps.googleusercontent.com">
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="sign.css">
    <style>
      .abcRioButton{
        margin: auto;
      }
      .buttons{
        margin: 40px;
      }
      .OR{
        text-align: center;
        font-size: 1.5em;
        vertical-align: middle;
      }
    </style>
    <script src="./jquery.min.js"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="./bootstrap/js/bootstrap.min.js"></script>
    <script>

    gapi.load('auth2',function(){
      gapi.auth.init();
    });



  function SignUp(googleUser) {
    var profile = googleUser.getBasicProfile();


    var obj, dbParam, xmlhttp;
    obj = {
       "id" :  profile.getId(),
       "name" : profile.getName(),
       "email" : profile.getEmail()
    };
    //console.log(obj);
    gapi.auth2.getAuthInstance().disconnect();
    dbParam = JSON.stringify(obj);

    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var test = this.responseText;
        test = test.replace(/\"/g, "");  
        document.getElementById("error").innerHTML = test;
          
      }

    };

    xmlhttp.open("GET", "gsignup.php?x=" + dbParam, true);
    xmlhttp.send();

  }

  function SignIn(googleUser) {
    var profile = googleUser.getBasicProfile();


    var obj, dbParam, xmlhttp;
    obj = {
       "id" :  profile.getId(),
       "name" : profile.getName(),
       "email" : profile.getEmail()
    };
    gapi.auth2.getAuthInstance().disconnect();
    console.log(obj);
    dbParam = JSON.stringify(obj);

    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var test = this.responseText;
        test = test.replace(/\"/g, "");
        if(test == "success"){
          window.location.href = "./display-posts.php";
        }  
        document.getElementById("error").innerHTML = test;
          
      }

    };

    xmlhttp.open("GET", "gsignin.php?x=" + dbParam, true);
    xmlhttp.send();

  }

    $( document ).ready(function() {

        $('.alphabetsOnly').bind('keyup blur',function(){ 
            var node = $(this);
            node.val(node.val().replace(/[^a-z]/g,'') ); }
        );
        $('.numbersOnly').bind('keyup blur',function(){ 
            var node = $(this);
            node.val(node.val().replace(/[^0-9]/,'') ); }
        );


        $( "#submit-signup" ).click(function(){
            var userinput1 = $("#email1").val();
            var pattern1 = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

            if($("#firstName").val() == ""){
                alert("Enter first name");
                return false;
            }
            else if($("#lastName").val() == ""){
                alert("Enter last name");
                return false;
            }
            else if($("#password").val() == ""){
                alert("Enter valid password");
                return false;
            }
            else if($("#passwordB").val() != $("#repassword").val()){
                alert("Passwords not same");
                return false;
            }
            if(!pattern1.test(userinput1))
            {
                alert('not a valid e-mail address');
                    return false;
            }
        });

        $( "#submit-signin" ).click(function(){
            var userinput2 = $("#email2").val();
            var pattern2 = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;


            if($("#passwordA").val() == ""){
                alert("Enter valid password");
                return false;
            }

            if(!pattern2.test(userinput2))
            {
                alert('Not a valid e-mail address');
                    return false;
            }
        });
    });

</script>
</head>
<body>
  <header>
<img src="./images/arc-logo-full.jpg" height="30%" width="30%">
</header>

<div id = "container" class="row row-eq-height">
  <div id="signin" class="col-sm-4 col-sm-offset-2">
    <h2 class="col-sm-offset-5">Sign In</h2>
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
      <div class="buttons row">
      <div class="form-group col-sm-4">
        <div class="col-sm-offset-5 col-sm-10">
          <button type="submit" id="submit-signin" name="submit" class="submit btn btn-default">Sign In</button>
        </div>
      </div>
      <div class="OR col-sm-4">
        <p>OR</p>
      </div>
      <div class="google-sign col-sm-4">
        <div class="g-signin2" data-onsuccess="SignIn"></div>
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
      <div class = "row buttons">
      <div class="form-group col-sm-4">
        <div class="col-sm-offset-5 col-sm-10">
          <button type="submit" id="submit-signup" name="submit" class="submit btn btn-default">Sign Up</button>
        </div>
      </div>
      <div class="OR col-sm-4">
        <p>OR</p>
      </div>
    <div class="google-sign col-sm-4">
      <div class="g-signin2" data-onsuccess="SignUp"></div>
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
