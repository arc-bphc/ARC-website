
<!DOCTYPE html>
<html>
<head>
	<title>ARC Projects</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./display-posts.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="./display-posts.js"></script>
</head>
<body>
<?php
session_start();

if(!isset($_SESSION["login-status"]) || empty($_SESSION["login-status"])) {
   $_SESSION["login-status"] = 0;
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM posts";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	if($row["status"] == 0){
	    	$imageString = $row["images"];
	    	//print_r($imageString);
	    	$images = explode('#', $imageString);
	    	//print_r($images);
	    	$postid = $row["id"];
	    	$abstract = substr($row["content"],0,20);    	

	    	//echo count($images);
	    	echo "<h1>" . (string)$_SESSION["login-status"] . "</h1>";

	        echo "<h3>" . $row["title"]. "</h3><h4>" ."By:". $row["author"] . "</h4>". $row["uploadtime"] . "<br><hr>";
	        for ($i=0; $i < count($images) - 1; $i++) { 
	        	echo "<img src=\"" . $images[$i] . "\" height = \"300px\" width = \"300px\">";
	        }
	        echo "<div>" . $abstract . "....  <a style = \"cursor:pointer\" onclick=\"openNav(". $postid .")\">Read More</a></div>";

    	    echo " <button onclick=\"manage(". $postid .", 0)\">Delete</button> ";
	        echo " <button onclick=\"manage(". $postid .", 1)\">Publish</button> ";

	        // echo "<div><div><p>" . $row["content"] . "</p></div>";

	        $step1=explode('v=', $row["video"]);
			$step2 =explode('&',$step1[1]);
			$videoId = $step2[0];
			//echo $videoId;
			echo "<iframe src=\"https://www.youtube.com/embed/" . $videoId ."\" width=\"320\" height=\"240\" frameborder=\"0\" allowfullscreen></iframe><hr></div>";




			echo "<div id=\"myNav\" class=\"overlay\">
			  <a id=\"closebtn\" href=\"javascript:void(0)\" class=\"closebtn\" onclick=\"closeNav()\">&times;</a>
			  <div id = \"overlay-content\" class=\"overlay-content\">
			  	<div id=\"header\"></div>
			    <div class = \"row\" id=\"images\"></div>
			    <div id=\"content\"></div>
			    <div id=\"video\"></div>
			  </div>
			</div>";
		}
    }

} 
else {
    echo "0 results";
}

$conn->close();
session_destroy();

?>

</body>
</html>