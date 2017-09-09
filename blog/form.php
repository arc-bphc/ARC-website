<!DOCTYPE html>
<html lang="en">
<head>
    <title>New Blog Post</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap4/css/bootstrap.min.css">
    <link rel="icon" href="images/arc.png" type="image/png">
    <style>
    @media only screen and (min-width: 580px){ 
      label{
        text-align: right;
      }
    }
      h2{
        text-align: center;
        margin-top: 20px;
      }
      .button{
        text-align: center;
        margin-top: 20px;
      }
      .profile-pic{
        height: 35px;
        width: 35px;
        margin-right: 15px;
      }
      #ckeditor{
        margin-top: 30px;
      }
      #cke_editor1{
        margin: auto;
        width: 60%;
      }
      #category-container{
        margin-top: 30px;
      }

    </style>
    <script src="./jquery.min.js"></script>
    <script src="./bootstrap4/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/1523c943cd.js"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script> 
    <script src="../ckeditor/ckeditor.js"></script>
    <script>
    // $( document ).ready(function() {

    //     $('.alphabetsOnly').bind('keyup blur',function(){ 
    //         var node = $(this);
    //         node.val(node.val().replace(/[^a-z]/g,'') ); }
    //     );
    //     $('.numbersOnly').bind('keyup blur',function(){ 
    //         var node = $(this);
    //         node.val(node.val().replace(/[^0-9]/,'') ); }
    //     );

    // });
    // function signOut() {
    //   var auth2 = gapi.auth2.getAuthInstance();
    //   auth2.signOut().then(function () {
    //     console.log('User signed out.');
    //   });
    // }

</script>
</head>
<body>

<?php

session_start();

if($_SESSION["login-status"] != 1 && $_SESSION["login-status"] != 2) {
  header("Location: ../home/index.php");
}

echo "<nav class=\"navbar navbar-toggleable-md navbar-inverse bg-inverse\">
  <button class=\"navbar-toggler navbar-toggler-right\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarTogglerDemo02\" aria-controls=\"navbarTogglerDemo02\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
    <span class=\"navbar-toggler-icon\"></span>
  </button>
  <a class=\"navbar-brand\" href=\"../user-profile/editProfile.php\">";
if(!isset($_SESSION["login-status"]) || empty($_SESSION["login-status"])) {
   $_SESSION["login-status"] = 0;
    echo "<img class=\"profile-pic rounded\" src=\"images/default-user.png\">Guest";
}
else {
  echo "<img class=\"profile-pic rounded\" src=\"" . $_SESSION["picture"] . "\">" . $_SESSION["user"];
}

echo "</a>
  <div class=\"collapse navbar-collapse\" id=\"navbarTogglerDemo02\">
    <ul class=\"navbar-nav mr-auto mt-2 mt-md-0\">
      <li class=\"nav-item active\">
        <a class=\"nav-link\" href=\"../home/index.php\">Home <span class=\"sr-only\">(current)</span></a></li>
        <li class=\"nav-item\"><a class=\"nav-link\" href=\"index.php\">Reader</a></li>";


if($_SESSION["login-status"] == 2){
  echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"adminPanel.php\">Admin Panel</a></li>";
}

echo "<li class=\"nav-item\">
        ";

if($_SESSION["login-status"] == 0){
  echo "<a class=\"nav-link\" href=\"../home/index.php?status=1\">Login";
}
else{
echo "<a class=\"nav-link\" href=\"../home/index.php?status=2\">Logout";
}

echo "</a>
      </li>
    </ul>
  </div>
</nav>";


?>


<div id="ckeditor">
  <form name="form2" action="submit.php" method="post" enctype="multipart/form-data">
    <div class="form-group row">
      <label class="col-sm-2 form-control-label">Blog Title:</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" id="blogTitle" name="blogTitle" placeholder="Enter Title">
      </div>
    </div>
    <textarea name="editor1" id="editor1" rows="10" cols="80">
       
    </textarea>
    <script type="text/javascript">
      CKEDITOR.replace('editor1',{
        height: 600,
        filebrowserUploadUrl: "./fileUpload.php",
      });
    </script>
    <div id="category-container" class="form-group row">
      <label class="col-sm-3 form-control-label">Category:</label>
      <div class="col-sm-9">
        <select name="category" class="custom-select">
          <option value="1">General</option>
          <option value="2">Software</option>
          <option value="3">Arduino</option>
          <option value="4">Miscellaneous</option>
        </select>
      </div>
    </div>
    <div class="form-group button row">
      <div class="col-sm-12">
        <button type="submit" name="submit" class="submit btn btn-secondary">Submit</button>
      </div>
    </div>
  </form>
</div>

</body>
</html> 
