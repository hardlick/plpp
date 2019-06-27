$(document).ready(function () {
    $('.kv-ltr-theme-fas-star').rating({
        hoverOnClear: false,
        theme: 'krajee-fas',
        containerClass: 'is-star',
        'language': 'es'
    });



    $("form#processReview").validate({
        rules: {

            name: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                email: true
            },
            message: "required"
        },
        messages: {

            name: {
                required: "Ingresa tu nombre",
                minlength: "Tu nombre por lo menos debe tener 02 caracteres"
            },
            email: "Ingresa un email valido",
            message: "Ingresa tu experiencia"
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            // Add the `invalid-feedback` class to the error element
            error.addClass("invalid-feedback");

            if (element.prop("type") === "checkbox") {
                error.insertAfter(element.next("label"));
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("is-valid").removeClass("is-invalid");
        },
        submitHandler: function () {
            var dataString = $('form#processReview').serialize();
            $.ajax({
                type: "POST",
                url: '/review.php',
                data: dataString,
                dataType: 'json',
                success: function (r) {
                    if (r.code == 200) {
                        $('#profileid').val('');
                        $('#name').val('');
                        $('#email').val('');

                        $("#formReview").hide();
                        $("#containerForm").show();
                        $('#containerForm').html('<h3>Muchas gracias por compartir tu experiencia!</h3>');
                        onload();
                    } else {

                    }
                }
            });
        }
    });

    $("#login").click(function () {
        facebookLogin();
    });

    // add event listener on the logout button

    $("#logout").click(function () {

        $("#logout").hide();
        $("#login").show();

        facebookLogout();

    });
    onload();
    function onload() {
        
        $.ajax({
            type: "POST",
            url: '/listAllreview.php',
            data: {},
            dataType: 'json',
            success: function (r) {
                var html = '';
                $('.card-body').html('');                
                $('#average').html('');
                var image = '';
                if (r.data.length > 0) {
                    $.each(r.data, function () {
                        if (this.profileid == '' || this.profileid == null) {
                            image = '/images/def_face.jpg';
                        } else {
                            image = '//graph.facebook.com/v3.3/' + this.profileid + '/picture?width=250&height=250';
                        }
                        html = `<div class="row">
                    <div class="col-md-2">
                                <img src="` + image + `" class="img img-rounded img-fluid">
                        
                        <p class="text-secondary text-center">` + this.fecha + `</p>
                    </div>
                    <div class="col-md-10">
                        <p>
                        <h4 class="float-left card-title">` + this.nombre + `</h4>                            
                        </p>
                        <div style="float: right">                            
                            <input id="input-3-ltr-star-md" name="input-3-ltr-star-md" class="ratingClients rating-loading" value="` + this.puntuacion + `" dir="ltr" data-size="md">
                        </div>
                        <div class="clearfix"></div>
                        <p class="card-text">` + this.comentario + `</p>
                                
                    </div>
                               
                </div> <hr>`;
                        $('.card-body').append(html);
                    });
                    
                    var avg ='<h3 style="float:left;">Como nos califican:&nbsp;&nbsp;&nbsp;</h3><input id="input-3-ltr-star-md" name="input-3-ltr-star-md" class="average rating-loading" value="'+r.avg[0].promedio+'" dir="ltr" data-size="md"><br>';
                    $('#average').show();
                    $('#average').html(avg);                   
                    
                     $('.average').rating({
                    hoverOnClear: false,
                    theme: 'krajee-fas',
                    'language': 'es',
                    'readonly': true
                });
                    
                } else {
                    
                }


                $('.ratingClients').rating({
                    hoverOnClear: false,
                    theme: 'krajee-fas',
                    'language': 'es',
                    'readonly': true
                });
            }
        });
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
        if (response.status === "connected")
        {
            $("#login").hide();
            $("#logout").show();

            fetchUserProfile();
            $("#formReview").show();
            $("#containerForm").hide();
            $('#average').show();
        } else {
            facebookLoginByDialog();
        }
    }

    function fetchUserProfile()
    {

        FB.api('/me?fields=id,name,email,gender,birthday', function (response) {

            $('#profileid').val(response.id);
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
