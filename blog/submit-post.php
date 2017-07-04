<?php 
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$blogTitle = $_POST["blogTitle"];
$author = $_SESSION["user"];
$content = $_POST["content"];
$videolink = $_POST["video-link"];
if($blogTitle == ""){
	die("invalid title");
    return false;
}
else if($author == ""){
	die("invalid author");
    return false;
}
else if($content == ""){
    die("empty content");
    return false;
}


if (!file_exists('uploads/' . $blogTitle)) {
    mkdir('uploads/' . $blogTitle, 0777, true);
}

$total = count($_FILES['imgToUpload']['name']);

//upload image
$target_dir = "uploads/" . $blogTitle . "/";    
// echo $target_dir;


$imageString = "";

// print_r($_FILES["imgToUpload"]);
///upload images--------------------------------------
for ($i=0; $i < $total; $i++) { 
    $target_file = $target_dir . basename($_FILES["imgToUpload"]["name"][$i]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["imgToUpload"]["tmp_name"][$i]);
    if($check != false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    }
    else {
        echo "<br>File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    // if (file_exists($target_file)) {
    //     echo "Sorry, file already exists.";
    //     $uploadOk = 0;
    // }

    	// Check file size
    // if ($_FILES["fileToUpload"]["size"] > 500000) {
    //     echo "Sorry, your file is too large.";
    //     $uploadOk = 0;
    // }

	// Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "<br>Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "<br>Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } 
    else {
        if (move_uploaded_file($_FILES["imgToUpload"]["tmp_name"][$i], $target_file)) {
            echo "The file ". basename( $_FILES["imgToUpload"]["name"][$i]). " has been uploaded.\n";
            $imageString = $imageString . $target_file . "#";

        }
        else {
            echo "<br>Sorry, there was an error uploading your file.";
        }
    }

}




//insert into database
require_once '../config.php';

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO posts (title, author, images, video, content,uploadtime,status)
VALUES ('$blogTitle', '$author', '$imageString', '$videolink', '$content',now(),0)";

if (mysqli_query($conn, $sql)) {
    echo "<br>New record created successfully";


} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
echo "<div><a href = \"./display-posts.php\">See posts</a>";
?>
