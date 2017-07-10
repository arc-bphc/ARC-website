
<!DOCTYPE html>
<html>
<head>
	<title>ARC Projects</title>
    <link rel="stylesheet" href="./bootstrap4/css/bootstrap.min.css">
    <link rel="icon" href="images/arclogo.png" type="image/png">
    <script src="jquery.min.js"></script>
    <script src="./bootstrap4/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/1523c943cd.js"></script>
	<style type="text/css">
		body{
			font-family: Helvetica,Arial,sans-serif; 
		}
		#disqus_thread{
			margin: auto;
			padding-left: 10px;
			padding-right: 10px;
		}
		#content{
			margin: auto;
			margin-bottom: 70px;
			padding-left: 10px;
			padding-right: 10px;
		}
		.side{
			background-color: #3C3C3C;
		}
		.main{
			background-color: #F5F5F5;
		}
		#title{
			margin: auto;
			font-family: 'Times New Roman', Times, serif;
			font-weight: bold;
		}
		.page{
			height: 100vh;
		}
		.author-date{
			font-size: 1.3em;
			font-style: italic;
			font-family: 'Palatino Linotype', 'Book Antiqua', Palatino, serif;
			font-weight: bold;
			margin-bottom: 30px;
		}

	</style>
	<script type="text/javascript">
		function formatDate(str) {
		  var monthNames = [
		    "January", "February", "March",
		    "April", "May", "June", "July",
		    "August", "September", "October",
		    "November", "December"
		  ];

		  var parts = str.split('-');
		  var day = parts[2];
		  var year = parts[0];
		  var monthIndex = parseInt(parts[1]);

		  displayDate =  day + ' ' + monthNames[monthIndex] + ' ' + year;
		  document.getElementById("date").innerHTML = displayDate;
		}
	</script>
</head>
<body>
<?php

$postid = $_GET['postid'];
require_once '../config.php';

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM blogPosts where status = 1 and id = $postid";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$blogPost = $row['content'];
$title = $row['title']; 
$author = $row['author'];
$date = substr($row['uploadtime'],0,10);


echo "<div class=\"row page\"><div class=\"col-md-2 side\"></div><div class=\"col-md-8 main\">
		<div class=\"row\"><h1 id=\"title\">$title<h1></div>
		<div class=\"row\"><div class=\"col-md-9\"></div>
							<div class=\"col-md-3 author-date\">$author<br><p id=\"date\"><script>formatDate(\"$date\")</script></div></div>
		<div id=\"content\" class=\"row\">" . $blogPost . "</div>";

?>
<div id="disqus_thread"></div></div>
<div class="col-md-2 side"></div></div>

</body>
<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/

var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};

(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://arcwebsite.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
<!-- <script id="dsq-count-scr" src="//arcwebsite.disqus.com/count.js" async></script> -->
</body>
</html>