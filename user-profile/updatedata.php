<?php

require_once("connect.php");

session_start();

/*if($_SESSION["login-status"] != 1 && $_SESSION["login-status"] != 2) {
	header("Location: ../../blog/sign.php");
}*/

if ( $GLOBALS[ 'con' ] ) {

if ( isset( $_POST[ 'id' ] ) ) {

	$name = $_POST[ "name" ];				echo $name . "<br>";                          //asigning new names to entered data
	$id = $_POST[ "id" ];						echo $id . "<br>";
	$email = $_POST[ "email" ];			echo $email . "<br>";
	$github = $_POST[ "github" ];		echo $github . "<br>";
	$bio = $_POST[ "bio" ];					echo $bio . "<br>";
	$session_id = $_SESSION["id"];
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

}
	else{
		header("Location: bootstrapform.php");
	}


	exit();

}
?>
