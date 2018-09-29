/** Файл позволяет смотреть превью страницы бартера перед публикацией **/

var param = $('meta[name=csrf-param]').attr("content");
var token = $('meta[name=csrf-token]').attr("content");

$(document).ready(function() {

    /*** Собираем данные в скрытую форму и отправляем их в нужный экшон ***/
    $('#preview-barters').click(function(){

        var title = $('#barters-title').val();
        var sitetitle = $('#barters-site_title').val();
        var trader = $('#barters-trader_group').val();
        var content = $('#barters-content').val();

        $('#trader-title').val(title);
        $('#site-title').val(sitetitle);
        $('#trader').val(trader);
        $('#trader-content').val(content);

        var form = document.getElementById("prev-form-barters");
        form.submit();
    });
});