<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign In</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="sign.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
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
      <div class="form-group">
        <div class="col-sm-offset-5 col-sm-10">
          <button type="submit" id="submit-signin" name="submit" class="submit btn btn-default">Sign In</button>
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
      <div class="form-group">
        <div class="col-sm-offset-5 col-sm-10">
          <button type="submit" id="submit-signup" name="submit" class="submit btn btn-default">Sign Up</button>
        </div>
      </div>
    </form>
  </div>
</div>
<div id = "error">
  <p>
    <?php
      echo $_SESSION["signup-status"];
      session_destroy();
    ?>
  </p>
</div>



</body>
</html> 
