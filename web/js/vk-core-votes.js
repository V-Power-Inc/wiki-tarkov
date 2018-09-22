/**
 * Created by DIR300NRU-ADMIN on 12.09.2018.
 */

/*** Скрипт обработки сообщений от сайта ***/

$(document).ready(function() {
    
    $('.mx-100.close-vote').click(function () {
        $('.vk-gifts-take').fadeOut();
        $('.loader-maps-background').fadeOut();
        $('body').css({'overflow' : 'auto'});
    });

    $('.loader-maps-background').click(function () {
        $('.vk-gifts-take').fadeOut();
        $('.loader-maps-background').fadeOut();
        $('body').css({'overflow' : 'auto'});
    });
    
    function FormOpened() {
        $('.loader-maps-background').fadeIn();
        $('.vk-gifts-take').fadeIn();
        $('body').css({'overflow' : 'hidden'});
    }

    setTimeout(FormOpened, 5000);
});