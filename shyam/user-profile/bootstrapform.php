<?php
include("connect.php");

echo "<b>CHECKING CONNECTION</b> <br>";
if ( $GLOBALS[ 'con' ] ) {
	echo 'Successfull <br><br>';

$session_id = 2016441;
$qry = "SELECT * FROM `users` WHERE `ID`='$session_id'";
$user_datalist = $GLOBALS[ 'con' ]->query($qry);
$user_data = $user_datalist->fetch_assoc();

$img_scr= $user_data['picture'];
//echo "<img src=$img_scr width=400 height=400 alt='error'>";

if ( isset( $_POST[ 'id' ] ) ) {

	$name = $_POST[ "name" ];				echo $name . "<br>";
	$id = $_POST[ "id" ];						echo $id . "<br>";
	$email = $_POST[ "email" ];			echo $email . "<br>";
	$github = $_POST[ "github" ];		echo $github . "<br>";
	$bio = $_POST[ "bio" ];					echo $bio . "<br>";

	if(isset($_FILES['image'])){
		 $errors= array();
		 $file_name = $_FILES['image']['name'];
		 $file_size =$_FILES['image']['size'];
		 $file_tmp =$_FILES['image']['tmp_name'];
		 $file_type=$_FILES['image']['type'];
		 $tmpname=explode('.',$file_name);
		 $file_ext=strtolower(end($tmpname));

		 $expensions= array("jpeg","jpg","png");

		 if(in_array($file_ext,$expensions)=== false){
				$errors[]="extension not allowed, please choose a JPEG or PNG file.";
		 }

		 if($file_size > 2097152){
				$errors[]='File size must be excately 2 MB';
		 }

		 if(empty($errors)==true){
			 	$file_name="dp/" . $id . "." .$file_ext;
				#echo $file_name;
				move_uploaded_file($file_tmp,$file_name);
				echo " Profile pic uploaded";
				$file_name = "\\\\user-profile\\\\dp\\\\" . $id . "." . $file_ext;
				$str = "UPDATE INTO `users` (`name`, `picture`, `email`, `github`, `bio`, `id`) VALUES ('{$name}', '{$file_name}', '{$email}', '{$github}', '{$bio}', '{$id}') WHERE `ID`='$session_id'";
				$str2="UPDATE `users` SET `ID`='{$id}',`name`='{$name}',`picture`='{$file_name}',`email`='{$email}',`github`='{$github}',`bio`='{$bio}' WHERE `ID`='$session_id'";
				$q = mysqli_query( $GLOBALS[ 'con' ], $str2 );
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
}
}
?>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
<div class="panel panel-primary">
      <div class="panel-heading">Edit Profile</div>
      <div class="panel-body">

      <p align="center"><img src="<?php echo htmlspecialchars($img_scr);?>" width=400 height=400 alt='error'></p>

	<form class="form-horizontal" action="<?php $_PHP_SELF ?>" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label class="control-label col-sm-2" for="email">Email:</label>
    <div class="col-sm-10">
      <input type="email" name="email" class="form-control" id="email" placeholder="<?php echo htmlspecialchars($user_data["email"]);?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="name">Name:</label>
    <div class="col-sm-10">
      <input type="text" name="name" class="form-control" id="name" placeholder="<?php echo htmlspecialchars($user_data["name"]);?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="id">ID:</label>
    <div class="col-sm-10">
      <input type="number" name="id" class="form-control" id="id" placeholder="<?php echo htmlspecialchars($user_data["ID"]);?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="github">Github:</label>
    <div class="col-sm-10">
      <input type="url" name="github" class="form-control" id="github" placeholder="<?php echo htmlspecialchars($user_data["github"]);?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="bio">Bio:</label>
    <div class="col-sm-10">
      <input type="text" name="bio" class="form-control" id="bio" placeholder="<?php echo htmlspecialchars($user_data["bio"]);?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="image">DP:</label>
    <div class="col-sm-10">
      <input type="file" name="image" class="form-control" id="image">
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-success">Submit</button>
    </div>
  </div>
</form>

</div>
    </div>
</body>

</html>