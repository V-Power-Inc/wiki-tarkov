/**
 * Created by DIR300NRU-ADMIN on 12.09.2018.
 */

$(document).ready(function() {
    
    $('.mx-100.close-vote').click(function () {
        $('.vk-useridentity-vote').fadeOut();
        $('.loader-maps-background').fadeOut();
        $('body').css({'overflow' : 'auto'});
    });

    $('.loader-maps-background').click(function () {
        $('.vk-useridentity-vote').fadeOut();
        $('.loader-maps-background').fadeOut();
        $('body').css({'overflow' : 'auto'});
    });
    
    function FormOpened() {
        $('.loader-maps-background').fadeIn();
        $('.vk-useridentity-vote').fadeIn();
        $('body').css({'overflow' : 'hidden'});
    }

    setTimeout(FormOpened, 5000);
});