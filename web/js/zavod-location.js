/**
 * Created by DIR300NRU-ADMIN on 13.11.2017.
 */

/** Вызов карты и указание центра координат **/
const map = L.map('map', {
    center: [67, -70],
    maxzoom: 4,
    minzoom: 2,
    zoom: 2
});

/** Обращаемся к слоям зума интерактивной карты **/
L.tileLayer('https://eft-locations.kfc-it.ru/img/zavod/{z}/{x}/{y}.png', {
    noWrap: true,
}).addTo(map);

/** Устанавливаем зум карты на 2 также указываем что минимальный зум 2 а максимальный 4 **/
map.setMaxZoom(4);
map.setMinZoom(2);
map.setZoom(2);

/** Ограничение на перетягивание карты, если в экране есть края карты **/
var southWest = L.latLng(85, -181),
    northEast = L.latLng(-1, 74);
var bounds = L.latLngBounds(southWest, northEast);

map.setMaxBounds(bounds);
map.on('drag', function() {
    map.panInsideBounds(bounds, { animate: false });
});

/** Получаем текщие координаты по местонахождению мышки **/
function onMouseMove(e) {
   $('#mapCoords').text(Math.round(e.latlng.lat) + ", " + Math.round(e.latlng.lng));
}
map.on('mousemove', onMouseMove);

/** Ссылки на маркеры иконок **/
var ArmyIcon = L.icon({
    iconUrl: '/img/mapicons/voen-yaj.png',
    iconSize: [30, 30]
});
var ChkafIcon = L.icon({
    iconUrl: '/img/mapicons/chkaf.png',
    iconSize: [30, 30]
});
var DikieIcon = L.icon({
    iconUrl: '/img/mapicons/dikie.png',
    iconSize: [60, 60]
});
var ShortsIcon = L.icon({
    iconUrl: '/img/mapicons/kurtki.png',
    iconSize: [30, 30]
});
var SeifIcon = L.icon({
    iconUrl: '/img/mapicons/seif.png',
    iconSize: [30, 30]
});
var SumkiIcon = L.icon({
    iconUrl: '/img/mapicons/sumki.png',
    iconSize: [30, 30]
});

/** Координаты маркеров с военными ящиками **/

var voenloot = [[41,-93], [63, -109], [81, -115], [69.5, -118]];

var voenmarkers = voenloot.map(function(e){
    return L.marker(e, {icon: ArmyIcon}).addTo(map);
});