/**
 * Created by comp on 23.10.2017.
 */


$(document).ready(function() {

    /** Указываем оборачивать все изображения в popup окнах классом JS Magnific - отлавливаем ошибки на несуществующие классы **/
    try {
        var MagnificImg = $('.image-link');
        var MagnificTitle = MagnificImg.attr("alt").length > 0;
    }

    catch (error) {
    }

    if (MagnificTitle) {
        $(MagnificImg).wrap('<a class="image-link" title="' + $(MagnificImg).attr('alt') + '" href=' + $(MagnificImg).attr('src') + '></a>');
        $(MagnificImg).unwrap();
    }

    if (MagnificImg) {
        $(MagnificImg).wrap('<a class="image-link" title="' + $(MagnificImg).attr('alt') + '" href=' + $(MagnificImg).attr('src') + '></a>');
    }

    /** Попап для увеличения картинок в квестах **/
    $('.image-link').each(function () {
        $(this).magnificPopup(
            {
                type: 'image',
                showCloseBtn: true,
                mainClass: 'image-link'
            });
    });
    $('.parent-container').each(function () { // the containers for all your galleries
        $(this).magnificPopup({
            delegate: 'a', // the selector for gallery item
            type: 'image',
            gallery: {
                enabled: true
            }
        });
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