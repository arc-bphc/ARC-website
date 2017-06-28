
<!DOCTYPE html>
<html>
<head>
	<title>ARC Projects</title>
    <link rel="stylesheet" href="./bootstrap4/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./display-posts.css">
    <script src="jquery.min.js"></script>
    <script src="./bootstrap4/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/1523c943cd.js"></script>
	<script src="https://apis.google.com/js/platform.js" async defer></script> 
    <script type="text/javascript" src="./display-posts.js"></script>
</head>
<body>
<?php
session_start();

echo "<nav class=\"navbar navbar-toggleable-md navbar-inverse bg-inverse\">
  <button class=\"navbar-toggler navbar-toggler-right\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarTogglerDemo02\" aria-controls=\"navbarTogglerDemo02\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
    <span class=\"navbar-toggler-icon\"></span>
  </button>
  <a class=\"navbar-brand\" href=\"#\">";
if(!isset($_SESSION["login-status"]) || empty($_SESSION["login-status"])) {
   $_SESSION["login-status"] = 0;
   	echo "Guest";
}
else {
	echo $_SESSION["user"];
}

echo "</a>
  <div class=\"collapse navbar-collapse\" id=\"navbarTogglerDemo02\">
    <ul class=\"navbar-nav mr-auto mt-2 mt-md-0\">
      <li class=\"nav-item active\">
        <a class=\"nav-link\" href=\"#\">Home <span class=\"sr-only\">(current)</span></a>";

if($_SESSION["login-status"] == 1 || $_SESSION["login-status"] == 2){
	echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"form.php\">Write Post</a></li>";
}

if($_SESSION["login-status"] == 2){
	echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"adminPanel.php\">Admin Panel</a></li>";
}

echo "<li class=\"nav-item\">
        <a class=\"nav-link\" href=\"sign.php\" onclick=\"signOut();\">";

if($_SESSION["login-status"] == 0){
	echo "Login";
}
else{
echo "Logout";
}

echo "</a>
      </li>
    </ul>
    <form class=\"form-inline my-2 my-lg-0\">
      <input class=\"form-control mr-sm-2\" type=\"text\" placeholder=\"Search\">
      <button class=\"btn btn-outline-success my-2 my-sm-0\" type=\"submit\">Search</button>
    </form>
  </div>
</nav>";



require_once '../config.php';

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM posts where status = 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

	echo "<div class = \"card-deck\">";
    // output data of each row
    while($row = $result->fetch_assoc()) {
	    	$imageString = $row["images"];
	    	//print_r($imageString);
	    	$images = explode('#', $imageString);
	    	//print_r($images);
	    	$postid = $row["id"];
	    	$abstract = substr($row["content"],0,140);    	

	    	echo "<div class = \"card col-sm-3\">";

	        if($imageString != ""){
	        	echo "<img class = \"card-img-top centerimages\" src=\"" . $images[0] . "\" height = \"100%\" width = \"100%\">";
	    	}
	        echo "<div class = \"card-block\"><h4 class = \"card-title\">" . $row["title"]. "</h4>";
	        echo "<p class = \"card-text\">" . $abstract . "....  <a style = \"cursor:pointer;color: blue;\" onclick=\"openNav(". $postid .")\">Read More</a></div>";

	        
	        echo "<div class = \"card-footer\">" ."By:- ". $row["author"] . "<br>". $row["uploadtime"];
			if($_SESSION["login-status"] == 2){
				echo " <div><button onclick=\"manage(". $postid .", 2)\">Withdraw From Publication</button></div> ";
			}
			echo "</div></div>";


			echo "<div id=\"myNav\" class=\"overlay\">
			  <a id=\"closebtn\" href=\"javascript:void(0)\" class=\"closebtn\" onclick=\"closeNav()\">&times;</a>
			  <div id = \"overlay-content\" class=\"overlay-content\">
			  	<div id=\"header\"></div>
			  	<h3>Photos:</h3>
			    <div class = \"row\" id=\"images\"></div>
			    <div id=\"content\"></div>
			    <div id=\"video\"></div>
			  </div>
			</div>";
    }
    echo "</div>";

} 
else {
    echo "<h2>0 results</h2>";
}

$conn->close();

?>

</body>
</html>