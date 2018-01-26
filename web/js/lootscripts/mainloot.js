/**
 * Created by comp on 25.01.2018.
 */

$(document).ready(function($){
    /** Инициализация скрипта вертикального меню **/
    $('#categories-menu').dcAccordion({
        eventType: 'click',
    });
    
    /** Изменяем по клику иконки минуса и плюса в вертикальном меню **/
    $("li.relative i.fa-plus").click(function() {
        $(this).toggleClass("fa-minus");
    });

    // $('body').on('click','.fa.categories-abs.fa-minus', function() {
    //     $(this).removeClass('fa-minus');
    //     $(this).addClass('fa-plus');
    // });
});









