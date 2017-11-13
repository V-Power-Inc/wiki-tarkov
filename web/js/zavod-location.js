/**
 * Created by DIR300NRU-ADMIN on 13.11.2017.
 */

/** Вызов карты и указание центра координат **/
const map = L.map('map', {
    center: [2145, 1516],
    zoom: 2,
    maxzoom: 4,
});

L.tileLayer('http://eft-locations.kfc-it.ru/img/zavod/{z}/{x}/{y}.png', {
}).addTo(map);






