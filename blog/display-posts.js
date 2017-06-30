var json, myObj;
function openNav(postid) {
	// console.log(postid);
	
    document.getElementById("myNav").style.height = "100%";


var obj, dbParam, xmlhttp;
obj = { "postid":postid };
dbParam = JSON.stringify(obj);

function loadJSON(path, callback) {
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	        json = this.responseText;
	        callback();
	    }

	};

	xmlhttp.open("GET", "json.php?x=" + dbParam, true);
	xmlhttp.send();
	return xmlhttp.onreadystatechange();
}



loadJSON('jconfig.json', function printJSONObject(){ 
	console.log(json);
	myObj = JSON.parse(json);
	var imageString = myObj[0].images;
	myObj = myObj[0];
	var imageArray = imageString.split("#");
	// console.log(imageArray.length);
	var d = Date.parse(myObj.uploadtime);
	d = new Date(d);
	// header-----------------------
	var header = document.getElementById("header");
	header.innerHTML = "<div id=\"blogTitle\"><h1>"+ myObj.title +"</h1><h3>By :- &nbsp"+ myObj.author +"</h3>\
	<h4>"+ d +"</h4></div>";

	//display images----------------
	//document.getElementById("images").innerHTML = "<h3>Photos:</h3>";
	for (var i = 0; i < (imageArray.length - 1); i++) {
		displayImage(imageArray[i]);
	}

	//display content---------------
	document.getElementById("content").innerHTML = "<div id=\"content-container\"><h3>Abstract:</h3><p>"+ myObj.content +"</p></div>";

	//display video------------------
	var step1 = myObj.video.split("v=");
	var step2 = step1[1].split("&");
	var videoId = step2[0];
	document.getElementById("video").innerHTML = "<iframe src=\"https://www.youtube.com/embed/" + videoId + "\" \
	width=\"640\" height=\"480\" frameborder=\"0\" allowfullscreen></iframe>"

	var overlay= document.getElementById("myNav");
	overlay.style.position = "fixed";
	overlay.style.overflowY = "scroll";
	overlay.style.overflowX = "hidden";

	var body = document.body;
	body.style.overflow = "hidden";

});;




}

function closeNav() {
    document.getElementById("myNav").style.height = "0%";
   	var div = document.getElementById("images").innerHTML = "";
   	var body = document.body;
	body.style.overflow = "scroll";

}

function displayImage(image) {
	var div = document.getElementById("images");
	console.log(image);
	div.innerHTML = div.innerHTML + "<div class = \"col-md-3 col-sm-6\"><img height = \"300\" width\
	 = \"300\" src =\"" + image + "\"></div>";

}

function manage(postid,pd) {
	console.log(postid);
	console.log(pd);
	var obj, dbParam, xmlhttp;
	if(pd == 1){
		obj = {"postid":postid , "managepost": 1};
	}
	else if(pd == 2){
		obj = {"postid":postid , "managepost": 2};
	}
	else if(confirm("Are you you sure you want to delete this post?")){
		obj = {"postid":postid , "managepost": 0};
	}
	dbParam = JSON.stringify(obj);

	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	        myObj = JSON.parse(this.responseText);
	        console.log(myObj);
	        location.reload();
	        
	    }

	};

	xmlhttp.open("GET", "managePosts.php?x=" + dbParam, true);
	xmlhttp.send();

}

function signOut() {
  var auth2 = gapi.auth2.getAuthInstance();
  auth2.signOut().then(function () {
    console.log('User signed out.');
  });
}

function searchBlog() {
    var input, filter, title, author, i;
    input = document.getElementById('searchBar');
    filter = input.value.toUpperCase();
    var posts = document.getElementsByClassName("card");
    //Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < posts.length; i++) {
        title = posts[i].getElementsByClassName("card-title")[0].innerHTML.toUpperCase();
        author = posts[i].getElementsByClassName("author")[0].innerHTML.toUpperCase();
        if (title.indexOf(filter) > -1 || author.indexOf(filter) > -1) {
            posts[i].style.display = "";
        } else {
            posts[i].style.display = "none";
        }
    }
}

// -------loader----------
$('body').imagesLoaded().always( function( instance ) {
    $('body').addClass('loaded');
  })