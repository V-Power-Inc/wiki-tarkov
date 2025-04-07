/**
 * Created by PC_Principal on 07.04.2025.
 *
 * @link https://obfuscator.io/ - Obfuscate JS
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
L.tileLayer('/img/labyrinth/{z}/{x}/{y}.png', {
    noWrap: true,
}).addTo(map);

/** Подключаем хэш в url для учета текущего зума и центра координат пользователя **/
var hash = new L.Hash(map);

/** Указываем что минимальный зум 0 а максимальный 2 **/
map.setMaxZoom(4);
map.setMinZoom(0);