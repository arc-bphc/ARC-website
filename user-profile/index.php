<?php
  require_once 'connect.php';

  echo "<b>CHECKING CONNECTION</b> <br>";
  if ( $GLOBALS[ 'con' ] ) {
	   echo 'Successfull <br><br>';


  $session_id = 2016441;                                                  //hardcoded sesson untill we integrate the codebase together
  $qry = "SELECT * FROM `users` WHERE `ID`='$session_id'";                //
  $user_datalist = $GLOBALS[ 'con' ]->query($qry);                        //      fetch details of the current loggedin user
  $user_data = $user_datalist->fetch_assoc();                             //

  $getList = mysqli_query($GLOBALS['con'],"SELECT * FROM users");         // fetch all user details
  $i=1;
  while ($result = mysqli_fetch_array($getList)) {                       //loop through all the users
    $id = $result['ID'];
    $name = $result['name'];
		$email = $result['email'];
    $github = $result['github'];
		$img_scr= $result['picture'];
    $bio = $result['bio'];
    $isadmin = 'disabled="disabled"';
    if(!$result['isadmin'] && $user_data['isadmin']){ $isadmin="";}                       //unique modal for every user which gets triggered when you click their picture
    echo '
          <!-- Modal -->
              <div id="profilemodal'.$i.'" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">

          <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title" >'.$name.'</h3>
                        <button type="button"  class="close ml-auto" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                        <div class="modal-body">
                          <p align="center"><img class="rounded" align="middle" src="'.$img_scr.'" width=400 alt="error"></p>
                          <p><h4 class="bg-info" align="center">'.$id.'<h4></p>
                          <p><h4 class="bg-info" align="center">'.$email.'<h4></p>
                          <a href='.$github.'><p><h4 class="bg-info" align="center" >github<h4></p></a>
                          <p><h4 class="bg-info" align="center" >'.$bio.'<h4></p>
                        </div>
                      <div class="modal-footer">
                        <input id="newadminid" type="hidden" name="adminid" value='.$id.'></input>
                            <button id="mkadmin_button" type="submit" '.$isadmin.' class="btn btn-success">Make Admin</button>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>

                </div>
              </div>

          <a data-toggle="modal" href="#profilemodal'.$i.'"><img class="rounded-circle" src="'.$img_scr.'" width=400 height=400 alt="error"></a>    <!--Image to click , which will trigger respective profilemodal-->
          ';
          $i++;
	     }
   }
?>

  <html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">        <!--source to include bootstrap-->
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



</script>

 </head>
 <body>
   <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
 </body>
  </html>
