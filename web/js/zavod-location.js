/**
 * Created by DIR300NRU-ADMIN on 13.11.2017.
 */

/** ����� ����� � �������� ������ ��������� **/
const map = L.map('map', {
    center: [67, -40],
    maxzoom: 4,
    minzoom: 2,
    zoom: 2
});

/** ���������� � ����� ���� ������������� ����� **/
L.tileLayer('http://eft-locations.kfc-it.ru/img/zavod/{z}/{x}/{y}.png', {
    noWrap: true,
}).addTo(map);

/** ������������� ��� ����� �� 2 ����� ��������� ��� ����������� ��� 2 � ������������ 4 **/
map.setMaxZoom(4);
map.setMinZoom(2);
map.setZoom(2);



/** ����������� �� ������������� �����, ���� � ������ ���� ���� ����� **/
var southWest = L.latLng(85, -181),
    northEast = L.latLng(0, 74);
var bounds = L.latLngBounds(southWest, northEast);

map.setMaxBounds(bounds);
map.on('drag', function() {
    map.panInsideBounds(bounds, { animate: false });
});