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
echo "<img src=$img_scr width=400 height=400 alt='error'>";

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

	<form action="<?php $_PHP_SELF ?>" method="POST" enctype="multipart/form-data">
		Name: 						<input type="text" 		name="name" 	value="<?php echo htmlspecialchars($user_data["name"]);?>" 	/>
		BITS ID: 					<input type="number" 	name="id" 		value="<?php echo htmlspecialchars($user_data["ID"]);?>" 	maxlength="7" pattern="[0-9]{7}" />
		Email: 						<input type="email" 	name="email" 	value="<?php echo htmlspecialchars($user_data["email"]);?>"	/>
		GitHub Profile: 	<input type="url" 		name="github" value="<?php echo htmlspecialchars($user_data["github"]);?>"	/>
		Bio: 							<input type="text" 		name="bio" 		value="<?php echo htmlspecialchars($user_data["bio"]);?>"	/>
		Display Image: 		<input type="file" 		name="image" 	/>
											<input type="submit"/>
	</form>

</body>

</html>
