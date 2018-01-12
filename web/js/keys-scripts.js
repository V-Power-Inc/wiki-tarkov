/**
 * Created by comp on 06.01.2018.
 */

$(document).ready(function() {
    
    //todo Сделать возможность обращаться к универсальной функции вызывающий одинаковые JS события и обращающуюся к одним и тем же свойствам

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

    $('.parent-container').each(function () { // the containers for all your galleries
        $(this).magnificPopup({
            delegate: 'a', // the selector for gallery item
            type: 'image',
            gallery: {
                enabled: true
            }
        });
    });
    
});

