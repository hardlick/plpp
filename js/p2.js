$.extend($.validator.messages, {
    required: "Este campo es obligatorio.",
    remote: "Por favor, llene este campo.",
    email: "Por favor, escriba un correo electrónico válido.",
    url: "Por favor, escriba una URL válida.",
    date: "Por favor, escriba una fecha válida.",
    dateISO: "Por favor, escriba una fecha (ISO) válida.",
    number: "Por favor, escriba un número válido.",
    digits: "Por favor, escriba sólo dígitos.",
    creditcard: "Por favor, escriba un número de tarjeta válido.",
    equalTo: "Por favor, escriba el mismo valor de nuevo.",
    extension: "Por favor, escriba un valor con una extensión permitida.",
    maxlength: $.validator.format("Por favor, no escriba más de {0} caracteres."),
    minlength: $.validator.format("Por favor, no escriba menos de {0} caracteres."),
    rangelength: $.validator.format("Por favor, escriba un valor entre {0} y {1} caracteres."),
    range: $.validator.format("Por favor, escriba un valor entre {0} y {1}."),
    max: $.validator.format("Por favor, escriba un valor menor o igual a {0}."),
    min: $.validator.format("Por favor, escriba un valor mayor o igual a {0}."),
    nifES: "Por favor, escriba un NIF válido.",
    nieES: "Por favor, escriba un NIE válido.",
    cifES: "Por favor, escriba un CIF válido."
});
Culqi.settings({
    title: 'Baul de Peliculas & Series',
    currency: 'PEN',
    description: descrp,
    amount: amount
});
$(document).ready(function () {

    $("form#processPaymentTwo").validate({
        rules: {
            cardNumber: {
                required: true,
                creditcard: true
            },
            email: {
                required: true,
                email: true
            },
            exp_month: {
                required: true,
                minlength: 2,
                maxlength: 2
            },
            exp_year: {
                required: true,
                minlength: 2,
                maxlength: 2
            },
            cvv: {
                required: true,
                minlength: 3,
                maxlength: 3
            }

        },
        highlight: function (element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            var dataString = $('form#processReview').serialize();
           Culqi.createToken();
        }
    });

});
function culqi() {
    
    if (Culqi && Culqi instanceof Array && !Culqi.length) {
        if (Culqi.token) { // ¡Objeto Token creado exitosamente!
            var token = Culqi.token.id;
            var email = Culqi.token.email;
            $.ajax({
                type: "POST",
                data: {
                    token: token,
                    amount: amount,
                    amount_r: amount_r,
                    descrp: descrp,
                    email: email,
                    us: us
                },
                dataType: 'json',
                url: '/paymentProcess.php',
                beforeSend: function () {
                    dialog = bootbox.dialog({
                        centerVertical: true,
                        message: '<p class="text-center mb-0"><i class="fa fa-spin fa-cog"></i>Por favor, espere un momento...<img src="/images/Spinner-1s-73px.gif" title="Procesando..."/></p>',
                        closeButton: false
                    });
                },
                complete: function (event, r) {
                    dialog.modal('hide');
                },
                success: function (response) {
                    var result = "";

                    if (response.constructor == String) {
                        result = response;
                        bootbox.alert({
                            message: 'COD00 - Contactacte con nosotros y muestranos esta imagen, Hubo un problema con la transacción: ' + result,
                            size: 'small'
                        });
                        return false;
                    }
                    if (response.constructor == Object) {
                        result = JSON.parse(JSON.stringify(response));
                    }
                    if (result.object === 'charge') {

                        $.ajax({
                            type: "POST",
                            data: {
                                event: true,
                                item: item,
                                amount: amount,
                                amount_r: amount_r,
                                email: response.email,
                                descrp: descrp,
                                us: us,
                                code_reference: response.reference_code,
                                code_auth: response.authorization_code
                            },
                            dataType: 'json',
                            url: '/postProcess.php',
                            success: function (response) {
                                return true;
                            }
                        });
                        bootbox.alert({
                            message: '<b>' + response.outcome.user_message + ' </b> Codigo Autorizacion: ' + response.reference_code + ' <br>Revisar tu correo electronico',
                            size: 'small',
                            callback: function () {
                                window.location.replace("https://bauldepeliculas.info/");
                                return false;
                            }
                        });

                    } else if (result.object === 'error') {
                        $.ajax({
                            type: "POST",
                            data: {
                                event: false,
                                item: item,
                                amount: amount,
                                amount_r: amount_r,
                                email: email,
                                descrp: descrp,
                                us: us,
                                user_message: result.user_message,
                                type: result.type,
                                codigo_error: '0001',
                                merchant_message: result.merchant_message
                            },
                            dataType: 'json',
                            url: '/postProcess.php',
                            success: function (response) {
                                return true;
                            }
                        });
                        bootbox.alert({
                            message: 'COD01 - Contactacte con nosotros y muestranos esta imagen, Hubo un problema con la transacción: ' + result.user_message,
                            size: 'small'
                        });
                    } else {
                        bootbox.alert({
                            message: 'COD02 - Contactacte con nosotros y muestranos esta imagen,  Hubo un problema con la transacción: ' + response,
                            size: 'small'
                        });
                    }

                },
                error: function (response) {
                    bootbox.alert({
                        message: 'COD03 - Contactacte con nosotros y muestranos esta imagen, Hubo un problema con la transacción: ' + response,
                        size: 'small'
                    });
                }
            });
        } else {
            alert(Culqi.error.user_message);
        }
    } else {
        bootbox.alert({
            message: 'COD00 - Contactacte con nosotros y muestranos esta imagen, Hubo un problema con la transacción: ',
            size: 'small'
        });
    }
}