    var googleUser = {};
    gapi.load('auth2', function(){
      auth2 = gapi.auth2.init({
        client_id: '774440701303-rv2gilg9fk78eh25uf6jhd9s9o0k5mio.apps.googleusercontent.com'
      });
      attachSignIn();
    });

  function attachSignIn() {
    auth2.attachClickHandler(document.getElementById('customSignInBtn'), {},
        function(googleUser) {
          SignIn(googleUser);
        }, function(error) {
          
        });
  }



  function SignIn(googleUser) {
    var profile = googleUser.getBasicProfile();

    var obj, dbParam, xmlhttp;
    obj = {
       "id" :  profile.getId(),
       "name" : profile.getName(),
       "email" : profile.getEmail(),
       "picture" : profile.getImageUrl()
    };
    gapi.auth2.getAuthInstance().disconnect();
    console.log(obj);
    dbParam = JSON.stringify(obj);

    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        var test = this.responseText;
        test = test.replace(/\"/g, "");
        if(test == "success"){
          window.location.href = "../blog/index.php";
        }  
        document.getElementById("error").innerHTML = test;
          
      }

    };

    xmlhttp.open("GET", "login.php?x=" + dbParam, true);
    xmlhttp.send();

  }




//-------------------------facebook sign up---------------------------------

function FBsignup() {

  FB.login(function(response) {
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      fbsignup();
    }
  });

}


function FBsignin(){
    FB.login(function(response) {
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      fbsignin();
    }
  }); 
}
function fbsignin(){
  FB.api('/me','GET', {fields: 'name,id,email,picture.type(large)'}, function(response) {
    var obj, dbParam, xmlhttp;
    var picture = response.picture.data.url;
    var picture = encodeURIComponent(picture);
    obj = {
       "id" :  response.id,
       "name" : response.name,
       "email" : response.email,
       "picture" : picture
    };
    gapi.auth2.getAuthInstance().disconnect();
    console.log(obj);
    dbParam = JSON.stringify(obj);

    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var test = this.responseText;
        test = test.replace(/\"/g, "");
        if(test == "success"){
          window.location.href = "./index.php";
        }  
        document.getElementById("error").innerHTML = test;
          
      }

    };

    xmlhttp.open("GET", "login.php?x=" + dbParam, true);
    xmlhttp.send();
    });
}