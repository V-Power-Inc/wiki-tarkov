/** Вызов карты и указание центра координат **/
const map = L.map('map', {
    center: [67, -5],
    maxzoom: 4,
    minzoom: 1,
    zoom: 1
});

/** Обращаемся к слоям зума интерактивной карты **/
L.tileLayer('/img/streets-of-tarkov/{z}/{x}/{y}.webp', {
    noWrap: true,
}).addTo(map);

/** Подключаем хэш в url для учета текущего зума и центра координат пользователя **/
var hash = new L.Hash(map);

/** Устанавливаем зум карты на 2 также указываем что минимальный зум 0 а максимальный 2 **/
map.setMaxZoom(4);
map.setMinZoom(1);


/** Получаем текщие координаты по местонахождению мышки **/
function onMouseMove(e) {
    $('#mapCoords').text((e.latlng.lat).toFixed(3) + ", " + (e.latlng.lng).toFixed(3));
}
map.on('mousemove', onMouseMove);


$(document).ready(function() {

    /** Делаем бэкграунд черным **/
    $('body').css({'background':'black'});

    /*** Объявляем проверочные токены для Ajax ***/
    var param = $('meta[name=csrf-param]').attr("content");
    var token = $('meta[name=csrf-token]').attr("content");

    /** Отключаем на минимальном зуме кнопку минуса **/
    $('a.leaflet-control-zoom-out').addClass('leaflet-disabled');

    /** Возвращаем пользователя к центру карты, если он кликнул на кнопку **/
    $('body').on('click','.mapcenter', function(){
        map.panTo(new L.LatLng(53, -8));
    });
});
