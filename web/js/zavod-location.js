/**
 * Created by DIR300NRU-ADMIN on 13.11.2017.
 */

/** ����� ����� � �������� ������ ��������� **/
const map = L.map('map', {
    center: [67, -40],
    zoom: 3,
    maxzoom: 4,
    minzoom: 2,
});

/** ���������� � ����� ���� ������������� ����� **/
L.tileLayer('http://eft-locations.kfc-it.ru/img/zavod/{z}/{x}/{y}.png', {
    noWrap: true,
}).addTo(map);

/** ������������� ��� ����� �� 2 ����� ��������� ��� ����������� ��� 2 � ������������ 4 **/
map.setZoom(3);
map.setMaxZoom(4);
map.setMinZoom(2);


/** ����������� �� ������������� �����, ���� � ������ ���� ���� ����� **/
