<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link href='css/bootstrap.css' rel='stylesheet' /> -->
    <link href='css/rotating-card.css' rel='stylesheet' />
    <link rel="stylesheet" href="../blog/bootstrap4/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="index.css">

    <script type="text/javascript" src="../blog/jquery.min.js"></script>          <!-- not necesssary??????????-->
    <script src="https://use.fontawesome.com/1523c943cd.js"></script>
    <script type="text/javascript" src="../blog/bootstrap4/js/bootstrap.min.js"></script>
    <!-- <script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>    --> <!--is this not needed???????-->
    <script type="text/javascript" src="index.js"></script>
 </head>
  <body>
<?php
  session_start();
  require_once 'connect.php';

  //echo "<b>CHECKING CONNECTION</b> <br>";
  if ( $GLOBALS[ 'con' ] ) {
	   //echo 'Successfull <br><br>';

  echo "<nav class=\"navbar navbar-toggleable-md navbar-inverse bg-inverse\">
    <button class=\"navbar-toggler navbar-toggler-right\" type=\"button\" data-toggle=\"collapse\" data-target=\" #navbarTogglerDemo02\" aria-controls=\"navbarTogglerDemo02\" aria-expanded=\"false\" aria-label=\"Toggle   navigation\">
      <span class=\"navbar-toggler-icon\"></span>
     </button>
    <div class=\"collapse navbar-collapse\" id=\"navbarTogglerDemo02\">
     <ul class=\"navbar-nav mr-auto mt-2 mt-md-0\">
       <li class=\"nav-item\">
         <a class=\"nav-link\" href=\"../home/home.html\">Home</a>
       <li class=\"nav-item\"><a class=\"nav-link\" href=\"../blog/form.php\">Write Post</a></li>
       <li class=\"nav-item\"><a class=\"nav-link\" href=\"../blog/display-posts.php\">Reader</a></li>
       <li class=\"nav-item\">
         <a class=\"nav-link\" href=\"../blog/sign.php\" onclick=\"signOut();\">Logout</a>
       </li>
     </ul>
   </div>
  </nav>";


  $session_id = $_SESSION['id'];                                                  //unique session id to identify loggedin user
  $qry = "SELECT * FROM `users` WHERE `ID`='$session_id'";                //
  $user_datalist = $GLOBALS[ 'con' ]->query($qry);                        //      fetch details of the current loggedin user
  $user_data = $user_datalist->fetch_assoc();                             //
        // fetch all user details
  //$i=1;
  
 echo '<div id="bg">';


echo '<h2 class="title">Admins</h2>
<div class="row">';

  $getList = mysqli_query($GLOBALS['con'],"SELECT * FROM users WHERE `isadmin`= 1");         // fetch all user details
  //$i=1;
   while ($result = mysqli_fetch_array($getList)) {                       //loop through all the users
    $id = $result['id'];
    $name = $result['name'];
    $email = $result['email'];
    $github = $result['github'];
    $img_scr= $result['picture'];
    $bio = $result['bio'];
   echo '

      <div class="col-md-3 col-sm-6">
             <div class="card-container">
                <div class="card">
                    <div class="front">
                        <div class="cover">
                            <img src="'.$img_scr.'"/>
                        </div>
                        <div class="user">
                            <img class="rounded-circle" src="'.$img_scr.'"/>
                        </div>
                        <div class="content">
                            <div class="main">
                                <h3 class="name">'.$name.'</h3>
                                <p class="profession">CEO</p>
                                <p class="text-center">'.$bio.'</p>
                            </div>
                            <div class="footer">
                                <i class="fa fa-mail-forward"></i> Auto Rotation
                            </div>
                        </div>
                    </div> <!-- end front panel -->
                    <div class="back">
                        <div class="header">
                            <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                        </div>
                        <div class="content">
                            <div class="main">
                                <h4 class="text-center">Job Description</h4>
                                <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>

                                <div class="stats-container">
                                    <div class="stats">
                                        <h4>235</h4>
                                        <p>
                                            Followers
                                        </p>
                                    </div>
                                    <div class="stats">
                                        <h4>114</h4>
                                        <p>
                                            Following
                                        </p>
                                    </div>
                                    <div class="stats">
                                        <h4>35</h4>
                                        <p>
                                            Projects
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="footer">
                            <div class="social-links text-center">
                                <a href="#" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                                <a href="#" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                                <a href="'.$github.'" class="github"><i class="fa fa-github fa-fw"></i></a>
                                <a href="#" class="linkedin"><i class="fa fa-linkedin fa-fw"></i></a>
                            </div>
                        </div>
                    </div> <!-- end back panel -->
                </div> <!-- end card -->
            </div> <!-- end card-container -->
        </div>
      ';
    }
    echo ' </div>';

 echo '<h2 class="title">Members</h2>
    <div class="row"> ';

  $getList = mysqli_query($GLOBALS['con'],"SELECT * FROM users where isadmin = 0"); 
  while ($result = mysqli_fetch_array($getList)) {                       //loop through all the users
    $id = $result['id'];
    $name = $result['name'];
		$email = $result['email'];
    $github = $result['github'];
		$img_scr= $result['picture'];
    $bio = $result['bio'];
    $isadmin = 'disabled="disabled"';
    if(!$result['isadmin'] && $user_data['isadmin']){ $isadmin="";}                       //unique modal for every user which gets triggered when you click their picture
   echo '
            <div class="col-md-3 col-sm-6">
             <div class="card-container">
                <div class="card">
                    <div class="front">
                        <div class="cover">
                            <img src="'.$img_scr.'"/>
                        </div>
                        <div class="user">
                            <img class="rounded-circle" src="'.$img_scr.'"/>
                        </div>
                        <div class="content">
                            <div class="main">
                                <h3 class="name">'.$name.'</h3>
                                <p class="profession">CEO</p>
                                <p class="text-center">'.$bio.'</p>
                            </div>
                            <div class="footer">
                                <i class="fa fa-mail-forward"></i> Auto Rotation
                            </div>
                        </div>
                    </div> <!-- end front panel -->
                    <div class="back">
                        <div class="header">
                            <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                        </div>
                        <div class="content">
                            <div class="main">
                                <h4 class="text-center">Job Description</h4>
                                <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>

                                <div class="stats-container">
                                    <div class="stats">
                                        <h4>235</h4>
                                        <p>
                                            Followers
                                        </p>
                                    </div>
                                    <div class="stats">
                                        <h4>114</h4>
                                        <p>
                                            Following
                                        </p>
                                    </div>
                                    <div class="stats">
                                        <h4>35</h4>
                                        <p>
                                            Projects
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="footer">
                            <div class="social-links text-center">
                                <a href="#" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                                <a href="#" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                                <a href="'.$github.'" class="github"><i class="fa fa-github fa-fw"></i></a>
                                <a href="#" class="linkedin"><i class="fa fa-linkedin fa-fw"></i></a>
                            </div>
                        </div>
                    </div> <!-- end back panel -->
                </div> <!-- end card -->
            </div> <!-- end card-container -->
        </div>
          ';
	     }
       
   }
echo '</div>';
?>
</div>

</body>
</html>
