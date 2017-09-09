
<!DOCTYPE html>
<html lang="en">
<head>
	<title>ARC Projects</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap4/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./display-posts.css">
    <link rel="icon" href="images/arc.png" type="image/png">
    <script src="./jquery.min.js"></script>	
    <script src="./bootstrap4/js/bootstrap.min.js"></script>    
	<script src="https://use.fontawesome.com/1523c943cd.js"></script>
	<script src="../imagesLoaded.js"></script>
    <script type="text/javascript" src="./display-posts.js"></script>
</head>
<body>
<div id="loader-wrapper">
    <div id="loader"></div>
 
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
 
</div>
<?php
session_start();

if($_SESSION["login-status"] != 2) {
   header("Location: sign.php");
}

echo "<nav class=\"navbar navbar-toggleable-md navbar-inverse bg-inverse\">
  <button class=\"navbar-toggler navbar-toggler-right\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarTogglerDemo02\" aria-controls=\"navbarTogglerDemo02\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
    <span class=\"navbar-toggler-icon\"></span>
  </button>
  <a class=\"navbar-brand\" href=\"../user-profile/editProfile.php\"><img class=\"profile-pic rounded\" src=\"" . $_SESSION["picture"] . "\">" . $_SESSION["user"]."</a>
  <div class=\"collapse navbar-collapse\" id=\"navbarTogglerDemo02\">
    <ul class=\"navbar-nav mr-auto mt-2 mt-md-0\">
      <li class=\"nav-item\">
        <a class=\"nav-link\" href=\"../home/index.php\">Home</a></li>
      <li class=\"nav-item\"><a class=\"nav-link\" href=\"form.php\">Write Post</a></li>
      <li class=\"nav-item\"><a class=\"nav-link\" href=\"index.php\">Reader</a></li>
      <li class=\"nav-item\">
        <a class=\"nav-link\" href=\"../home/index.php?status=2\">Logout</a>
      </li>
     <li class=\"nav-item\">
      <div class=\"dropdown\">
		  <button class=\"btn btn-secondary dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
		    Category
		  </button>
		  <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
		  	<a class=\"dropdown-item\" href=\"#\">All</a>
		    <a class=\"dropdown-item\" href=\"#\">General</a>
		    <a class=\"dropdown-item\" href=\"#\">Software</a>
		    <a class=\"dropdown-item\" href=\"#\">Arduino</a>
		    <a class=\"dropdown-item\" href=\"#\">Miscellaneous</a>
		  </div>
		</div>
      </li>
    </ul>
	<form class=\"form-inline my-2 my-lg-0\">
    <input id=\"searchBar\" class=\"form-control mr-sm-2\" type=\"text\" onkeyup=\"searchBlog()\" placeholder=\"Search Title or Author\">
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

$sql = "SELECT * FROM blogPosts where status = 0";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
   	echo "<div class = \"card-deck\">";
    while($row = $result->fetch_assoc()) {
	    	$content = $row["content"];

    		if(strpos($content,"src=")){
		    	$start = strpos($content,"src=");
		    	$start+=5;
		    	$path = substr($content,$start);
		    	$end = strpos($path,"\"");
		    	$image = substr($path,0,$end);
	    	}
	    	else{
	    		$image = "./uploads/default.jpg";
	    	}
	    	// echo "<b>" . $image . "</b>";
	    	$postid = $row["id"];
	    	$category = $row["category"];
	    	$date = substr($row["uploadtime"],0,10);

	    	  	
			echo "<div class = \"card col-sm-3 card-inverse " . $category . "\">";

			echo "<img class = \"card-img centerimages\" src=\"" . $image . "\" height = \"100%\" width = \"100%\">";

	    	echo "<a href=\"viewPost.php?postid=$postid\"><div class = \"card-img-overlay\"><h4 class = \"card-title\">" . $row["title"]. "</h4></div></a>";

	        
	        echo "<div class = \"card-footer\"><div class=\"author\">". $row["author"] . "</div>". "<p id=\"date". $postid ."\"><script>formatDate(\"$date\",$postid);</script></p>";	    	echo "
	    		 		<div>
	    		 			<button onclick=\"manage(". $postid .", 0)\">Delete</button>
	    		 			<button onclick=\"manage(". $postid .", 1)\">Publish</button>
	    		 		</div>
	    		 	</div>
	    		 </div>";


	  //   	echo "<div id=\"myNav\" class=\"overlay\">
			//   <a id=\"closebtn\" href=\"javascript:void(0)\" class=\"closebtn\" onclick=\"closeNav()\">&times;</a>
			//   <div id = \"overlay-content\" class=\"overlay-content\">
			//   	<div id=\"header\"></div>
			//   	<h3>Photos:</h3>
			//     <div class = \"row\" id=\"images\"></div>
			//     <div id=\"content\"></div>
			//     <div id=\"video\"></div>
			//   </div>
			// </div>";

    }
    echo "</div>";

} 
else {
    echo "<h2 id=\"noPosts\">No new posts</h2>";
}

$conn->close();

?>

</body>
<script type="text/javascript">
$('body').imagesLoaded().always( function( instance ) {
	$('body').imagesLoaded().always( { background: '.item' }, function() {
	  $('body').addClass('loaded');
	});
 });
</script>
</html>