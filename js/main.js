$(document).ready(function () {
    $(document).on('click', '.buttonPay', function () {
        $('#formToSecond #i').val($(this).attr('data-i'));
        $('#formToSecond #b').val($(this).attr('data-b'));
        $('#formToSecond #d').val($(this).attr('data-c'));
        var c = $(this).parent().find('img.img-rounded').attr('src');
        
        $('#formToSecond #c').val(c);
        if ($(this).attr('data-c') == 'season') {
            var tit = $(this).parent().find('span.plpp_slider_Show_Title').text()+' '+$(this).parent().find('span.plpp_slider_Season_Title').text();
            $('#formToSecond #amt').val('1500');
            $('#formToSecond #amt_r').val('15.00');            
            $('#formToSecond #b').val(tit);
        } else if ($(this).attr('data-c') == 'episode')
        {
             var tit = $(this).parent().find('span.plpp_thumbs_Show_Title').text()+' - '+$(this).parent().find('span.plpp_thumbs_Episode_Title').text()+' - '+$(this).parent().find('span.plpp_thumbs_Episode_No').text();
            $('#formToSecond #amt').val('300');
            $('#formToSecond #amt_r').val('3.00');
            $('#formToSecond #b').val(tit);
        }
         else if ($(this).attr('data-c') == 'show')
        {
            var tit = $(this).parent().find('span.plpp_thumbs_Title').text()+' - '+$(this).parent().find('span.plpp_thumbs_Year').text();
            $('#formToSecond #amt').val('5000');
            $('#formToSecond #amt_r').val('50.00');
            $('#formToSecond #b').val(tit);
        }
        else {
            $('#formToSecond #amt').val('500');
            $('#formToSecond #amt_r').val('5.00');
        }

        $('#formToSecond').submit();
    });
    $(document).on('click', '#viewWhy', function () {
        var text = '<div><b class="titleviewWhy">¿Buscas siempre películas o series en Internet?🤔</b><br>';
        text += '<span>Olvídate de esas pelis mal grabadas😭, esas series no disponibles⛔, que vienen con más virus🤖 que minutos de película.</br> O simplemente no esta en internet y quieres verla.🗣</br> <b>Te ofrecemos ➕ de 5000 películas disponibles en calidad full HD</b> y actualizadas semanalmente con los últimos estrenos. <br>Qué necesitas? - Escoge la película que deseas ver, presiona en el Botón Pagar y continua con el proceso de pago, al finalizar el pedido y el pagoa se te enviará un email de confirmación.<br> o Realiza un pedido de tu película o serie (Click en Escribenos), Paga con Tarjeta de Crédito o Débito, Transfiere (BCP, Interbank) o YAPEA y en tan solo 30 min te brindamos un link de acceso 🔗para que puedas verla en cualquier dispositivo móvil (laptop, pc, celular, tablet) o tv smart TV📱💻🖥.</span>  Haz tu pedido ya!. Click para hacer tu pedido vía whatsapp ➡ <a href="http://bit.do/eS7dC" target="_blank">http://bit.do/eS7dC</a></div>';
        bootbox.alert({
            message: text,
            size: 'large'
        });
    });
    $(document).on('click', '#order', function () {
        var text = '<div><b class="titleviewWhy">¿Buscas una pelicula y no la tenemos disponible aún?🤔</b><br>';
        text += '<span>Si no tienes netflix, HBO, no encuentras tu peli /Serie en internet, o es de mala calidad, Escríbenos, nos dices que pelicula/serie quieres ver ( en tu Smart TV, tablet, laptop, cel) y en una hora podrás verla en calidad HD ya sea en tu Smart TV, pc , laptop. Solo dinos qué película quieres ver, a qué hora ya que el link durará unas 5 horas, pagas con tarjeta de Crédito o Débito,  yapeas (BCP) o transferencia (BCP o Interbank) y listo. Hay unos pequeños pasos que tienes que hacer para que lo veas en tu pc o laptop , smart tv , las películas son con audio original (ingles, francés, etc dependiendo de la película) y con subtítulos en español, todas las películas las tenemos en HD y full HD</div>';
        bootbox.alert({
            message: text,
            size: 'large'
        });
    });
});