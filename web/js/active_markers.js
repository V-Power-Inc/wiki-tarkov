/**
 * Created by DIR300NRU-ADMIN on 23.03.2018.
 */
/** В этом файле находятся обработчики GET параметров на интерактивных картах локаций **/
/** для определения активности кнопок с маркерами **/

/*** Объявляем проверочные токены для Ajax ***/
var param = $('meta[name=csrf-param]').attr("content");
var token = $('meta[name=csrf-token]').attr("content");

$(document).ready(function() {
    /** Идет объявление переменных, которые будут переданы в url GET параметры при активации маркеров **/
    var dikiespawns = 'dikiespawns=1';
    var chvkspawns = 'chvkspawns=1';
    var dikieexits = 'dikieexits=1';
    var chvkexits = 'chvkexits=1';
    var weapons = 'weapons=1';
    var doors = 'doors=1';
    var quests = 'quests=1';
    var interesting = 'interesting=1';

    /** Обработка клика по спавнам с маркерами Диких **/
    $('.dikie-b').click(function(){
        $.get(location.href, { name: "John", time: "2pm" } );
    });










});