/**
 * Created by comp on 22.10.2017.
 */

var param = $('meta[name=csrf-param]').attr("content");
var token = $('meta[name=csrf-token]').attr("content");

/** Скорлл кнопка до верхней части сайта **/
$(document).ready(function() {
    $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
            $('.scup').fadeIn();
        } else {
            $('.scup').fadeOut();
        }
    });
    $('.scup').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 900);
        return false;
    });
    
/*** Оборачиваем все таблицы с классом loot-tables специальным дивом со скроллом ***/
    var tables = $('.loot-tables');
    $(tables).wrap('<div class="fix-tables"></div>');

/*** Обрачиваем Wiki таблицы специальным дивом со скроллом ***/
    var wikia = $('table.wikitable');
    $(wikia).wrap('<div class="fix-tables"></div>');

/*** Обработчик нажатия на кнопку закрытия уведомлений ***/
    $('.alert-close-icon').click(function() {
        $('.about-us').fadeOut();

        $.ajax({
            url: '/site/clsalert',
            data: {param: param, token : token},
            success: function($retrn) {
                console.log($retrn);
                $('.about-us').fadeOut();
            }
        });

    });

});




