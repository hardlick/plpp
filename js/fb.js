$(document).ready(function () {
  $('.kv-ltr-theme-fas-star').rating({
        hoverOnClear: false,
        theme: 'krajee-fas',
        containerClass: 'is-star',
        'language' : 'es'
    });
    
    $('.kv-rtl-theme-fas-alt').rating({
        hoverOnClear: false,
        theme: 'krajee-fas',       
          'language' : 'es',
          'readonly': true
    });
    
        $('#procesarReview').click(function (e)
    {
        e.preventDefault();
        
        var dataString = $(this).serialize();
        $.ajax({
            type: "POST",
            url: '/review.php',
            data: dataString,
            dataType: 'json',
            success: function (r) {
                if (r.code ==400) {
                        
                } else {
                    msgBox(r.data, r.code);
                }
            }
        });
    });

    
    $("#login").click(function () {
        facebookLogin();
    });

    // add event listener on the logout button

    $("#logout").click(function () {

        $("#logout").hide();
        $("#login").show();
        $("#status").empty();
        facebookLogout();

    });

    $(document).on('click', '#procesarReview', function () {

    });
    function onload(){
        
    }
    function facebookLogin()
    {
        FB.getLoginStatus(function (response) {
            console.log(response);
            statusChangeCallback(response);
        });
    }

    function statusChangeCallback(response)
    {
        console.log(response);
        if (response.status === "connected")
        {
            $("#login").hide();
            $("#logout").show();

            fetchUserProfile();
            $("#formReview").show();
        } else {
            // Logging the user to Facebook by a Dialog Window
            facebookLoginByDialog();
        }
    }

    function fetchUserProfile()
    {
        console.log('Welcome!  Fetching your information.... ');
        FB.api('/me?fields=id,name,email,gender,birthday', function (response) {
            console.log(response);
            console.log('Successful login for: ' + response.name);
            $('#name').val(response.name);
            $('#email').val(response.email);

        });
    }

    function facebookLoginByDialog()
    {
        FB.login(function (response) {

            statusChangeCallback(response);

        }, {scope: 'public_profile,email'});
    }

    // logging out the user from Facebook

    function facebookLogout()
    {
        FB.logout(function (response) {
            statusChangeCallback(response);
        });
    }


});
