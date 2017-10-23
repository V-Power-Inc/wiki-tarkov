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
    
/** Убираем инфо подсказку в разделе с квестами при клике на любой вертикальный таб а также при наличии хэша **/

    $('.nav.nav-list.bs-docs-sidenav.affix li').click(function() {
       $('#info-alert-prapor').fadeOut();
    });

    if(window.location.hash !== '') {
        $('#info-alert-prapor').remove();
    }
});




