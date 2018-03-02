/**
 * Created by comp on 02.03.2018.
 */

/** Вызываем заглушку для страницы в самом начале **/
$('body').before('<div class="loader-maps-background"><img class="preloader_map" src="/img/load.gif"><p class="alert alert-info text-preloader">Идет загрузка...</p></div>');

$(function () {
    var param = $('meta[name=csrf-param]').attr("content");
    var token = $('meta[name=csrf-token]').attr("content");
});

/** Вызов карты и указание центра координат **/
const map = L.map('map', {
    center: [61.373, -10.469],
    maxzoom: 6,
    minzoom: 3,
    zoom: 3
});

/** Обращаемся к слоям зума интерактивной карты **/
L.tileLayer('/img/bereg/{z}/{x}/{y}.png', {
    noWrap: true,
}).addTo(map);

/** Устанавливаем зум карты на 2 также указываем что минимальный зум 2 а максимальный 4 **/
map.setMaxZoom(6);
map.setMinZoom(3);
map.setZoom(3);

/** Ограничение на перетягивание карты, если в экране есть края карты **/
var southWest = L.latLng(84.879, -177.715),
    northEast = L.latLng(1.758, 155.039);
var bounds = L.latLngBounds(southWest, northEast);

map.setMaxBounds(bounds);
map.on('drag', function() {
    map.panInsideBounds(bounds, { animate: false });
});

/** Получаем текщие координаты по местонахождению мышки **/
function onMouseMove(e) {
    $('#mapCoords').text((e.latlng.lat).toFixed(3) + ", " + (e.latlng.lng).toFixed(3));
}
map.on('mousemove', onMouseMove);

/** Ссылки на маркеры иконок **/
var ArmyIcon = L.icon({
    iconUrl: '/img/mapicons/voen-yaj.png',
    iconSize: [30, 30],
});
/** Раньше это был маркер полок, теперь это иконка маркеров квестов **/
var PolkiIcon = L.icon({
    iconUrl: '/img/mapicons/quest_icon2.png',
    iconSize: [20, 24.39]
});
var DikieIcon = L.icon({
    iconUrl: '/img/mapicons/dikie.png',
    iconSize: [30, 30]
});
var KeysIcon = L.icon({
    iconUrl: '/img/mapicons/keys.png',
    iconSize: [30, 30]
});
// var ExitsIcon = L.icon({
//     iconUrl: '/img/mapicons/exits.png',
//     iconSize: [30, 30]
// });
var ChvkIcon = L.icon({
    iconUrl: '/img/mapicons/chvk.png',
    iconSize: [30, 30]
});
var GarajIcon = L.icon({
    iconUrl: '/img/mapicons/tamojnyaspawns/tamozhnya.png',
    iconSize: [250, 250]
});
var BoilersIcon = L.icon({
    iconUrl: '/img/mapicons/tamojnyaspawns/boileri.png',
    iconSize: [250, 250]
});

var PlacesInt = L.icon({
    iconUrl: '/img/mapicons/whatis.png',
    iconSize: [28, 27]
});

$(document).ready(function() {
    /** Устанавлиеваем новый центр карты **/
    map.panTo(new L.LatLng(61.373, -10.469));

    /** Делаем бэкграунд черным **/
    $('body').css({'background':'black'});

    /** По прогрузке документа получаем данные по ajax со статическим контентом маркеров **/
    $.ajax({
        url: '/site/static',
        dataType: 'json',
        async: false,
        success: function(result) {
            staticData = result;
            $('.loader-maps-background').fadeOut();
        }
    });

    /** По прогрузке документа получаем данные по ajax с координатами и описаниями маркеров всех слоев **/
    $.ajax({
        url: '/site/beregmarkers',
        dataType: 'json',
        async: false,
        context: document.body,
        success: function(markers) {
            markersData = markers;
            $('.loader-maps-background').fadeOut();
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
    var chvk = L.layerGroup();
    var garajispawn = L.layerGroup();
    var boilersspawn = L.layerGroup();
    var dikieexits =  L.layerGroup();
    var interstplaces = L.layerGroup();

    /** Добавляем маркеры для статичных зон спавна **/
    L.marker([79.113, -138.621], {icon: GarajIcon}).setZIndexOffset(999).addTo(garajispawn);
    L.marker([79.963,-42.913], {icon: BoilersIcon}).setZIndexOffset(999).addTo(boilersspawn);

    /***************** Принимаем координаты всех маркеров с помощью циклов со всеми проверками *****************/
    // Принимаем координаты по ajax
    $.each(markersData, function(i) {
        if (markersData[i].exit_anyway == "1" && markersData[i].exits_group !== '') {
            var ExitsIcon = L.icon({
                iconSize: [170, 30],
                iconUrl: markersData[i].customicon,
            });
            L.marker([markersData[i].coords_x, markersData[i].coords_y], {icon: ExitsIcon}).bindPopup(markersData[i].content).openPopup().setZIndexOffset(999).addTo(boilersspawn);
            L.marker([markersData[i].coords_x, markersData[i].coords_y], {icon: ExitsIcon}).bindPopup(markersData[i].content).openPopup().setZIndexOffset(999).addTo(garajispawn);
        } else if (markersData[i].exits_group == "Спавн на бойлерах") {
            var ExitsIcon = L.icon({
                iconSize: [170, 30],
                iconUrl: markersData[i].customicon,
            });
            L.marker([markersData[i].coords_x, markersData[i].coords_y], {icon: ExitsIcon}).bindPopup(markersData[i].content).openPopup().setZIndexOffset(999).addTo(boilersspawn);
        } else if (markersData[i].exits_group == "Спавн на гаражах") {
            var ExitsIcon = L.icon({
                iconSize: [170, 30],
                iconUrl: markersData[i].customicon,
            });
            L.marker([markersData[i].coords_x, markersData[i].coords_y], {icon: ExitsIcon}).bindPopup(markersData[i].content).openPopup().setZIndexOffset(999).addTo(garajispawn);
        } else if (markersData[i].marker_group == "Военные ящики") {
            L.marker([markersData[i].coords_x, markersData[i].coords_y], {icon: ArmyIcon}).bindPopup(markersData[i].content).openPopup().addTo(voenloot);
        } else if (markersData[i].marker_group == "Спавны диких" && markersData[i].content !== "") {
            L.marker([markersData[i].coords_x, markersData[i].coords_y], {icon: DikieIcon}).bindPopup(markersData[i].content).openPopup().addTo(dikiy);
        } else if (markersData[i].marker_group == "Спавны диких" && markersData[i].content == "") {
            L.marker([markersData[i].coords_x, markersData[i].coords_y], {icon: DikieIcon}).addTo(dikiy);
        } else if (markersData[i].marker_group == "Квестовые точки") {
            L.marker([markersData[i].coords_x, markersData[i].coords_y], {icon: PolkiIcon}).bindPopup(markersData[i].content).openPopup().addTo(polki);
        } else if (markersData[i].marker_group == "Спавны игроков ЧВК") {
            L.marker([markersData[i].coords_x, markersData[i].coords_y], {icon: ChvkIcon}).bindPopup(markersData[i].content).openPopup().addTo(chvk);
        } else if (markersData[i].marker_group == "Маркеры ключей") {
            L.marker([markersData[i].coords_x, markersData[i].coords_y], {icon: KeysIcon}).bindPopup(markersData[i].content).openPopup().addTo(keys);
        } else if (markersData[i].marker_group == "Выходы за Диких") {
            var DikiyExitIcon = L.icon({
                iconSize: [170, 30],
                iconUrl: markersData[i].customicon,
            });
            L.marker([markersData[i].coords_x, markersData[i].coords_y], {icon: DikiyExitIcon}).bindPopup(markersData[i].content).openPopup().setZIndexOffset(990).addTo(dikieexits);
        } else if (markersData[i].marker_group == "Интересные места") {
            L.marker([markersData[i].coords_x, markersData[i].coords_y], {icon: PlacesInt}).bindPopup(markersData[i].content).openPopup().addTo(interstplaces);
        }
    });

    /** Обработка клика по кнопке выбора маркеров выходов диких с локации **/
    $('body').on('click','.bandits-b', function(){
        $('.static-description').hide();
        $('#necessaryplaces').hide();
        $('#voenniymarker').hide();
        $('#polkiimarker').hide();
        $('#dikiymarker').hide();
        $('#exitsmarker').hide();
        $('#keysmarker').hide();
        $('#playermarker').hide();
        $('#dikiyexitmarker').fadeIn();
        dikieexits.addTo(map);
        $(".bandits-b").before('<button class="btn btn-success bandits-b active" id="active-bandits-v">Выходы с карты за Диких</button>');
        $('#dikiyexitmarker').html(staticData[6].content);
        $(this).remove();
    });

    $('body').on('click','#active-bandits-v', function(){
        map.removeLayer(dikieexits);
        $('#active-bandits-v').before('<button class="btn btn-bandits bandits-b">Выходы с карты за Диких</button>');
        $('#active-bandits-v').remove();
        $('#dikiyexitmarker').hide();
        $('#necessaryplaces').hide();
        $('#voenniymarker').hide();
        $('#polkiimarker').hide();
        $('#dikiymarker').hide();
        $('#exitsmarker').hide();
        $('#keysmarker').hide();
        $('#playermarker').hide();
    });

    /** Обработка клика по кнопке выбора маркеров интересных мест **/
    $('body').on('click','.places-b', function(){
        $('.static-description').hide();
        $('#polkiimarker').hide();
        $('#dikiymarker').hide();
        $('#voenniymarker').hide();
        $('#exitsmarker').hide();
        $('#keysmarker').hide();
        $('#playermarker').hide();
        $('#dikiyexitmarker').hide();
        $('#necessaryplaces').fadeIn();
        interstplaces.addTo(map);
        $(".places-b").before('<button class="btn btn-places w-100 places-b active" id="active-places-v">Интересные места</button>');
        $('#necessaryplaces').html(staticData[7].content);
        $(this).remove();
    });

    $('body').on('click','#active-places-v', function(){
        map.removeLayer(interstplaces);
        $('#active-places-v').before('<button class="btn btn-places w-100 places-b">Интересные места</button>');
        $('#active-places-v').remove();
        $('#dikiyexitmarker').hide();
        $('#necessaryplaces').hide();
        $('#voenniymarker').hide();
        $('#polkiimarker').hide();
        $('#dikiymarker').hide();
        $('#exitsmarker').hide();
        $('#keysmarker').hide();
        $('#playermarker').hide();
    });

    /** Обработка клика по кнопке выбора маркеров военного ящика **/
    $('body').on('click','.voenka-b', function(){
        $('.static-description').hide();
        $('#polkiimarker').hide();
        $('#dikiymarker').hide();
        $('#exitsmarker').hide();
        $('#keysmarker').hide();
        $('#playermarker').hide();
        $('#dikiyexitmarker').hide();
        $('#necessaryplaces').hide();
        $('#voenniymarker').fadeIn();
        voenloot.addTo(map);
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
        $('#playermarker').hide();
        $('#dikiyexitmarker').hide();
        $('#necessaryplaces').hide();
    });

    /** Обработка клика по кнопке выбора маркеров диких **/
    $('body').on('click','.dikie-b', function(){
        $('.static-description').hide();
        $('#polkiimarker').hide();
        $('#voenniymarker').hide();
        $('#exitsmarker').hide();
        $('#keysmarker').hide();
        $('#playermarker').hide();
        $('#dikiyexitmarker').hide();
        $('#necessaryplaces').hide();
        $('#dikiymarker').fadeIn();
        dikiy.addTo(map);
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
        $('#playermarker').hide();
        $('#dikiyexitmarker').hide();
        $('#necessaryplaces').hide();
    });

    /** Обработка клика по кнопке выбора маркеров квестовых точек **/
    $('body').on('click','.polki-b', function(){
        $('.static-description').hide();
        $('#polkiimarker').hide();
        $('#voenniymarker').hide();
        $('#exitsmarker').hide();
        $('#keysmarker').hide();
        $('#dikiymarker').hide();
        $('#playermarker').hide();
        $('#dikiyexitmarker').hide();
        $('#necessaryplaces').hide();
        $('#polkiimarker').fadeIn();
        polki.addTo(map);
        $(".polki-b").before('<button class="btn btn-primary polki-b active" id="active-polki-v">Квестовые точки</button>');
        $('#polkiimarker').html(staticData[2].content);
        $(this).remove();
    });

    $('body').on('click','#active-polki-v', function(){
        map.removeLayer(polki);
        $('#active-polki-v').before('<button class="btn btn-primary polki-b">Квестовые точки</button>');
        $('#active-polki-v').remove();
        $('#voenniymarker').hide();
        $('#polkiimarker').hide();
        $('#dikiymarker').hide();
        $('#exitsmarker').hide();
        $('#keysmarker').hide();
        $('#playermarker').hide();
        $('#dikiyexitmarker').hide();
        $('#necessaryplaces').hide();
    });

    /** Обработка клика по кнопке выбора маркеров выходов с карты **/
    $('body').on('click','.exits-b', function(){
        $('.static-description').hide();
        $('#polkiimarker').hide();
        $('#voenniymarker').hide();
        $('#keysmarker').hide();
        $('#dikiymarker').hide();
        $('#polkiimarker').hide();
        $('#playermarker').hide();
        $('#dikiyexitmarker').hide();
        $('#necessaryplaces').hide();
        // Указываем появиться кнопкам с переключателями
        $('#exitsmarker').fadeIn();
        // Добавляем переключатель выхода
        $('.random-exits').fadeIn();
        //  exits.addTo(map);
        try {
            map.removeLayer(garajispawn);
            map.removeLayer(boilersspawn);
        } catch(err) {}

        garajispawn.addTo(map);
        $(".exits-b").before('<button class="btn btn-default exits-b active" id="active-exits-v">Выходы с карты за ЧВК</button>');
        $('#exitsmarker').html(staticData[3].content);
        $(this).remove();
    });

    /******************************************* Обработка клика по кнопке со спавнами ЧВК на доме *********************/
    $('.house-spawn').click(function() {
        try {
            map.removeLayer(garajispawn);
            map.removeLayer(boilersspawn);
        } catch(err) {}
        garajispawn.addTo(map);
    });

    /********************************* Обработка клика по кнопке со спавнами ЧВК на старой станции *********************/
    $('.station-spawn').click(function() {
        try {
            map.removeLayer(garajispawn);
            map.removeLayer(boilersspawn);
        } catch(err) {}

        boilersspawn.addTo(map);
    });


    $('body').on('click','#active-exits-v', function(){
        $('.station-spawn').addClass('active');
        $('.house-spawn').removeClass('active');

        try {
            map.removeLayer(garajispawn);
            map.removeLayer(boilersspawn);
        } catch(err) {}
        map.removeLayer(exits);
        $('#active-exits-v').before('<button class="btn btn-default exits-b">Выходы с карты за ЧВК</button>');
        $('#active-exits-v').remove();
        $('#voenniymarker').hide();
        $('#polkiimarker').hide();
        $('#dikiymarker').hide();
        $('#exitsmarker').hide();
        $('#keysmarker').hide();
        $('#playermarker').hide();
        $('#dikiyexitmarker').hide();
        $('#necessaryplaces').hide();
        // Убираемы переключатель выхода
        $('.random-exits').hide();
    });

    /** Обработка клика по кнопке выбора маркеров дверей открываемых ключами **/
    $('body').on('click','.keys-b', function(){
        $('.static-description').hide();
        $('#polkiimarker').hide();
        $('#voenniymarker').hide();
        $('#dikiymarker').hide();
        $('#polkiimarker').hide();
        $('#exitsmarker').hide();
        $('#playermarker').hide();
        $('#dikiyexitmarker').hide();
        $('#necessaryplaces').hide();
        $('#keysmarker').fadeIn();
        keys.addTo(map);
        $(".keys-b").before('<button class="btn btn-yellow keys-b active" id="active-keys-v">Отпираемые двери</button>');
        $('#keysmarker').html(staticData[4].content);
        $(this).remove();
    });

    $('body').on('click','#active-keys-v', function(){
        map.removeLayer(keys);
        $('#active-keys-v').before('<button class="btn btn-yellow w-100 keys-b">Отпираемые двери</button>');
        $('#active-keys-v').remove();
        $('#voenniymarker').hide();
        $('#polkiimarker').hide();
        $('#dikiymarker').hide();
        $('#exitsmarker').hide();
        $('#keysmarker').hide();
        $('#playermarker').hide();
        $('#dikiyexitmarker').hide();
        $('#necessaryplaces').hide();
    });

    /** Обработка клика по кнопке выбора маркеров спавнов ЧВК BEAR и USEC **/
    $('body').on('click','.gamers-b', function(){
        $('.static-description').hide();
        $('#polkiimarker').hide();
        $('#voenniymarker').hide();
        $('#dikiymarker').hide();
        $('#polkiimarker').hide();
        $('#exitsmarker').hide();
        $('#keysmarker').hide();
        $('#dikiyexitmarker').hide();
        $('#necessaryplaces').hide();
        $('#playermarker').fadeIn();
        chvk.addTo(map);
        $(".gamers-b").before('<button class="btn btn-gamers gamers-b active" id="active-players-v">Спавны ЧВК</button>');
        $('#playermarker').html(staticData[5].content);
        $(this).remove();
    });

    $('body').on('click','#active-players-v', function(){
        map.removeLayer(chvk);
        $('#active-players-v').before('<button class="btn btn-gamers gamers-b">Спавны ЧВК</button>');
        $('#active-players-v').remove();
        $('#voenniymarker').hide();
        $('#polkiimarker').hide();
        $('#dikiymarker').hide();
        $('#exitsmarker').hide();
        $('#keysmarker').hide();
        $('#playermarker').hide();
        $('#dikiyexitmarker').hide();
        $('#necessaryplaces').hide();
    });

    /** Возвращаем пользователя к центру карты, если он кликнул на кнопку **/
    $('body').on('click','.mapcenter', function(){
        map.panTo(new L.LatLng(61.373, -10.469));
    });

    /** Инициализация OpenPopup **/
    $('body').on('click','.leaflet-marker-icon', function() {
        /** Указываем оборачивать все изображения в popup окнах классом JS Magnific - отлавливаем ошибки на несуществующие классы **/
        try {
            var MagnificImg = $('.leaflet-popup-content p img');
            var MagnificTitle = MagnificImg.attr("alt").length > 0;
        }

        catch (error) {
        }

        if (MagnificTitle) {
            $(MagnificImg).unwrap();
            $(MagnificImg).wrap('<a class="image-link" title="' + $(MagnificImg).attr('alt') + '" href=' + $(MagnificImg).attr('src') + '></a>');
        }

        if (MagnificImg) {
            $(MagnificImg).unwrap();
            $(MagnificImg).wrap('<a class="image-link" title="' + $(MagnificImg).attr('alt') + '" href=' + $(MagnificImg).attr('src') + '></a>');
        }

        /** Инициализация самого скрипта **/
        $('.image-link').magnificPopup(
            {
                type: 'image',
                showCloseBtn: true,
                mainClass: 'image-link'
            });

        $('.parent-container').each(function () { // the containers for all your galleries
            $(this).magnificPopup({
                delegate: 'a',  // the selector for gallery item
                type: 'image',
                gallery: {
                    enabled: true
                }
            });
        });
    });


    /** Убираем и показываем боковое меню при клике на стрелочки а также проверки разрешения окна браузера клиента **/
    $.wait = function( callback, seconds){
        return window.setTimeout(callback, seconds * 800 );
    };

    $('.outer-button').click(function () {
        $(".optins_layerstability").animate({ right: -437}, 800);
        $.wait(function(){$(".outer-button").hide()} ,1);
        $.wait(function(){$(".inner-button").show()} ,1);
    });

    $('.inner-button').click(function () {
        $(".optins_layerstability").animate({ right: 0 }, 800);
        $.wait(function(){$(".inner-button").hide()} ,1);
        $.wait(function(){$(".outer-button").show()} ,1);
    });

    if (document.body.clientWidth <= '768')  {
        $('.outer-button').click(function () {
            $(".optins_layerstability").animate({ right: -327}, 800);
            $.wait(function(){$(".outer-button").hide()} ,1);
            $.wait(function(){$(".inner-button").show()} ,1);
        });
    }
});