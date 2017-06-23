<?php
  require_once 'connect.php';

  echo "<b>CHECKING CONNECTION</b> <br>";
  if ( $GLOBALS[ 'con' ] ) {
	   echo 'Successfull <br><br>';


  $session_id = 2016441;
  $qry = "SELECT * FROM `users` WHERE `ID`='$session_id'";
  $user_datalist = $GLOBALS[ 'con' ]->query($qry);
  $user_data = $user_datalist->fetch_assoc();

  $getList = mysqli_query($GLOBALS['con'],"SELECT * FROM users");
  $i=1;
  while ($result = mysqli_fetch_array($getList)) {
    $id = $result['ID'];
    $name = $result['name'];
		$email = $result['email'];
    $github = $result['github'];
		$img_scr= $result['picture'];
    $bio = $result['bio'];
    $isadmin = 'disabled="disabled"';
    if(!$result['isadmin'] && $user_data['isadmin']){ $isadmin="";}
    echo '
          <!-- Modal -->
              <div id="profilemodal'.$i.'" class="modal fade" role="dialog">
                <div class="modal-dialog">

          <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      
                        <h3 class="modal-title" align="center" >'.$name.'</h3>
                      </div>
                        <div class="modal-body">
                          <p align="center"><img class="img-rounded" align="middle" src="'.$img_scr.'" width=400 alt="error"></p>
                          <p><h4 class="bg-info" align="center">'.$id.'<h4></p>
                          <p><h4 class="bg-info" align="center">'.$email.'<h4></p>
                          <a href='.$github.'><p><h4 class="bg-info" align="center" >github<h4></p></a>
                          <p><h4 class="bg-info" align="center" >'.$bio.'<h4></p>
                        </div>
                      <div class="modal-footer">
                        <input id="newadminid" type="hidden" name="adminid" value='.$id.'></input>
                            <button id="mkadmin_button"type="submit" '.$isadmin.' class="btn btn-success">Make Admin</button>

                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>

                </div>
              </div>
          
          <a data-toggle="modal" href="#profilemodal'.$i.'"><img class="img-circle" src="'.$img_scr.'" width=400 height=400 alt="error"></a>
          ';
          $i++;
	     }
   }
?>

  <html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script>
    $(document).ready(function(){
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
        xmlhttp.open("GET", "makeadmin.php?q=" + identity, true);
        xmlhttp.send();
    })
});



</script>

 </head>
  </html>
