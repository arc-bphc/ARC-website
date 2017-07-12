<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='css/bootstrap.css' rel='stylesheet' />
    <link href='css/rotating-card.css' rel='stylesheet' />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>

    <script src="https://use.fontawesome.com/0162dabc99.js"></script>
    <script>
    $(document).ready(function(){                                                     //jquery script to pass ID of the profile whom you want to make admin
      $("#mkadmin_button").click(function(){
        var xmlhttp = new XMLHttpRequest();
        var identity = document.getElementById("newadminid").value;
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var myobj = JSON.parse(this.responseText);
                //document.getElementById("name").innerHTML = myobj.name;
                //document.getElementById("bio").innerHTML = $("#name").text();
                //$("#name").val(myobj.name);
                //$(e.currentTarget).getElementById('name').val(myobj.name);
                alert("Text: " + myobj.message);
            }
        };
        xmlhttp.open("GET", "makeadmin.php?q=" + identity, true);                     //call makeadmin with id number to provide administrator previllages to that member
        xmlhttp.send();
    })
});
    
    function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
       auth2.signOut().then(function () {
       console.log('User signed out.');
      });
    }
    


</script>
<style type="text/css">
  #section {
    margin: 10px;
    background-color: rgb(204, 204, 204);
    padding: 25px;
}
  .modal .custom .modal-dialog {
    
    background-color: grey;
    width:40%;
    margin:0 auto;
    padding: 0;
    color: grey;
    /*add what you want here*/
}
  .subinfo {
    padding-left: 30px;
  }

  .title {
    padding-bottom: 15px;
  }
  .rounded {
    margin: 0;
    padding: 0;
  }
  .rounded-circle {
    width: 20%;
    height:auto;
    margin: 2%;
  }
  .img-fluid {
    width : 100%;
    height: auto;
  }
  .modal-backdrop {
   background-color: grey;
}
  #propic {
    width: 50%;
  }
  .card {
    background-clip: padding-box;
    border: 10px solid transparent;
  }
  #bg {
    width: 80%;
    margin: auto;
    margin-top: 0px;
  }
  i {
    margin:auto;
    float: center;
  }
  .btn-icon {
    padding: 5px;
    font-size: 22px;
    line-height: normal;
    margin: 4px;
    text-align: center;
    align-content: middle;
    -webkit-border-radius: 0px;
       -moz-border-radius: 0px;
            border-radius: 0px;
    }

</style>
 </head>
<?php
session_start();
  require_once 'connect.php';

  //echo "<b>CHECKING CONNECTION</b> <br>";
  if ( $GLOBALS[ 'con' ] ) {
	   //echo 'Successfull <br><br>';
    if($_SESSION["login-status"] != 1 && $_SESSION["login-status"] != 2) {
        header("Location: ../blog/sign.php");
    }

  echo "<nav class=\"navbar navbar-toggleable-md navbar-inverse bg-inverse\">
    <button class=\"navbar-toggler navbar-toggler-right\" type=\"button\" data-toggle=\"collapse\" data-target=\" #navbarTogglerDemo02\" aria-controls=\"navbarTogglerDemo02\" aria-expanded=\"false\" aria-label=\"Toggle   navigation\">
      <span class=\"navbar-toggler-icon\"></span>
     </button>
    <div class=\"collapse navbar-collapse\" id=\"navbarTogglerDemo02\">
     <ul class=\"navbar-nav mr-auto mt-2 mt-md-0\">
       <li class=\"nav-item active\">
         <a class=\"nav-link\" href=\"#\">Home <span class=\"sr-only\">(current)</span></a>
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

  $getList = mysqli_query($GLOBALS['con'],"SELECT * FROM users");         // fetch all user details
  //$i=1;
  ?>
  <div id=bg>
  <h2 class="title">
            Members
  </h2>
  <div class=row>  
  <?php
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
          <!-- Modal -->
              <div id="profilemodal'.$id.'" class="modal custom fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">

          <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title" >'.$name.'</h3>
                        <button type="button"  class="close ml-auto" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                        <div class="modal-body">
                          <p align="center"><img class="rounded-circle" id="propic" align="middle" src="'.$img_scr.'" alt="error"></p>
                          <div class="container-fluid" id="section">
                            <h5 class="title">Name</h5>
                            <h6 class="subinfo">'.$name.'</h6>
                          </div>
                          <div class="container-fluid" id="section">
                            <h5 class="title">Email Id.</h5>
                            <h6 class="subinfo">'.$email.'</h6>
                          </div>
                          <div class="container-fluid" id="section">
                            <a href='.$github.'><h6 class="subinfo">Github</h6></a>
                          </div>
                          <div class="container-fluid" id="section">
                            <h5 class="title">Bio</h5>
                            <h6 class="subinfo">'.$bio.'</h6>
                          </div>
                        </div>
                      <div class="modal-footer">
                        <input id="newadminid" type="hidden" name="adminid" value='.$id.'></input>
                            <button id="mkadmin_button" type="submit" '.$isadmin.' class="btn btn-success">Make Admin</button>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>

                </div>
              </div>

            <div class="col-md-4 col-sm-6">
             <div class="card-container">
                <div class="card">
                    <div class="front">
                        <div class="cover">
                            <img src="'.$img_scr.'"/>
                        </div>
                        <div class="user">
                            <img class="img-circle" src="'.$img_scr.'"/>
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
          //$i++;
	     }
       
   }
?>
</div>
<h2 class="title">Admins</h2>
<div class=row>
<?php
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
    <!--<a data-toggle="modal" href="#profilemodal'.$id.'">
      <img class="rounded-circle" src="'.$img_scr.'" alt="error">'.$name.'</img>
      </a>    <!--Image to click , which will trigger respective profilemodal

      <div class="card col-md-3" style="width: 20%;" style="height: 40%;">
      <img class="card-img-top img-fluid" src="'.$img_scr.'" alt="'.$name.'">
        <div class="card-block">
          <a class="btn-icon btn-primary" href="#" aria-label="Skip to main navigation" >
              <i class="fa fa-facebook-official" aria-hidden="true" ></i>
          </a>
          <a class="btn-icon btn-success" href='.$github.' aria-label="Skip to main navigation" >
              <i class="fa fa-github" aria-hidden="true"></i>
          </a>
          <a class="btn-icon btn-danger" href="#" aria-label="Skip to main navigation" >
              <i class="fa fa-google-plus-circle" aria-hidden="true"></i>
          </a>
          <a class="btn-icon btn-primary" href="#" aria-label="Skip to main navigation" >
              <i class="fa fa-linkedin-square" aria-hidden="true"></i>
          </a>
          <h4 class="card-title" style="margin-top:10px;">'.$name.'</h4>
          <p class="card-text">'.$email.'</p>
          <a href="#profilemodal'.$id.'" data-toggle="modal" class="btn btn-primary">View More</a>
        </div>
      </div>-->

      <div class="col-md-4 col-sm-6">
             <div class="card-container">
                <div class="card">
                    <div class="front">
                        <div class="cover">
                            <img src="'.$img_scr.'"/>
                        </div>
                        <div class="user">
                            <img class="img-circle" src="'.$img_scr.'"/>
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
      //$i++;
    }
?>
</div>
</div>

 <body background-color="grey">
   <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
 </body>
  </html>
