/**
 * Created by comp on 25.01.2018.
 */

$(document).ready(function() {
    /** Логика выпадающего бокового меню в разделе лута **/
    $(".fa.fa-plus.categories-abs").click(function() {
        $(this).removeClass('fa-plus');
        $(this).addClass('fa-minus');

        $(this).next("li.level-2").css({"display" : "block"});
    });
    
    
    
    
});
