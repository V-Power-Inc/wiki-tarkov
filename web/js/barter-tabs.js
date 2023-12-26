/**
 * Created by comp on 28.08.2018.
 *
 * JS для бартеров торговцев
 */

$(document).ready(function() {

    /** Если в URL не было хэща - кликаем на первый таб **/
    if (window.location.hash === '') {
        $('.first-lvl').click();
    }
});