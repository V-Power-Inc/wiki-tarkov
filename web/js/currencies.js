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
    }
});

/*** Функция конвертации долларов в рубли ****/
function dollarConventer(valNum) {

    /** Если прилетело валидное число */
    if(!isNaN(valNum)) {

        /** Считаем сколько рублей стоит заданная сумма долларов */
        document.getElementById('outputdollar').value=valNum*valuteData[0].value/100 + " руб.";

    } else { /** Если прилетело невалидное число */

        /** Сбрасываем значение количества Доллара */
        $('#dollar-refference').val(null);

        /** Сбрасываем значение инпута Доллара */
        $('#outputdollar').val(null);

        /** ALert на экран, что введено не целое число */
        alert('Введите целое число');
    }
}

/*** Функция конвертации евро в рубли ****/
function euroConventer(valNum) {

    /** Если прилетело валидное число */
    if(!isNaN(valNum)) {

        /** Считаем сколько рублей стоит заданная сумма ЕВРО */
        document.getElementById('outputeuro').value = valNum * valuteData[1].value / 100 + " руб.";

    } else { /** Если прилетело невалидное число */

        /** Сбрасываем значение количества ЕВРО */
        $('#euro-refference').val(null);

        /** Сбрасываем значение инпута ЕВРО */
        $('#outputeuro').val(null);

        /** ALert на экран, что введено не целое число */
        alert('Введите целое число');
    }
}

/*** Функция конвертации биткоинов в рубли ****/
function bitkoinConventer(valNum) {

    /** Если прилетело валидное число */
    if(!isNaN(valNum)) {

        /** Считаем сколько рублей стоит заданная сумма BTC */
        document.getElementById('outputbitkoin').value = valNum * valuteData[2].value / 100 + " руб.";

    } else { /** Если прилетело невалидное число */

        /** Сбрасываем значение количества BTC */
        $('#bitkoin-refference').val(null);

        /** Сбрасываем значение инпута BTC */
        $('#outputbitkoin').val(null);

        /** ALert на экран, что введено не целое число */
        alert('Введите целое число');
    }
}

/** Функция конвертирования рублей в другие виды валют */
function allValutesConventer(valNum) {

    /** Если прилетело валидное число */
    if(!isNaN(valNum)) {

        /** Считаем сколько сможем купить долларов на эту сумму */
        document.getElementById('dollar_res').value = Math.round(valNum / (valuteData[0].value / 100) * 10) / 10 + " $";

        /** Считаем сколько сможем купить ЕВРО на эту сумму */
        document.getElementById('euro_res').value = Math.round(valNum / (valuteData[1].value / 100) * 10) / 10 + " Евро";

        /** Считаем сколько сможем купить биткоинов на эту сумму */
        document.getElementById('btc_res').value = Math.trunc(valNum / (valuteData[2].value / 100)) + " BTC";

    } else { /** Если прилетело невалидное число */

        /** Сбрасываем значение инпута рублей */
        $('#roubles_input').val(null);

        /** Сбрасываем значение инпута доллара */
        $('#dollar_res').val(null);

        /** Сбрасываем значение инпута евро */
        $('#euro_res').val(null);

        /** Сбрасываем значение инпута BTC */
        $('#btc_res').val(null);

        /** ALert на экран, что введено не целое число */
        alert('Введите целое число');
    }
}