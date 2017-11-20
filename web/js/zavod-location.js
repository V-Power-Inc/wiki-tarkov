/**
 * Created by DIR300NRU-ADMIN on 13.11.2017.
 */

/** Вызов карты и указание центра координат **/
const map = L.map('map', {
    center: [67, -40],
    maxzoom: 4,
    minzoom: 2,
    zoom: 2
});

/** Обращаемся к слоям зума интерактивной карты **/
L.tileLayer('http://eft-locations.kfc-it.ru/img/zavod/{z}/{x}/{y}.png', {
    noWrap: true,
}).addTo(map);

/** Устанавливаем зум карты на 2 также указываем что минимальный зум 2 а максимальный 4 **/
map.setMaxZoom(4);
map.setMinZoom(2);
map.setZoom(2);



/** Ограничение на перетягивание карты, если в экране есть края карты **/
var southWest = L.latLng(85, -181),
    northEast = L.latLng(0, 74);
var bounds = L.latLngBounds(southWest, northEast);

map.setMaxBounds(bounds);
map.on('drag', function() {
    map.panInsideBounds(bounds, { animate: false });
});