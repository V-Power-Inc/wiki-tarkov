/**
 * Created by comp on 03.11.2018.
 * File helps swap block with interest content on some other devices
 */

$(document).ready(function() {
    $(window).on("scroll resize", function() {

        // Определяем пользовательское стартовое состояние разрешения устройства
        var Cwidth = document.documentElement.clientWidth;
        var Cheight = document.documentElement.clientHeight;

        var loot = '/loot';
        var skills = '/skills';
        var addr = document.location.pathname;

        if(Cwidth > 1199 && Cheight >= 720) {
            if(addr.includes(loot)) {
                if ($(window).scrollTop() >= 1848) {
                    $('.fortunite-block').css({'position': 'fixed', 'top': '70px'});
                } else {
                    $('.fortunite-block').css({'position': 'unset', 'top': 'initial'});
                }
            } else if (addr.includes(skills)) {
                if ($(window).scrollTop() >= 1442) {
                    $('.fortunite-block').css({'position': 'fixed', 'top': '70px'});
                } else {
                    $('.fortunite-block').css({'position': 'unset', 'top': 'initial'});
                }
            }
        } else {
            $('.fortunite-block').css({'position': 'unset', 'top': 'initial'});
        }
    });
});