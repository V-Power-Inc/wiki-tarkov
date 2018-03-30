/**
 * Created by comp on 30.03.2018.
 */
/** Функция для работы спойлеров в любом разделе **/
$(document).ready(function() {
    $ (".opener").click(function() {
        $(this).children('em').remove();

        if ($(this).parent().children('div.slide').css('display') == 'none')  {

            $(this).parent().children('div.slide').animate({height: 'show'}, 500);
            $(this).children('span').remove('*').attr("id","1");
            $(this).append('<em>Свернуть</em>');
            $(this).children('em').css('display','block');
        }
        else
        {
            $( ".opener" ).attr("display","block");
            $(this).parent().children('div.slide').animate({height: 'hide'}, 500);
            $(this).append('<span>Развернуть</span>');
            $(this).children('em').remove();
        };
    });
});
