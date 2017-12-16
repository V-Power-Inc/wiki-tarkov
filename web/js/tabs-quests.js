/**
 * Created by comp on 23.10.2017.
 */


$(document).ready(function() {

    /** Попап для увеличения картинок в квестах **/
    $('.image-quests').magnificPopup(
        {
        type:'image',
        showCloseBtn: true,
        });

    $('.parent-container').magnificPopup({
        delegate: 'a', // child items selector, by clicking on it popup will open
        type: 'image',
        gallery: {
            enabled: true
        },
        // other options
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