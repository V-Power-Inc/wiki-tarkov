/**
 * @link https://www.obfuscator.io/ - Obfuscate JS
 */

/*** После релиза нормальной карты этот файл необходимо перезалить по аналогии с другими картами ***/

/** Вызов карты и указание центра координат **/
const map = L.map('map', {
    center: [75.845, -68.906],
    maxzoom: 4,
    minzoom: 1,
    zoom: 1,
});

/** Подключаем хэш в url для учета текущего зума и центра координат пользователя **/
var hash = new L.Hash(map);

/** Обращаемся к слоям зума интерактивной карты **/
L.tileLayer('/img/laboratory/{z}/{x}/{y}.png', {
    noWrap: true,
}).addTo(map);

/** Устанавливаем зум карты на 2 также указываем что минимальный зум 2 а максимальный 4 **/
map.setMaxZoom(4);
map.setMinZoom(1);

/** Получаем текщие координаты по местонахождению мышки **/
function onMouseMove(e) {
    $('#mapCoords').text((e.latlng.lat).toFixed(3) + ", " + (e.latlng.lng).toFixed(3));
}
map.on('mousemove', onMouseMove);