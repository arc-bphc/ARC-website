<?php
	require_once 'connect.php';

	$id = $_REQUEST["q"];
	$str="UPDATE `users` SET `isadmin`='1' WHERE `ID`='$id'";
	$q = mysqli_query( $GLOBALS[ 'con' ], $str );

	if ( $q ) {
		$message = "the selected user is granted the power";
		$jsondata['message']=$message;
	} else {
		die( mysqli_error( $GLOBALS[ 'con' ] ) );
		$message = "user denied of power due to some technical issues";
		$jsondata['message']=$message;
	}

	$jencoded = json_encode($jsondata);
    // Output "no suggestion" if no hint was found or output correct values 
    echo $jencoded;
?>