/**
 * Created by comp on 28.08.2018.
 */

$(document).ready(function() {

    console.log(window.location.hash);

    /** Если в URL не было хэща - кликаем на первый таб **/
    if (window.location.hash === '') {
        $('.first-lvl').click();
    }

    /** События при изменении хэша - доработки под вопросом **/
    // $(function() {
    //     $('a[data-toggle="tab"]').on('shown.bs.tab', function () {
    //         window.location.hash = $(this).attr('href');
    //     });
    //
    //     if (window.location.hash) {
    //         $('' + window.location.hash + '').trigger('click');
    //     }
    //
    //     $(window).on('hashchange', function() {
    //         $('' + window.location.hash + '').trigger('click');
    //     });
    // });

});

