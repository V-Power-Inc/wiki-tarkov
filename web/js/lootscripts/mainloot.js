/**
 * Created by comp on 25.01.2018.
 */

$(document).ready(function($){
    /** Инициализация скрипта вертикального меню **/
    $('#categories-menu').dcAccordion({
        eventType: 'click',
    });

// todo: Нужно сделать чтобы JS понимал где он находится и раскрывал пункт меню при нахождении в URL активной категории
    /*** Раскрытия аккордеона меню при проверке на активную категорию в Url адресе ***/
    if (document.location.href.indexOf('json') == -1) {
        // не содержит
    } else {
        // содержит
    }


});









