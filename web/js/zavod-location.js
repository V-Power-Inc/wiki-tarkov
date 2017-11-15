/**
 * Created by DIR300NRU-ADMIN on 13.11.2017.
 */

/** ����� ����� � �������� ������ ��������� **/
const map = L.map('map', {
    center: [67, -40],
    zoom: 2,
    maxzoom: 4,
    minzoom: 2,
});

/** ���������� � ����� ���� ������������� ����� **/
L.tileLayer('http://eft-locations.kfc-it.ru/img/zavod/{z}/{x}/{y}.png', {
    noWrap: true,
}).addTo(map);

/** ������������� ��� ����� �� 2 ����� ��������� ��� ����������� ��� 2 � ������������ 4 **/
map.setZoom(2);
map.setMaxZoom(4);
map.setMinZoom(2);


/** ����������� �� ������������� �����, ���� � ������ ���� ���� ����� **/
var southWest = L.latLng(-89.98155760646617, -180),
    northEast = L.latLng(89.99346179538875, 80);
var bounds = L.latLngBounds(southWest, northEast);

map.setMaxBounds(bounds);
map.on('drag', function() {
    map.panInsideBounds(bounds, { animate: false });
});