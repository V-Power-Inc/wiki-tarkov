/**
 * Created by comp on 23.03.2018.
 */

$(document).ready(function() {

    /*** Объявляем проверочные токены для Ajax ***/
    var param = $('meta[name=csrf-param]').attr("content");
    var token = $('meta[name=csrf-token]').attr("content");

    /*** Узнаем ID кнопки с маркером по которой кликнули ***/
    $('.btn').click(function(){

        /*** Объявляем переменной ID кнопки, по которой кликнул пользователь ***/
        var activebutton = $(this).attr('id');
        
        var interbuttons = 'interbuttons';
        
        /*** Функция проверяющая существование кукиса ***/
        // возвращает cookie с именем name, если есть, если нет, то undefined
        function getCookie(interbuttons) {
            var matches = document.cookie.match(new RegExp(
                "(?:^|; )" + interbuttons.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
            ));
            return matches ? decodeURIComponent(matches[1]) : undefined;
        }

        if (getCookie(interbuttons) == undefined) {
            /*** Данные с параметром ID нажатой кнопки улетают на бэкэнд ***/
            $.ajax({
                url: '/site/clickremember',
                data: {param: param, token : token, name:'interbuttons', value : activebutton},
                async: false,
                type: "POST",
                success: function(data) {
                    console.log(data);
                }
            });
        } else if(getCookie(interbuttons) !== undefined) {
            /*** Данные с параметром ID записи из базы улетают на бэкэнд ***/
            $.ajax({
                url: '/site/clickremember',
                data: {param: param, token: token, name: 'interbuttons', value: interbuttons},
                async: false,
                type: "POST",
                success: function (data) {
                    console.log(data);
                }
            });

        }

    });
});