$(document).ready(function(){   
 
 // add event listener on the login button
 
 $("#login").click(function(){

    facebookLogin();

   
 });

 // add event listener on the logout button

 $("#logout").click(function(){

   $("#logout").hide();
   $("#login").show();
   $("#status").empty();
   facebookLogout();

 });

   $(document).on('click', '#procesarReview', function () {
                        
                    });

 function facebookLogin()
 {
   FB.getLoginStatus(function(response) {
       console.log(response);
       statusChangeCallback(response);
   });
 }

 function statusChangeCallback(response)
 {
     console.log(response);
     if(response.status === "connected")
     {
        $("#login").hide();
        $("#logout").show(); 
        
        fetchUserProfile();
        $("#formReview").show(); 
     }
     else{
         // Logging the user to Facebook by a Dialog Window
         facebookLoginByDialog();
     }
 }

 function fetchUserProfile()
 {
   console.log('Welcome!  Fetching your information.... ');
   FB.api('/me?fields=id,name,email,gender,birthday', function(response) {
     console.log(response);
     console.log('Successful login for: ' + response.name);
     $('#name').val(response.name);
     $('#email').val(response.email);
    
   });
 }

 function facebookLoginByDialog()
 {
   FB.login(function(response) {
      
       statusChangeCallback(response);
      
   }, {scope: 'public_profile,email'});
 }

 // logging out the user from Facebook

 function facebookLogout()
 {
   FB.logout(function(response) {
       statusChangeCallback(response);
   });
 }


});
