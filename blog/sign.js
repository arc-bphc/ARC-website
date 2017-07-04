    var googleUser = {};
    gapi.load('auth2', function(){
      // Retrieve the singleton for the GoogleAuth library and set up the client.
      auth2 = gapi.auth2.init({
        client_id: '774440701303-rv2gilg9fk78eh25uf6jhd9s9o0k5mio.apps.googleusercontent.com'
        // Request scopes in addition to 'profile' and 'email'
        //scope: 'additional_scope'
      });
      attachSignUp();
      attachSignIn();
    });


    function attachSignUp() {
    auth2.attachClickHandler(document.getElementById('customSignUpBtn'), {},
        function(googleUser) {
          SignUp(googleUser);
        }, function(error) {
          alert(JSON.stringify(error, undefined, 2));
        });
  }
      function attachSignIn() {
    auth2.attachClickHandler(document.getElementById('customSignInBtn'), {},
        function(googleUser) {
          SignIn(googleUser);
        }, function(error) {
          alert(JSON.stringify(error, undefined, 2));
        });
  }


  function SignUp(googleUser) {
    var profile = googleUser.getBasicProfile();
    // console.log(profile);

    var obj, dbParam, xmlhttp;
    obj = {
       "id" :  profile.getId(),
       "name" : profile.getName(),
       "email" : profile.getEmail(),
       "picture" : profile.getImageUrl()
    };
    // console.log(obj);
    gapi.auth2.getAuthInstance().disconnect();
    dbParam = JSON.stringify(obj);
    // console.log(dbParam);
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var test = this.responseText;
        test = test.replace(/\"/g, "");  
        document.getElementById("error").innerHTML = test;
          
      }

    };

    xmlhttp.open("GET", "gsignup.php?x=" + dbParam, true);
    xmlhttp.send();

  }

  function SignIn(googleUser) {
    var profile = googleUser.getBasicProfile();

    var obj, dbParam, xmlhttp;
    obj = {
       "id" :  profile.getId(),
       "name" : profile.getName(),
       "email" : profile.getEmail()
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
          window.location.href = "./display-posts.php";
        }  
        document.getElementById("error").innerHTML = test;
          
      }

    };

    xmlhttp.open("GET", "gsignin.php?x=" + dbParam, true);
    xmlhttp.send();

  }

    // $( document ).ready(function() {

    //     $('.alphabetsOnly').bind('keyup blur',function(){ 
    //         var node = $(this);
    //         node.val(node.val().replace(/[^a-z]/g,'') ); }
    //     );
    //     $('.numbersOnly').bind('keyup blur',function(){ 
    //         var node = $(this);
    //         node.val(node.val().replace(/[^0-9]/,'') ); }
    //     );


    //     $( "#submit-signup" ).click(function(){
    //         var userinput1 = $("#email1").val();
    //         var pattern1 = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

    //         if($("#firstName").val() == ""){
    //             alert("Enter first name");
    //             return false;
    //         }
    //         else if($("#lastName").val() == ""){
    //             alert("Enter last name");
    //             return false;
    //         }
    //         else if($("#password").val() == ""){
    //             alert("Enter valid password");
    //             return false;
    //         }
    //         else if($("#passwordB").val() != $("#repassword").val()){
    //             alert("Passwords not same");
    //             return false;
    //         }
    //         if(!pattern1.test(userinput1))
    //         {
    //             alert('not a valid e-mail address');
    //                 return false;
    //         }
    //     });

    //     $( "#submit-signin" ).click(function(){
    //         var userinput2 = $("#email2").val();
    //         var pattern2 = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;


    //         if($("#passwordA").val() == ""){
    //             alert("Enter valid password");
    //             return false;
    //         }

    //         if(!pattern2.test(userinput2))
    //         {
    //             alert('Not a valid e-mail address');
    //                 return false;
    //         }
    //     });
    // });


//-------------------------facebook sign up---------------------------------

function FBsignup() {

  FB.login(function(response) {
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      fbsignup();
    }
  });

}

function fbsignup() {
    FB.api('/me','GET', {fields: 'name,id,email,picture.type(large)'}, function(response) {
    var obj, dbParam, xmlhttp,picture;
    //console.log(response);
    var picture = response.picture.data.url;
    var picture = encodeURIComponent(picture);
    obj = {
       "id" :  response.id,
       "name" : response.name,
       "email" : response.email,
       "picture" : picture
    };
    gapi.auth2.getAuthInstance().disconnect();
    dbParam = JSON.stringify(obj);
    console.log(dbParam);
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var test = this.responseText;
        test = test.replace(/\"/g, "");  
        document.getElementById("error").innerHTML = test;

      }

    };

    xmlhttp.open("GET", "gsignup.php?x=" + dbParam, true);
    xmlhttp.send();
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
    obj = {
       "id" :  response.id,
       "name" : response.name,
       "email" : response.email
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
          window.location.href = "./display-posts.php";
        }  
        document.getElementById("error").innerHTML = test;
          
      }

    };

    xmlhttp.open("GET", "gsignin.php?x=" + dbParam, true);
    xmlhttp.send();
    });
}