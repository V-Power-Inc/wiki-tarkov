/**
 * Created by comp on 11.01.2018.
 */

/** Убираем поля превьюшка и маркеры выходов если не выбрана группа маркеров "Маркеры выходов" и наоборот **/

$( document ).ready(function() {
    if($('#forest-marker_group option:selected').text() === "Маркеры выходов") {
        $('.form-group.field-forest-exits_group').fadeIn();
        $('.form-group.field-forest-file').fadeIn();
    } else if($('#forest-marker_group option:selected').text() !== "Маркеры выходов") {
        $('.form-group.field-forest-exit_anyway').fadeOut();
        $('.form-group.field-forest-exit_anyway input').val('');
        $('#forest-exit_anyway').val('');
        $('#forest-exits_group').val('');
    }
});
$("#forest-marker_group").change(function() {
    if($('#forest-marker_group option:selected').text() === "Маркеры выходов") {
        $('.form-group.field-forest-exits_group').fadeIn();
        $('.form-group.field-forest-file').fadeIn();
        $('.form-group.field-forest-exit_anyway').fadeIn();
    } else {
        $('.form-group.field-forest-exits_group').fadeOut();
        $('.form-group.field-forest-file').fadeOut();
        $('.form-group.field-forest-exit_anyway').fadeOut();
        $('.form-group.field-forest-exit_anyway input').val('');
        $('#forest-exit_anyway').val('');
        $('#forest-exits_group').val('');
    }
});