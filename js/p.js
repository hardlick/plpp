                Culqi.settings({
                    title: 'Baul de Peliculas & Series',
                    currency: 'PEN',
                    description: descrp,
                    amount: amount
                });
                $(document).ready(function () {
                    $(document).on('click', '#procesarPedido', function () {
                        Culqi.open();
                    });
                    $(document).on('click', '#help', function () {
                       bootbox.alert({
                        message: "<p>1. Realizar el Pago</p>\n\
<p>2. Se te enviará un email automaticamente con la información de acceso</p>\n\
<p>3. Disfruta de tu Pedido!</p>\n\
<p>4. Cualquier duda, no dudes en contactarnos via Facebook</p>",
                        callback: function () {
                            
                        }
                    })
                    });
                });
                function culqi() {

                    if (Culqi.token) {
                        var dialog;
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
                                    result = JSON.parse(response);
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

                                    bootbox.alert('<b>'+response.outcome.user_message + ' </b> Codigo Autorizacion: ' + response.reference_code+' <br>Revisar tu correo electronico', function () {
                                        window.location.replace("https://bauldepeliculas.info/");
                                        return false;
                                    });
                                }
                                if (result.object === 'error') {
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
                                    bootbox.alert('Hubo un problema con la transaccion: ' + result.user_message);
                                }

                            },
                            error: function (response) {
                                bootbox.alert('Hubo un problema con la transaccion: ' + response);
                            }
                        });

                    } else {
                        $.ajax({
                            type: "POST",
                            data: {
                                event: false,
                                item: item,
                                amount: amount,
                                amount_r: amount_r,
                                email: $("input[name='cardEmail']").val(),
                                descrp: descrp,
                                us: us,
                                user_message: Culqi.error.user_message,
                                type: Culqi.card_error,
                                codigo_error: '0000',
                                merchant_message: Culqi.error.merchant_message
                            },
                            dataType: 'json',
                            url: '/postProcess.php',
                            success: function (response) {
                                return true;
                            }
                        });

                        bootbox.alert(Culqi.error.user_message);
                    }
                }