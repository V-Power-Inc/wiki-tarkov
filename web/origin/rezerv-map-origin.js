/**
 * Created by PC_Principal on 07.01.2023.
 *
 * @link https://www.obfuscator.io/ - Obfuscate JS
 */

/** Вызов карты и указание центра координат **/
const map = L.map('map', {
    center: [67, -5],
    maxzoom: 2,
    minzoom: 1,
    zoom: 1
});

/** Обращаемся к слоям зума интерактивной карты **/
L.tileLayer('/img/rezerv/{z}/{x}/{y}.png', {
    noWrap: true,
}).addTo(map);

/** Подключаем хэш в url для учета текущего зума и центра координат пользователя **/
var hash = new L.Hash(map);

/** Устанавливаем зум карты на 2 также указываем что минимальный зум 0 а максимальный 2 **/
map.setMaxZoom(2);
map.setMinZoom(1);


/** Получаем текщие координаты по местонахождению мышки **/
function onMouseMove(e) {
    $('#mapCoords').text((e.latlng.lat).toFixed(3) + ", " + (e.latlng.lng).toFixed(3));
}
map.on('mousemove', onMouseMove);