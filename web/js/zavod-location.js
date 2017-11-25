/**
 * Created by DIR300NRU-ADMIN on 13.11.2017.
 */

$(function () {
    var param = $('meta[name=csrf-param]').attr("content");
    var token = $('meta[name=csrf-token]').attr("content");
});

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
    iconSize: [30, 30],
});
var PolkiIcon = L.icon({
    iconUrl: '/img/mapicons/chkaf.png',
    iconSize: [30, 30]
});
var DikieIcon = L.icon({
    iconUrl: '/img/mapicons/dikie.png',
    iconSize: [30, 30]
});
var KeysIcon = L.icon({
    iconUrl: '/img/mapicons/kurtki.png',
    iconSize: [30, 30]
});
var ExitsIcon = L.icon({
    iconUrl: '/img/mapicons/kurtki.png',
    iconSize: [30, 30]
});


$(document).ready(function() {
/** По прогрузке документа получаем данные по ajax со статическим контентом маркеров **/
    $.ajax({
        url: '/site/static',
        dataType: 'json',
        success: function(result) {
            staticData = result;
            console.log(result);
        }
    });
    
/** Отключаем на минимальном зуме кнопку минуса **/
    $('a.leaflet-control-zoom-out').addClass('leaflet-disabled');
    
/** Объявляем группы маркеров всех возможных слоев **/
    var voenloot = L.layerGroup();
    var dikiy = L.layerGroup();
    var polki = L.layerGroup();
    var exits = L.layerGroup();
    var keys = L.layerGroup();

/** Обработка клика по кнопке выбора маркеров военного ящика **/
    $('body').on('click','.voenka-b', function(){
        
        var popupContent = 'fhfhfhefef';
        $('#polkiimarker').hide();
        $('#dikiymarker').hide();
        $('#exitsmarker').hide();
        $('#keysmarker').hide();
        $('#voenniymarker').fadeIn();
        voenloot.addTo(map);
        // Данные ниже, будут прилетать по ajax
        L.marker([41,-93], {icon: ArmyIcon}).addTo(voenloot);
        L.marker([63, -109], {icon: ArmyIcon}).addTo(voenloot);
        L.marker([81, -115], {icon: ArmyIcon}).bindPopup(popupContent).openPopup().addTo(voenloot);
        L.marker([69.5, -118], {icon: ArmyIcon}).addTo(voenloot);
        L.marker([51, -88], {icon: ArmyIcon}).addTo(voenloot);
        $(".voenka-b").before('<button class="btn btn-success voenka-b active" id="active-bounds-v">Военные ящики</button>');
        $('#voenniymarker').html(staticData[1].content);
        $(this).remove();
    });

    $('body').on('click','#active-bounds-v', function(){
        map.removeLayer(voenloot);
        $('#active-bounds-v').before('<button class="btn btn-success voenka-b">Военные ящики</button>');
        $('#active-bounds-v').remove();
        $('#voenniymarker').hide();
        $('#polkiimarker').hide();
        $('#dikiymarker').hide();
        $('#exitsmarker').hide();
        $('#keysmarker').hide();
    });

    /** Обработка клика по кнопке выбора маркеров диких **/
    $('body').on('click','.dikie-b', function(){

        var popupContent = 'fhfhfhefef';
        $('#polkiimarker').hide();
        $('#voenniymarker').hide();
        $('#exitsmarker').hide();
        $('#keysmarker').hide();
        $('#dikiymarker').fadeIn();
        dikiy.addTo(map);
        // Данные ниже, будут прилетать по ajax
        L.marker([41,-93], {icon: DikieIcon}).addTo(dikiy);
        L.marker([63, -109], {icon: DikieIcon}).addTo(dikiy);
        L.marker([81, -115], {icon: DikieIcon}).bindPopup(popupContent).openPopup().addTo(dikiy);
        L.marker([69.5, -118], {icon: DikieIcon}).addTo(dikiy);
        L.marker([51, -88], {icon: DikieIcon}).addTo(dikiy);
        $(".dikie-b").before('<button class="btn btn-danger dikie-b active" id="active-dikie-v">Спавны диких</button>');
        $('#dikiymarker').html(staticData[0].content);
        $(this).remove();
    });

    $('body').on('click','#active-dikie-v', function(){
        map.removeLayer(dikiy);
        $('#active-dikie-v').before('<button class="btn btn-danger dikie-b">Спавны диких</button>');
        $('#active-dikie-v').remove();
        $('#voenniymarker').hide();
        $('#polkiimarker').hide();
        $('#dikiymarker').hide();
        $('#exitsmarker').hide();
        $('#keysmarker').hide();
    });

    /** Обработка клика по кнопке выбора маркеров офисных полок **/
    $('body').on('click','.polki-b', function(){

        var popupContent = 'fhfhfhefef';
        $('#polkiimarker').hide();
        $('#voenniymarker').hide();
        $('#exitsmarker').hide();
        $('#keysmarker').hide();
        $('#dikiymarker').hide();
        $('#polkiimarker').fadeIn();
        polki.addTo(map);
        // Данные ниже, будут прилетать по ajax
        L.marker([41,-93], {icon: PolkiIcon}).addTo(polki);
        L.marker([63, -109], {icon: PolkiIcon}).addTo(polki);
        L.marker([81, -115], {icon: PolkiIcon}).bindPopup(popupContent).openPopup().addTo(polki);
        L.marker([69.5, -118], {icon: PolkiIcon}).addTo(polki);
        L.marker([51, -88], {icon: PolkiIcon}).addTo(polki);
        $(".polki-b").before('<button class="btn btn-primary polki-b active" id="active-polki-v">Офисные ящики</button>');
        $('#polkiimarker').html(staticData[2].content);
        $(this).remove();
    });

    $('body').on('click','#active-polki-v', function(){
        map.removeLayer(polki);
        $('#active-polki-v').before('<button class="btn btn-primary polki-b">Офисные ящики</button>');
        $('#active-polki-v').remove();
        $('#voenniymarker').hide();
        $('#polkiimarker').hide();
        $('#dikiymarker').hide();
        $('#exitsmarker').hide();
        $('#keysmarker').hide();
    });

    /** Обработка клика по кнопке выбора маркеров выходов с карты **/
    $('body').on('click','.exits-b', function(){

        var popupContent = 'fhfhfhefef';
        $('#polkiimarker').hide();
        $('#voenniymarker').hide();
        $('#keysmarker').hide();
        $('#dikiymarker').hide();
        $('#polkiimarker').hide();
        $('#exitsmarker').fadeIn();
        exits.addTo(map);
        // Данные ниже, будут прилетать по ajax
        L.marker([41,-93], {icon: ExitsIcon}).addTo(exits);
        L.marker([63, -109], {icon: ExitsIcon}).addTo(exits);
        L.marker([81, -115], {icon: ExitsIcon}).bindPopup(popupContent).openPopup().addTo(exits);
        $(".exits-b").before('<button class="btn btn-default exits-b active" id="active-exits-v">Выходы с карты</button>');
        $('#exitsmarker').html(staticData[3].content);
        $(this).remove();
    });

    $('body').on('click','#active-exits-v', function(){
        map.removeLayer(exits);
        $('#active-exits-v').before('<button class="btn btn-default exits-b">Выходы с карты</button>');
        $('#active-exits-v').remove();
        $('#voenniymarker').hide();
        $('#polkiimarker').hide();
        $('#dikiymarker').hide();
        $('#exitsmarker').hide();
        $('#keysmarker').hide();
    });

    /** Обработка клика по кнопке выбора маркеров дверей открываемых ключами **/
    $('body').on('click','.keys-b', function(){

        var popupContent = 'fhfhfhefef';
        $('#polkiimarker').hide();
        $('#voenniymarker').hide();
        $('#dikiymarker').hide();
        $('#polkiimarker').hide();
        $('#exitsmarker').hide();
        $('#keysmarker').fadeIn();
        keys.addTo(map);
        // Данные ниже, будут прилетать по ajax
        L.marker([41,-93], {icon: KeysIcon}).addTo(keys);
        L.marker([63, -109], {icon: KeysIcon}).addTo(keys);
        L.marker([81, -115], {icon: KeysIcon}).bindPopup(popupContent).openPopup().addTo(keys);
        $(".keys-b").before('<button class="btn btn-yellow keys-b active" id="active-keys-v">Двери открываемые ключами</button>');
        $('#keysmarker').html(staticData[4].content);
        $(this).remove();
    });

    $('body').on('click','#active-keys-v', function(){
        map.removeLayer(keys);
        $('#active-keys-v').before('<button class="btn btn-yellow w-100 keys-b">Двери открываемые ключами</button>');
        $('#active-keys-v').remove();
        $('#voenniymarker').hide();
        $('#polkiimarker').hide();
        $('#dikiymarker').hide();
        $('#exitsmarker').hide();
        $('#keysmarker').hide();
    });
});








