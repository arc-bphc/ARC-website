<?php
include("connect.php");
session_start();
if ( $GLOBALS[ 'con' ] ) {

/*if($_SESSION["login-status"] != 1 && $_SESSION["login-status"] != 2) {
  header("Location: ../../blog/sign.php");
}*/


$_SESSION["id"]=2016441;
$qry = "SELECT * FROM users WHERE ID = ".$_SESSION["id"];                       //
$user_datalist = $GLOBALS[ 'con' ]->query($qry);                                //fetch data of loggedin user
$user_data = $user_datalist->fetch_assoc();                                     //
$img_scr= $user_data['picture'];                                                //
//echo "<img src=$img_scr width=400 height=400 alt='error'>";

/*if ( isset( $_POST[ 'id' ] ) ) {

	$name = $_POST[ "name" ];				echo $name . "<br>";                          //asigning new names to entered data
	$id = $_POST[ "id" ];						echo $id . "<br>";
	$email = $_POST[ "email" ];			echo $email . "<br>";
	$github = $_POST[ "github" ];		echo $github . "<br>";
	$bio = $_POST[ "bio" ];					echo $bio . "<br>";

	if(isset($_FILES['image'])){                                                  //managing uploaded picture
		 $errors= array();
		 $file_name = $_FILES['image']['name'];
		 $file_size =$_FILES['image']['size'];
		 $file_tmp =$_FILES['image']['tmp_name'];
		 $file_type=$_FILES['image']['type'];
		 $tmpname=explode('.',$file_name);
		 $file_ext=strtolower(end($tmpname));

		 $expensions= array("jpeg","jpg","png");

		 if(in_array($file_ext,$expensions)=== false){                              //checking for compatible extention
				$errors[]="extension not allowed, please choose a JPEG or PNG file.";
		 }

		 if($file_size > 2097152){                                                  //checking size limit
				$errors[]='File size must be excately 2 MB';
		 }

		 if(empty($errors)==true){
			 	$file_name="dp/" . $id . "." .$file_ext;
				#echo $file_name;
				move_uploaded_file($file_tmp,$file_name);
				echo " Profile pic uploaded";
				$file_name = "\\\\user-profile\\\\dp\\\\" . $id . "." . $file_ext;      //saving file in "dp" folder
				//$str = "UPDATE INTO `users` (`name`, `picture`, `email`, `github`, `bio`, `id`) VALUES ('{$name}', '{$file_name}', '{$email}', '{$github}', '{$bio}', '{$id}') WHERE `ID`='$session_id'";
				$str2="UPDATE `users` SET `ID`='{$id}',`name`='{$name}',`picture`='{$file_name}',`email`='{$email}',`github`='{$github}',`bio`='{$bio}' WHERE `ID`='$session_id'";
				$q = mysqli_query( $GLOBALS[ 'con' ], $str2 );                          //updating database with new info
		 }else{
				print_r($errors);
		 }
	}

	if ( $q ) {
		echo "user inserted";
	} else {
		die( mysqli_error( $GLOBALS[ 'con' ] ) );
	}

	mysqli_close( $GLOBALS[ 'con' ] );
	exit();
}*/
}
?>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../blog/bootstrap4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script>
      function signOut() {
      var auth2 = gapi.auth2.getAuthInstance();
      auth2.signOut().then(function () {
        console.log('User signed out.');
      });
    }
    </script>

    <style>
  .container {
      position: relative;
      margin: auto;
      width: auto;
      height: auto;
  }

  .image {
    opacity: 1;
    display: block;
    width: 400px;
    height: auto;
    margin-left: auto;
    margin-right: auto;
    transition: .5s ease;
    backface-visibility: hidden;
  }

  .middle {
    transition: .5s ease;
    opacity: 0;
    position: absolute;
    bottom: 0%;
    left: 50%;
    transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%)
  }

  .container:hover .image {
    opacity: 0.3;
  }

  .container:hover .middle {
    opacity: 1;
  }

  .text {
    background-color: #000000;
    color: white;
    font-size: 16px;
    padding: 16px 32px;
  }
  </style>
</head>

<body>
<?php
echo "<nav class=\"navbar navbar-toggleable-md navbar-inverse bg-inverse\">
  <button class=\"navbar-toggler navbar-toggler-right\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarTogglerDemo02\" aria-controls=\"navbarTogglerDemo02\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
    <span class=\"navbar-toggler-icon\"></span>
  </button>
  <div class=\"collapse navbar-collapse\" id=\"navbarTogglerDemo02\">
    <ul class=\"navbar-nav mr-auto mt-2 mt-md-0\">
      <li class=\"nav-item active\">
        <a class=\"nav-link\" href=\"#\">Home <span class=\"sr-only\">(current)</span></a>
      <li class=\"nav-item\"><a class=\"nav-link\" href=\"../../blog/form.php\">Write Post</a></li>
      <li class=\"nav-item\"><a class=\"nav-link\" href=\"../../blog/display-posts.php\">Reader</a></li>
      <li class=\"nav-item\">
        <a class=\"nav-link\" href=\"../../blog/sign.php\" onclick=\"signOut();\">Logout</a>
      </li>
    </ul>
  </div>
</nav>";
?>
<div class="card text-center offset-md-1 col-md-10">                                               <!--bootstrap card so that things look nice-->
      <div class="card-header">Edit Profile</div>
      <div class="card-block">

	<form action="updatedata.php" method="POST" enctype="multipart/form-data">

    <div class="form-inline justify-content-center">
      <label class="form-label" for="image">
        <div class="container">
          <input type="file" name="image" class="form-control" id="image" style="display:none;">
          <img src="<?php echo htmlspecialchars($img_scr);?>" class="image" alt='error'>             <!--added tooltip which shows when we hover over the image-->
          <div class="middle">
            <div class="text">click to change DP</div>
          </div>
        </div>
          </label>
    </div>

  <div class="form-group row">
    <label class="col-2 col-form-label offset-md-1" for="email">Email:</label>
    <div class="col-7">
      <input type="email" name="email" class="form-control" id="email" placeholder="<?php echo htmlspecialchars($user_data["email"]);?>">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-2 col-form-label offset-md-1" for="name">Name:</label>
    <div class="col-7">
      <input type="text" name="name" class="form-control" id="name" placeholder="<?php echo htmlspecialchars($user_data["name"]);?>">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-2 col-form-label offset-md-1" for="id">ID:</label>
    <div class="col-7">
      <input type="number" name="id" class="form-control" id="id" placeholder="<?php echo htmlspecialchars($user_data["ID"]);?>">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-2 col-form-label offset-md-1" for="github">Github:</label>
    <div class="col-7">
      <input type="url" name="github" class="form-control" id="github" placeholder="<?php echo htmlspecialchars($user_data["github"]);?>">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-2 col-form-label offset-md-1" for="bio">Bio:</label>
    <div class="col-7">
      <input type="text" name="bio" class="form-control" id="bio" placeholder="<?php echo htmlspecialchars($user_data["bio"]);?>">
    </div>
  </div>

  <div class="form-group row">
    <div class="col-8  offset-sm-1 text-right">
      <button type="submit" class="btn btn-success">Save</button>
    </div>
  </div>
</form>

</div>
    </div>

    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script>
      $(function () {
          $('[data-toggle="tooltip"]').tooltip()          //this script enables tooltip
        })
    </script>

</body>

</html>
