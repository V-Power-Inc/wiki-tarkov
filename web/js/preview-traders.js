/** Файл позволяет смотреть превью страницы торговца перед публикацией **/
$(document).ready(function() {

    /*** Собираем данные в скрытую форму и отправляем их в нужный экшон ***/
    $('#preview-print').click(function(){

        var title = $('#traders-title').val();
        var preview = $('#traders-file').attr("value");
        var content = $('#traders-fullcontent').val();
        var url = $('#traders-urltoquets').val();
        var buttonquests = $('#traders-button_quests').val();
        var buttondetail = $('#traders-button_detail').val();

        $('#text-title').val(title);
        $('#text-preview').val(preview);
        $('#text-url').val(url);
        $('#text-button').val(buttonquests);
        $('#text-button-detail').val(buttondetail);
        $('#text-fullcontent').val(content);

        var form = document.getElementById("prev-form");
        form.submit();
    });
});