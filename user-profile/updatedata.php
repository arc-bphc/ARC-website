<?php

require_once("connect.php");

session_start();

if($_SESSION["login-status"] != 1 && $_SESSION["login-status"] != 2) {
	header("Location: ../blog/sign.php");
}

if ( $GLOBALS[ 'con' ] ) {

	$qry = "SELECT * FROM users WHERE id = ".$_SESSION["id"];                       //
	$user_datalist = $GLOBALS[ 'con' ]->query($qry);                                //fetch data of loggedin user
	$user_data = $user_datalist->fetch_assoc();
	$id = $_SESSION["id"];
	$email = $user_data['email']; 
	$github = $user_data['github'];
	$bio = $user_data['bio'];


if ( isset( $_POST[ 'email' ] ) || isset( $_POST[ 'github' ] ) || isset( $_POST[ 'bio' ] ) || isset($_FILES['image'])  ) {

	//$name = $_POST[ "name" ];				echo $name . "<br>";                          
	//$id = $_POST[ "id" ];						echo $id . "<br>";
	if(isset($_POST["email"]) && !empty($_POST["email"]))
	$email = $_POST[ "email" ];								//echo $email . "<br>";					//asigning new names to entered data
	if(isset($_POST["github"]) && !empty($_POST["github"]))
	$github = $_POST[ "github" ];							//echo $github . "<br>";
	if(isset($_POST["bio"]) && !empty($_POST["bio"]))
	$bio = $_POST[ "bio" ];					//echo $bio . "<br>";
	$session_id = $_SESSION["id"];
	if(isset($_FILES['image']) && !empty($_FILES['image'])){                   //managing uploaded picture
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
				$file_name = "\\\\ARC-website\\\\user-profile\\\\dp\\\\" . $id . "." . $file_ext;      //saving file in "dp" folder
				//$str = "UPDATE INTO `users` (`name`, `picture`, `email`, `github`, `bio`, `id`) VALUES ('{$name}', '{$file_name}', '{$email}', '{$github}', '{$bio}', '{$id}') WHERE `ID`='$session_id'";
		 }else{
				print_r($errors);
		 }
	}
	if($file_name==""){
	$str2="UPDATE `users` SET `email`='{$email}',`github`='{$github}',`bio`='{$bio}' WHERE `id`='$session_id'";
	$q = mysqli_query( $GLOBALS[ 'con' ], $str2 );                          //updating database with new info
	}
	else {
	$str2="UPDATE `users` SET `picture`='{$file_name}',`email`='{$email}',`github`='{$github}',`bio`='{$bio}' WHERE `id`='$session_id'";
	$q = mysqli_query( $GLOBALS[ 'con' ], $str2 );                          //updating database with new info
	}
	if ( $q ) {
		echo "user inserted";
		sleep(2);
		header("Location: bootstrapform.php");		
	} else {
		echo "sql error";
		sleep(2);
		die( mysqli_error( $GLOBALS[ 'con' ] ) );
		header("Location: bootstrapform.php");
	}

}
	else{
		header("Location: bootstrapform.php");
	}


	exit();

}
?>
