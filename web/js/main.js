/**
 * Created by comp on 22.10.2017.
 */

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
});




