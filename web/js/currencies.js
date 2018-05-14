/**
 * Created by DIR300NRU-ADMIN on 14.05.2018.
 */
/*** Файл участвующий в рассчете курса валют в Escape from Tarkov ***/
    
    /*** Объявляем проверочные токены для Ajax ***/
    var param = $('meta[name=csrf-param]').attr("content");
    var token = $('meta[name=csrf-token]').attr("content");
   
    /*** Получаем данные об активных валютах через Ajax ***/
    $.ajax({
        url: '/site/jsonvalute',
        dataType: 'json',
        data: {param: param, token : token},
        success: function(valutes) {
            valuteData = valutes;
            console.log(valuteData);
        }
    });
    
    /*** Функция конвертации долларов в рубли ****/
    function dollarConventer(valNum) {
        document.getElementById('outputdollar').value=valNum*valuteData[0].value/100 + " руб.";
    }

    /*** Функция конвертации евро в рубли ****/
    function euroConventer(valNum) {
        document.getElementById('outputeuro').value=valNum*valuteData[1].value/100 + " руб.";
    }

    /*** Функция конвертации биткоинов в рубли ****/
    function bitkoinConventer(valNum) {
        document.getElementById('outputbitkoin').value=valNum*valuteData[2].value/100 + " руб.";
    }
    
    

