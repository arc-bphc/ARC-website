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
    
