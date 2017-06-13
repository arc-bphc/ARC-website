
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./display-posts.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php

$servername = "localhost";
$username = "root";
$password = "*****";
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
    	$imageString = $row["images"];
    	//print_r($imageString);
    	$images = explode('#', $imageString);
    	//print_r($images);
    	//echo count($images);
        echo "<h3>" . $row["title"]. "</h3><h4>" ."By:". $row["author"] . "</h4>". $row["uploadtime"] . "<br><hr>";
        for ($i=0; $i < count($images) - 1; $i++) { 
        	echo "<img src=\"" . $images[$i] . "\" height = \"300px\" width = \"300px\">";
        }
        echo "<div><p>" . $row["content"] . "</p></div>";

        $step1=explode('v=', $row["video"]);
		$step2 =explode('&',$step1[1]);
		$videoId = $step2[0];
		//echo $videoId;
		echo "<iframe src=\"https://www.youtube.com/embed/" . $videoId ."\" width=\"320\" height=\"240\" frameborder=\"0\" allowfullscreen></iframe><hr>";

    }
} 
else {
    echo "0 results";
}

$conn->close();

?>
</body>
</html>
