/**
 * Created by comp on 11.01.2018.
 */

/**
 * Убираем поля превьюшка и маркеры выходов если не выбрана группа маркеров "Маркеры выходов" и наоборот
 * Проверяем позицию вхождения слова по url, для создания проверок в админке в разделе маркеров
 */
if((window.location.href.indexOf('maps')) > -1) {
    $( document ).ready(function() {
        if($('#maps-marker_group option:selected').text() === "Маркеры выходов") {
            $('.form-group.field-maps-exits_group').fadeIn();
            $('.form-group.field-maps-file').fadeIn();
        } else if ($('#maps-marker_group option:selected').text() === "Выходы за Диких") {
            $('.form-group.field-maps-file').fadeIn();
            $('.form-group.field-maps-exit_anyway').fadeOut();
            $('.field-maps-exits_group').fadeOut();
            $('.form-group.field-maps-exit_anyway input').val('');
            $('#maps-exit_anyway').val('');
            $('#maps-exits_group').val('');
        } else if ($('#maps-marker_group option:selected').text() === "Интересные места" || $('#maps-marker_group option:selected').text() === "Военные ящики") {
            $('.form-group.field-maps-file').fadeIn();
            $('.form-group.field-maps-exit_anyway').fadeOut();
            $('.field-maps-exits_group').fadeOut();
            $('.form-group.field-maps-exit_anyway input').val('');
            $('#maps-exit_anyway').val('');
            $('#maps-exits_group').val('');
        } else {
            $('.form-group.field-maps-exit_anyway').fadeOut();
            $('.form-group.field-maps-exit_anyway input').val('');
            $('#maps-exit_anyway').val('');
            // $('#maps-exits_group').val('');
        }
    });

    $("#maps-marker_group").change(function() {
        if($('#maps-marker_group option:selected').text() === "Маркеры выходов") {
            $('.form-group.field-maps-exits_group').fadeIn();
            $('.form-group.field-maps-file').fadeIn();
            $('.form-group.field-maps-exit_anyway').fadeIn();
        } else if ($('#maps-marker_group option:selected').text() === "Выходы за Диких") {
            $('.form-group.field-maps-file').fadeIn();
            $('.form-group.field-maps-exit_anyway').fadeOut();
            $('.field-maps-exits_group').fadeOut();
            $('.form-group.field-maps-exit_anyway input').val('');
            $('#maps-exit_anyway').val('');
            $('#maps-exits_group').val('');
        } else if ($('#maps-marker_group option:selected').text() === "Интересные места" || $('#maps-marker_group option:selected').text() === "Военные ящики") {
            $('.form-group.field-maps-file').fadeIn();
            $('.form-group.field-maps-exit_anyway').fadeOut();
            $('.field-maps-exits_group').fadeOut();
            $('.form-group.field-maps-exit_anyway input').val('');
            $('#maps-exit_anyway').val('');
            $('#maps-exits_group').val('');
        } else if ($('#maps-marker_group option:selected').text() === "Спавны игроков ЧВК") {
            $('.form-group.field-maps-exits_group').fadeIn();
        } else {
            $('.form-group.field-maps-exits_group').fadeOut();
            $('.form-group.field-maps-file').fadeOut();
            $('.form-group.field-maps-exit_anyway').fadeOut();
            $('.form-group.field-maps-exit_anyway input').val('');
            $('#maps-exit_anyway').val('');
            $('#maps-exits_group').val('');
        }
    });
} else if ((window.location.href.indexOf('items')) > -1) { /** Проверяем позицию вхождения слова по url, для создания проверок в админке в разделе справочнику лута Items **/
    $( document ).ready(function() {
        if($('#items-trader_group option:selected').text() !== null && $('#items-trader_group option:selected').text() !== '') {
            $('.form-group.field-items-trader_group').fadeIn();
        } else if($('#items-trader_group option:selected').text() == null || $('#items-trader_group option:selected').text() == '') {
            $('.form-group.field-items-trader_group').fadeOut();
        }
        
        $("#items-quest_item").click(function() {
            $('.form-group.field-items-trader_group').toggle();
            $('#items-trader_group option:selected').val(null);
        });
    });
}