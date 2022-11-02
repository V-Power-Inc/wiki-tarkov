/**
 * Created by comp on 23.10.2017.
 *
 * Скрипт для корректной работы табов на страницах торговцев (Списки лута на разных уровнях репутации)
 */
$(document).ready(function() {

    /** Убираем инфо подсказку в разделе с квестами при клике на любой вертикальный таб а также при наличии хэша **/
    $('.nav.nav-list.bs-docs-sidenav.affix li').click(function() {
        $('#info-alert-prapor').fadeOut();
    });

    if(window.location.hash !== '') {
        $('#info-alert-prapor').remove();
    }

    /** Указываем оборачивать все изображения в popup окнах классом JS Magnific - отлавливаем ошибки на несуществующие классы **/
    var MagnificImg = $('.image-link');

    if (MagnificImg) {
        $(MagnificImg).each(function () {
            $(this).wrap('<a class="image-link" title="' + $(this).attr('alt') + '" href=' + $(this).attr('src') + '></a>');
        });
    }

    /** Попап для увеличения картинок в квестах **/
    $('.image-link').magnificPopup(
            {
                type: 'image',
                showCloseBtn: true,
                mainClass: 'image-link'
            });

    /** Оборачивание всех картинок в контейнере parent-conteiner gallery классом для попапа **/
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