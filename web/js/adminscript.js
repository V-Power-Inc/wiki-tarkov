/**
 * Created by comp on 11.01.2018.
 */

/** Убираем поля превьюшка и маркеры выходов если не выбрана группа маркеров "Маркеры выходов" и наоборот **/


/** Проверяем позицию вхождения слова по url, для создания проверок в админке в разделе маркеров Леса **/
if((window.location.href.indexOf('forest')) > -1) {
    $( document ).ready(function() {
        if($('#forest-marker_group option:selected').text() === "Маркеры выходов") {
            $('.form-group.field-forest-exits_group').fadeIn();
            $('.form-group.field-forest-file').fadeIn();
        } else if ($('#forest-marker_group option:selected').text() === "Выходы за Диких") {
            $('.form-group.field-forest-file').fadeIn();
            $('.form-group.field-forest-exit_anyway').fadeOut();
            $('.field-forest-exits_group').fadeOut();
            $('.form-group.field-forest-exit_anyway input').val('');
            $('#forest-exit_anyway').val('');
            $('#forest-exits_group').val('');
        } else {
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
        } else if ($('#forest-marker_group option:selected').text() === "Выходы за Диких") {
            $('.form-group.field-forest-file').fadeIn();
            $('.form-group.field-forest-exit_anyway').fadeOut();
            $('.field-forest-exits_group').fadeOut();
            $('.form-group.field-forest-exit_anyway input').val('');
            $('#forest-exit_anyway').val('');
            $('#forest-exits_group').val('');
        } else {
            $('.form-group.field-forest-exits_group').fadeOut();
            $('.form-group.field-forest-file').fadeOut();
            $('.form-group.field-forest-exit_anyway').fadeOut();
            $('.form-group.field-forest-exit_anyway input').val('');
            $('#forest-exit_anyway').val('');
            $('#forest-exits_group').val('');
        }
    });
}

/** Проверяем позицию вхождения слова по url, для создания проверок в админке в разделе маркеров Завода **/
else if ((window.location.href.indexOf('zavod')) > -1) {
    $(document).ready(function () {
        if($('#zavod-marker_group option:selected').text() === "Маркеры выходов" || $('#zavod-marker_group option:selected').text() === "Выходы за Диких") {
            $('.form-group.field-zavod-file').fadeIn();
        } else {
            $('.form-group.field-zavod-file').fadeOut();
        }
    });

    $("#zavod-marker_group").change(function() {
        if($('#zavod-marker_group option:selected').text() === "Маркеры выходов" || $('#zavod-marker_group option:selected').text() === "Выходы за Диких") {
            $('.form-group.field-zavod-file').fadeIn();
        } else {
            $('.form-group.field-zavod-file').fadeOut();
        }
    });
}

/** Проверяем позицию вхождения слова по url, для создания проверок в админке в разделе маркеров Таможни **/
else if ((window.location.href.indexOf('tamojnya')) > -1) {
    $( document ).ready(function() {
        if($('#tamojnya-marker_group option:selected').text() === "Маркеры выходов") {
            $('.form-group.field-tamojnya-exits_group').fadeIn();
            $('.form-group.field-tamojnya-file').fadeIn();
        } else if ($('#tamojnya-marker_group option:selected').text() === "Выходы за Диких") {
            $('.form-group.field-tamojnya-file').fadeIn();
            $('.form-group.field-tamojnya-exit_anyway').fadeOut();
            $('.field-tamojnya-exits_group').fadeOut();
            $('.form-group.field-tamojnya-exit_anyway input').val('');
            $('#tamojnya-exit_anyway').val('');
            $('#tamojnya-exits_group').val('');
        } else {
            $('.form-group.field-tamojnya-exit_anyway').fadeOut();
            $('.form-group.field-tamojnya-exit_anyway input').val('');
            $('#tamojnya-exit_anyway').val('');
            $('#tamojnya-exits_group').val('');
        }
    });

    $("#tamojnya-marker_group").change(function() {
        if($('#tamojnya-marker_group option:selected').text() === "Маркеры выходов") {
            $('.form-group.field-tamojnya-exits_group').fadeIn();
            $('.form-group.field-tamojnya-file').fadeIn();
            $('.form-group.field-tamojnya-exit_anyway').fadeIn();
        } else if ($('#forest-marker_group option:selected').text() === "Выходы за Диких") {
            $('.form-group.field-tamojnya-file').fadeIn();
            $('.form-group.field-tamojnya-exit_anyway').fadeOut();
            $('.field-tamojnya-exits_group').fadeOut();
            $('.form-group.field-tamojnya-exit_anyway input').val('');
            $('#tamojnya-exit_anyway').val('');
            $('#tamojnya-exits_group').val('');
        } else {
            $('.form-group.field-tamojnya-exits_group').fadeOut();
            $('.form-group.field-tamojnya-file').fadeOut();
            $('.form-group.field-tamojnya-exit_anyway').fadeOut();
            $('.form-group.field-tamojnya-exit_anyway input').val('');
            $('#tamojnya-exit_anyway').val('');
            $('#tamojnya-exits_group').val('');
        }
    });
}