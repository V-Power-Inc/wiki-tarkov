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
                $('.about-us').fadeOut();
            }
        });
    });

    /*** Оборачиваем фреймы youtube в специальные блоки для адаптивности ***/
    $('.news-shortitem iframe').each(function () {
        $(this).attr('allowfullscreen', 'true');
        $(this).wrap('<div class="video-block"></div>');
    });
    
    /*** Кнопка загрузки аватарки кланового сообщества ***/
    $('#upl-clan-logo').click(function() {
       $('#clans-file').click();
    });

    /*** Убираем уведомление о заявки регистрации клана на завтрашний день ***/
    function clsalerttommorow() {
        $('#alert-tommorow').fadeOut();
    }

    setTimeout(clsalerttommorow, 4000);
});




