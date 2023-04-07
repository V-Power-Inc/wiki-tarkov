/**
 * Created by comp on 25.01.2018.
 */

$(document).ready(function($){
    /** Инициализация скрипта вертикального меню **/
    $('#categories-menu').dcAccordion({
        eventType: 'click',
    });

    /*** Скрипт раскрытия аккордеона меню при проверке на активную категорию в Url адресе ***/
    $(".relative.active.as-parent-li").find('div.dcjq-icon').trigger('click');

    /** На детальных страницах лута - делаем скроллбар для таблиц, если они не помещаются в экране */
    $('table').closest('div').addClass('fix-tables')
});