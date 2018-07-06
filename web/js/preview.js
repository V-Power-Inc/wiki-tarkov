/**
 * Created by DIR300NRU-ADMIN on 06.07.2018.
 */
/** Файл позволяет смотреть превью материала перед публикацией **/
$(document).ready(function() {

    /*** Собираем данные в скрытую форму и отправляем их в нужный экшон ***/
    $('#preview-print').click(function(){
        
        var title = $('#items-title').val();
        var preview = $('#items-file').attr("value");
        var content = $('#items-content').val();

        $('#text-title').val(title);
        $('#text-preview').val(preview);
        $('#text-content').val(content);

        var form = document.getElementById("prev-form");
        form.submit();
    });
});