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

        /*** Объявляем куку в переменную ***/
        var cookie = $.cookie("interbuttons");
        
        /*** Функция проверяющая существование кукиса ***/

        if (cookie == null || cookie !== null) {
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
        }
    });
});