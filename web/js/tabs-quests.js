/**
 * Created by comp on 23.10.2017.
 */


$(document).ready(function() {

    /** Попап для увеличения картинок в квестах **/
    $('.image-link').magnificPopup(
        {
        type:'image',
        showCloseBtn: true,
        });

    /** Убираем инфо подсказку в разделе с квестами при клике на любой вертикальный таб а также при наличии хэша **/
    if (window.location.hash !== '') {
        $('#info-alert-prapor').remove();
    } else {
        $('#info-alert-prapor').css({"display": "block"});
    }

    $('.nav.nav-list.bs-docs-sidenav.affix.fixed-nav-top-145 li').click(function () {
        $('#info-alert-prapor').fadeOut();
    });

    $('.nav.nav-list.bs-docs-sidenav li').click(function () {
        $('#info-alert-prapor').fadeOut();
    });
        /** Делаем фиксированное меню при отскролливании страницы, либо если вертиклаьный скролл изначально не был в самом начале - проверяется размер окна браузера **/
    
        if (document.body.clientWidth >= '991')  {
            if (window.pageYOffset !== 0) {
                $('.nav.nav-list.bs-docs-sidenav').addClass("affix");
                $('.nav.nav-list.bs-docs-sidenav.affix').addClass("fixed-nav-top-145");
            } else {
                $('.nav.nav-list.bs-docs-sidenav.affix.fixed-nav-top-145').removeClass("fixed-nav-top-145");
                $('.nav.nav-list.bs-docs-sidenav.affix').removeClass("affix");
            }
    
        $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('.nav.nav-list.bs-docs-sidenav').addClass("affix");
                $('.nav.nav-list.bs-docs-sidenav.affix').addClass("fixed-nav-top-145");
            } else {
                $('.nav.nav-list.bs-docs-sidenav.affix.fixed-nav-top-145').removeClass("fixed-nav-top-145");
                $('.nav.nav-list.bs-docs-sidenav.affix').removeClass("affix");
            }
        });
    }


});

/** Добавляем и проверям хэш урла, для корректной работы табов на квестах торговцев **/

$(function() {
    $('a[data-toggle="tab"]').on('shown.bs.tab', function () {
        window.location.hash = $(this).attr('href');
    });

    if (window.location.hash) {
        $('a[href="' + window.location.hash + '"]').trigger('click');
    }

    $(window).on('hashchange', function() {
        $('a[href="' + window.location.hash + '"]').trigger('click');
    });
});