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
    
    /*** Задаем переменные по значениям рублей как целочисленные ***/
    var dollar = Math.floor(valuteData[0]/100);
    var euro = Math.floor(valuteData[1]/100);
    var bitkoin = Math.floor(valuteData[2]/100);
    
    /*** Функция конвертации долларов в рубли ****/
    function dollarConventer(valNum) {
        document.getElementById('outputdollar').value=valNum*valuteData[0].value/100 + " руб.";
    }
    
    
    
    

