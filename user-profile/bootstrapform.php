<?php
session_start();
include("connect.php");
session_start();
if ( $GLOBALS[ 'con' ] ) {

  if($_SESSION["login-status"] != 1 && $_SESSION["login-status"] != 2) {
    header("Location: ../blog/sign.php");
  }


//$_SESSION["id"]=2016441;
$qry = "SELECT * FROM users WHERE id = ".$_SESSION["id"];                       //
$user_datalist = $GLOBALS[ 'con' ]->query($qry);                                //fetch data of loggedin user
$user_data = $user_datalist->fetch_assoc();                                     //
$img_scr= $user_data['picture'];                                                //
}
?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href='form-card.css' rel='stylesheet' />
  <link rel="stylesheet" href="../blog/bootstrap4/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="form.css">
  <script type="text/javascript" src="../blog/jquery.min.js"></script>
  <script src="https://use.fontawesome.com/1523c943cd.js"></script>
  <script type="text/javascript" src="../blog/bootstrap4/js/bootstrap.min.js"></script>
  <!--<script type="text/javascript" src="form.js"></script>-->
  <script>
    function signOut() {
      var auth2 = gapi.auth2.getAuthInstance();
      auth2.signOut().then(function () {
        console.log('User signed out.');
      });
    }
  </script>

  <style>
    .container {
      position: relative;
      margin: auto;
      width: auto;
      height: auto;
    }

    .image {
      opacity: 1;
      display: block;
      width: 400px;
      height: auto;
      margin-left: auto;
      margin-right: auto;
      transition: .5s ease;
      backface-visibility: hidden;
    }

    .middle {
      transition: .5s ease;
      opacity: 0;
      position: absolute;
      bottom: 0%;
      left: 50%;
      transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%)
    }

    .container:hover .image {
      opacity: 0.3;
    }

    .container:hover .middle {
      opacity: 1;
    }

    .text {
      background-color: #000000;
      color: white;
      font-size: 16px;
      padding: 16px 32px;
    }
  </style>
</head>

<body>
  <?php
  echo "<nav class=\"navbar navbar-toggleable-md navbar-inverse bg-inverse\">
  <button class=\"navbar-toggler navbar-toggler-right\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarTogglerDemo02\" aria-controls=\"navbarTogglerDemo02\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
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
  ?>

<form action="updatedata.php" method="POST" enctype="multipart/form-data">
  <div class="row" style="margin-top: 100px;">
    <div class="card-container col-md-3 col-sm-6 col-md-offset-3"">
      <div class="card">
        <div class="front">
          <div class="cover">
            <div class="form-inline justify-content-center">
              <label class="form-label" for="image">
                <div class="container">
                  <input type="file" name="image" class="form-control" id="image" style="display:none;">
                  <img src="<?php echo htmlspecialchars($img_scr);?>" class="image" alt='error'>             <!--added tooltip which shows when we hover over the image-->
                  <div class="middle">
                    <div class="text">click to change DP</div>
                  </div>
                </div>
              </label>
            </div>
          </div>
          <div class="content">
            <div class="main">
              <h3 class="name"><?php echo htmlspecialchars($user_data["name"]);?></h3>
              <p class="profession">CEO</p>
              <input type="email" name="email" class="form-control text-center" id="email" placeholder="<?php echo htmlspecialchars($user_data["email"]);?>">
            </div>
          </div>
        </div> <!-- end front panel -->
      </div>
    </div>
    <div class="card-container col-md-3 col-sm-6">
      <div class="card">
        <div class="front" style="height: 500px">
          <div class="header">
            <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
          </div>
          <div class="content">
            <div class="main">
              <h4 class="text-center">Bio</h4>
              <input type="text" name="bio" class="form-control text-center" id="bio" placeholder="<?php echo htmlspecialchars($user_data["bio"]);?>">

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
              <div class="form-group row github" style="margin: auto">
                <label for="github"><i class="fa fa-github fa-fw" style="color: black; margin-left: 10px;"></i></label>
                <div>
                  <input type="url" name="github" class="form-control" id="github" placeholder="<?php echo htmlspecialchars($user_data["github"]);?>">
                </div>
              </div>

              <div class="form-group row facebook" style="margin: auto">
                <label for="github"><i class="fa fa-facebook fa-fw" style="color: blue; margin-left: 10px;"></i></label>
                <div>
                  <input type="url" name="github" class="form-control" id="github" placeholder="<?php echo htmlspecialchars($user_data["facebook"]);?>">
                </div>
              </div>
              <div class="form-group row linkedin" style="margin: auto">
                <label for="github"><i class="fa fa-linkedin fa-fw" style="color: blue; margin-left: 10px;"></i></label>
                <div>
                  <input type="url" name="github" class="form-control" id="github" placeholder="<?php echo htmlspecialchars($user_data["linkedin"]);?>">
                </div>
              </div>
              <div class="form-group row linkedin" style="margin: auto">
                <label for="github"><i class="fa fa-google fa-fw" style="color: red; margin-left: 10px;"></i></label>
                <div>
                  <input type="url" name="github" class="form-control" id="github" placeholder="<?php echo htmlspecialchars($user_data["google"]);?>">
                </div>
              </div>
              <button type="submit" class="btn btn-success">Save</button>
            <!--<a href="#" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
            <a href="#" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
            <a href="'.$github.'" class="github"><i class="fa fa-github fa-fw"></i></a>
            <a href="#" class="linkedin"><i class="fa fa-linkedin fa-fw"></i></a>-->
          </div>
        </div>
      </div> <!-- end back panel -->
    </div> <!-- end card -->
  </div> <!-- end card-container -->
</div>
</form>



<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<script>
  $(function () {
          $('[data-toggle="tooltip"]').tooltip()          //this script enables tooltip
        })
      </script>

    </body>

    </html>
