/**
 * Created by comp on 25.01.2018.
 */

$(document).ready(function($){
    /** Инициализация скрипта вертикального меню **/
    $('#categories-menu').dcAccordion({
        eventType: 'click',
    });
    
    /** Изменяем по клику иконки минуса и плюса в вертикальном меню **/
    $(".fa.fa-plus.categories-abs").click(function() {
        $(this).removeClass('fa-plus');
        $(this).addClass('fa-minus');
    });

    // $('body').on('click','.fa.categories-abs.fa-minus', function() {
    //     $(this).removeClass('fa-minus');
    //     $(this).addClass('fa-plus');
    // });
});









