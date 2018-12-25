/**
 * Created by DIR300NRU-ADMIN on 25.12.2018.
 */

$(document).ready(function() {
    
    if (window.canRunAds === undefined) {
        CheckingUser();
    }

    function CheckingUser() {
        $('body').before('<div class="b-popup"><div class="b-popup-content"><div class="col-lg-12 text-center"><h2 class="main-site-heading" style="font-weight: bold;">Вы используете блокировщик рекламы</h2><p style="font-size: 16px; margin: 70px 0 0 0;">Для того чтобы продолжить использование сайта, отключите блокировщик рекламы на страницах нашего сайта. <br><br> <b>Сайт не может существовать без доходов с показа рекламы.</b> <br><br> Очень надеемся на ваше понимание - команда Tarkov-wiki.ru</p></div></div></div>');  
        $('body').css({"overflow":"hidden"});
    }


});
