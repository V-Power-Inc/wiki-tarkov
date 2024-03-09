/**
 * @link https://javascriptobfuscator.dev/ - Obfuscate JS
 */

/** Константа с селекторами, для работы с DOM */
const Selectors = {

    /** Селектор body **/
    body: 'body',
};

/** Вызов карты и указание центра координат **/
const map = L.map('map', {
    center: [62, -58],
    maxzoom: 4,
    minzoom: 0,
    zoom: 1
});

/** Обращаемся к слоям зума интерактивной карты **/
L.tileLayer('/img/epicenter/{z}/{x}/{y}.png', {
    noWrap: true,
}).addTo(map);

/** Подключаем хэш в url для учета текущего зума и центра координат пользователя **/
var hash = new L.Hash(map);

/** Указываем что минимальный зум 0 а максимальный 2 **/
map.setMaxZoom(4);
map.setMinZoom(0);


/** Получаем текщие координаты по местонахождению мышки **/
function onMouseMove(e) {
    $('#mapCoords').text((e.latlng.lat).toFixed(3) + ", " + (e.latlng.lng).toFixed(3));
}
map.on('mousemove', onMouseMove);

/** Возвращаем пользователя к центру карты, если он кликнул на кнопку **/
$(Selectors.body).on('click','.mapcenter', function(){
    map.panTo(new L.LatLng(62, -58));
});