/**
 * Created by comp on 11.01.2018.
 */

/** Убираем поля превьюшка и маркеры выходов если не выбрана группа маркеров "Маркеры выходов" и наоборот **/

$( document ).ready(function() {
    if($('#forest-marker_group option:selected').text() === "Маркеры выходов") {
        $('.form-group.field-forest-exits_group').fadeIn();
        $('.form-group.field-forest-file').fadeIn();
    }
});
$("#forest-marker_group").change(function() {
    if($('#forest-marker_group option:selected').text() === "Маркеры выходов") {
        $('.form-group.field-forest-exits_group').fadeIn();
        $('.form-group.field-forest-file').fadeIn();
    } else {
        $('.form-group.field-forest-exits_group').fadeOut();
        $('.form-group.field-forest-file').fadeOut();
    }
});