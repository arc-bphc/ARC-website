
<!DOCTYPE html>
<html lang="en">
<head>
	<title>ARC Projects</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap4/css/bootstrap.min.css">
    <link rel="icon" href="images/arclogo.png" type="image/png">
    <script src="jquery.min.js"></script>
    <script src="typed.js/lib/typed.js"></script>
    <script src="./bootstrap4/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/1523c943cd.js"></script>
	<style type="text/css">
		html{
			overflow-y: auto;
		}
		body{
			font-family: Helvetica,Arial,sans-serif; 
			overflow-x: hidden;
			overflow-y: auto;
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
			height: 100%;
		}
		.author-date{
			font-size: 1.3em;
			font-style: italic;
			font-family: 'Palatino Linotype', 'Book Antiqua', Palatino, serif;
			font-weight: bold;
			margin-bottom: 30px;
		}

		#content {
		    border: 15px solid transparent;
		    padding: 15px;
		    -webkit-border-image: url(images/border.png) 50 round; /* Safari 3.1-5 */
		    -o-border-image: url(images/border.png) 50 round; /* Opera 11-12.1 */
		    border-image: url(images/border.png) 50 round;
		}
		.back-icon{
			color: #000;
			position: absolute;
			left: 20%;
			font-size: 30px;
			z-index: 100;
		}
		.back-icon a{
			text-decoration: none;
			color: #000;
		}
		.back-icon a:hover{
			color: #777;
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
		  return displayDate;
		}
	</script>
</head>
<body>
<?php
session_start();

$postid = $_GET['postid'];
require_once '../config.php';

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if($_SESSION["login-status"] == 2) {
   $sql = "SELECT * FROM blogPosts where id = $postid";
}
else{
	$sql = "SELECT * FROM blogPosts where status = 1 and id = $postid";
}
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$blogPost = $row['content'];
$title = $row['title']; 
$author = $row['author'];
$date = substr($row['uploadtime'],0,10);
?>


<div class="back-icon"><a href="index.php"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a></div>

<div class="row page">
	<div class="col-md-2 side"></div>
	<div class="col-md-8 main">
		<div class="row">
			<h1 id="title"></h1>
		</div>
		<div class="row">
			<div class="col-md-9 col-sm-6"></div>
			<div class="col-md-3 col-sm-6 author-date"><span id="author"></span><br>
				<p><span id="date"></span>
				</p>	
			</div>
			</div>
			<div id="content" class="row"><?php echo $blogPost ?></div>";


			<div id="disqus_thread"></div></div>
			<div class="col-md-2 side"></div></div>
			

			<!-- typed.js  to create live typing effect-->
			<script >
				var typed = new Typed('#title', {
					strings: ["<?php echo $title ?>"],
					typeSpeed: 30,
					showCursor: true,
					cursorChar: "_",
					loop: false
				});

				var typed = new Typed('#author', {
					strings: ["<?php echo $author ?>"],
					typeSpeed: 30,
					showCursor: true,
					cursorChar: "_",
					loop: false
				});
				var date = formatDate("<?php echo $date ?>");
				console.log(date);
				var typed = new Typed('#date', {
					strings: [formatDate("<?php echo $date ?>")],
					typeSpeed: 30,
					showCursor: true,
					cursorChar: "_",
					loop: false
				});

			</script>


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