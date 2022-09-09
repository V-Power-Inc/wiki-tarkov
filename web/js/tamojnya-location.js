/**
 * Created by comp on 23.01.2018.
 */

/** Вызываем заглушку для страницы в самом начале **/
$('body').before('<div class="loader-maps-background"><img class="preloader_map" src="/img/load.gif"><p class="alert alert-info text-preloader">Идет загрузка...</p></div>');

/** Вызов карты и указание центра координат **/
const map = L.map('map', {
    center: [81.361, -74.883],
    maxzoom: 6,
    minzoom: 4,
    zoom: 4
});

/** Обращаемся к слоям зума интерактивной карты **/
L.tileLayer('/img/tamojnya/{z}/{x}/{y}.png', {
    noWrap: true,
}).addTo(map);

/** Подключаем хэш в url для учета текущего зума и центра координат пользователя **/
var hash = new L.Hash(map);

/** Устанавливаем зум карты на 2 также указываем что минимальный зум 2 а максимальный 4 **/
map.setMaxZoom(6);
map.setMinZoom(4);
// map.setZoom(4);

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
    iconSize: [30, 30]
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

    /*** Отображаем количество маркеров каждого типа при клике на кнопку - показать количество маркеров ****/
    $('body').on('click','.count-on', function() {
        // Сначада пробуем удалить существующие блоки в HTML 
        try {
            $('.count-markers-global').each(function() {
                $(this).remove();
            });
        } catch(undefined) {}

        // Переменные для количества маркеров каждой группы маркеров
        var spawndikiycount = 0;
        var spawnchvkcount = 0;
        var exitsdikiecount = 0;
        var exitschvkcount = 0;
        var voenlootcount = 0;
        var questscount = 0;
        var keyscount = 0;
        var interestcount = 0;

        // Встречая совпадение, увеличиваем число на единицу
        $.each(markersData, function(i) {
            if(markersData[i].marker_group == "Спавны диких") {
                spawndikiycount+= 1;
            } else if(markersData[i].marker_group == "Спавны игроков ЧВК") {
                spawnchvkcount+= 1;
            } else if(markersData[i].marker_group == "Выходы за Диких") {
                exitsdikiecount+=1;
            } else if(markersData[i].marker_group == "Маркеры выходов") {
                exitschvkcount+=1;
            } else if(markersData[i].marker_group == "Военные ящики") {
                voenlootcount+=1;
            } else if(markersData[i].marker_group == "Квестовые точки") {
                questscount+=1;
            } else if(markersData[i].marker_group == "Интересные места") {
                interestcount+=1;
            } else if(markersData[i].marker_group == "Маркеры ключей") {
                keyscount+=1;
            }
        });

        // Вывод количества маркеров на каждую группу, после соответствующих записей в боковом меню карты
        $('.dikie-b').append('<span class="count-markers-global">'+spawndikiycount+'</span>');
        $('.gamers-b').append('<span class="count-markers-global">'+spawnchvkcount+'</span>');
        $('.bandits-b').append('<span class="count-markers-global">'+exitsdikiecount+'</span>');
        $('.exits-b').append('<span class="count-markers-global">'+exitschvkcount+'</span>');
        $('.voenka-b').append('<span class="count-markers-global">'+voenlootcount+'</span>');
        $('.polki-b').append('<span class="count-markers-global">'+questscount+'</span>');
        $('.keys-b').append('<span class="count-markers-global">'+keyscount+'</span>');
        $('.places-b').append('<span class="count-markers-global">'+interestcount+'</span>');

    });

    /*** Скрываем количества каждого типа маркеров при клике на кнопку скрыть количество ***/
    $('body').on('click','.count-off', function() {
        try {
            $('.count-markers-global').each(function() {
                $(this).remove();
            });
        } catch(undefined) {}
    });

    /*** Показываем все маркеры при клике на кнопку - показать все маркеры ***/
    $('body').on('click','.markers-on', function() {
        // Вырубаем сначала все включенные слои
        try {
            $('#active-bandits-v').click();
            $('#active-places-v').click();
            $('#active-bounds-v').click();
            $('#active-dikie-v').click();
            $('#active-polki-v').click();
            $('#active-exits-v').click();
            $('#active-keys-v').click();
            $('#active-players-v').click();
        }
        catch(err) {}

        // Включаем все маркеры кроме спавнов
        $('.dikie-b').click();
        $('.gamers-b').click();
        $('.bandits-b').click();
        $('.exits-b').click();
        $('.voenka-b').click();
        $('.polki-b').click();
        $('.keys-b').click();
        $('.places-b').click();

        $('.map_buttons p').each(function() {
            $(this).addClass('unthrough');
        });
    });

    /*** Скрываем все маркеры если нажали кнопку - скрыть марккеры ***/
    $('body').on('click','.markers-off', function() {
        // Отключаем все включенные слои
        try {
            $('#active-bandits-v').click();
            $('#active-places-v').click();
            $('#active-bounds-v').click();
            $('#active-dikie-v').click();
            $('#active-polki-v').click();
            $('#active-exits-v').click();
            $('#active-keys-v').click();
            $('#active-players-v').click();
        }
        catch(err) {}

        $('.map_buttons p').each(function() {
            $(this).removeClass('unthrough');
            $(this).attr('id', '');
        });

    });

    /** Убираем зачеркивание у кнопок у которых оно уже было **/
    $('body').on('click','.map_buttons p', function() {
        if($(this).hasClass('unthrough') !== true) {
            $(this).addClass('unthrough');
        }
    });

    /** Зачеркиваем кнопки маркеров, по которым нажали **/
    $('body').on('click','.map_buttons p.unthrough', function() {
        // console.log($(this).attr('id').length);
        if ($(this).hasClass('unthrough') == true)  {
            $(this).removeClass('unthrough');
        }
    });

    /** Делаем бэкграунд черным **/
    $('body').css({'background':'black'});

    /*** Объявляем проверочные токены для Ajax ***/
    var param = $('meta[name=csrf-param]').attr("content");
    var token = $('meta[name=csrf-token]').attr("content");

    /** По прогрузке документа получаем данные по ajax с координатами и описаниями маркеров всех слоев **/
    $.ajax({
        url: '/maps/tamojnyamarkers',
        dataType: 'json',
        data: {param: param, token : token},
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
            L.marker([markersData[i].coords_x, markersData[i].coords_y], {icon: ExitsIcon}).bindPopup(markersData[i].content).on('click', markerOnClick).openPopup().setZIndexOffset(999).addTo(boilersspawn);
            L.marker([markersData[i].coords_x, markersData[i].coords_y], {icon: ExitsIcon}).bindPopup(markersData[i].content).on('click', markerOnClick).openPopup().setZIndexOffset(999).addTo(garajispawn);
        } else if (markersData[i].exits_group == "Спавн на бойлерах") {
            var ExitsIcon = L.icon({
                iconSize: [170, 30],
                iconUrl: markersData[i].customicon,
            });
            L.marker([markersData[i].coords_x, markersData[i].coords_y], {icon: ExitsIcon}).bindPopup(markersData[i].content).on('click', markerOnClick).openPopup().setZIndexOffset(999).addTo(boilersspawn);
        } else if (markersData[i].exits_group == "Спавн на гаражах") {
            var ExitsIcon = L.icon({
                iconSize: [170, 30],
                iconUrl: markersData[i].customicon,
            });
            L.marker([markersData[i].coords_x, markersData[i].coords_y], {icon: ExitsIcon}).bindPopup(markersData[i].content).on('click', markerOnClick).openPopup().setZIndexOffset(999).addTo(garajispawn);
        } else if (markersData[i].marker_group == "Военные ящики" && markersData[i].customicon == null) {
            L.marker([markersData[i].coords_x, markersData[i].coords_y], {icon: ArmyIcon}).bindPopup(markersData[i].content).on('click', markerOnClick).openPopup().addTo(voenloot);
        } else if (markersData[i].marker_group == "Военные ящики"  && markersData[i].customicon !== null) {
            var CustomVoenIcon = L.icon({
                iconSize: [30, 30],
                iconUrl: markersData[i].customicon,
            });
            L.marker([markersData[i].coords_x, markersData[i].coords_y], {icon: CustomVoenIcon}).bindPopup(markersData[i].content).on('click', markerOnClick).openPopup().addTo(voenloot);
        } else if (markersData[i].marker_group == "Спавны диких" && markersData[i].content !== "") {
            L.marker([markersData[i].coords_x, markersData[i].coords_y], {icon: DikieIcon}).bindPopup(markersData[i].content).on('click', markerOnClick).openPopup().addTo(dikiy);
        } else if (markersData[i].marker_group == "Спавны диких" && markersData[i].content == "") {
            L.marker([markersData[i].coords_x, markersData[i].coords_y], {icon: DikieIcon}).addTo(dikiy);
        } else if (markersData[i].marker_group == "Квестовые точки") {
            L.marker([markersData[i].coords_x, markersData[i].coords_y], {icon: PolkiIcon}).bindPopup(markersData[i].content).on('click', markerOnClick).openPopup().addTo(polki);
        } else if (markersData[i].marker_group == "Спавны игроков ЧВК") {
            L.marker([markersData[i].coords_x, markersData[i].coords_y], {icon: ChvkIcon}).bindPopup(markersData[i].content).on('click', markerOnClick).openPopup().addTo(chvk);
        } else if (markersData[i].marker_group == "Маркеры ключей") {
            L.marker([markersData[i].coords_x, markersData[i].coords_y], {icon: KeysIcon}).bindPopup(markersData[i].content).on('click', markerOnClick).openPopup().addTo(keys);
        } else if (markersData[i].marker_group == "Выходы за Диких") {
            var DikiyExitIcon = L.icon({
                iconSize: [170, 30],
                iconUrl: markersData[i].customicon,
            });
            L.marker([markersData[i].coords_x, markersData[i].coords_y], {icon: DikiyExitIcon}).bindPopup(markersData[i].content).on('click', markerOnClick).openPopup().setZIndexOffset(990).addTo(dikieexits);
        } else if (markersData[i].marker_group == "Интересные места" && markersData[i].customicon == null) {
            L.marker([markersData[i].coords_x, markersData[i].coords_y], {icon: PlacesInt}).bindPopup(markersData[i].content).on('click', markerOnClick).openPopup().addTo(interstplaces);
        } else if (markersData[i].marker_group == "Интересные места" && markersData[i].customicon !== null) {
            var InterestPlaces = L.icon({
                iconSize: [30, 30],
                iconUrl: markersData[i].customicon,
            });
            L.marker([markersData[i].coords_x, markersData[i].coords_y], {icon: InterestPlaces}).bindPopup(markersData[i].content).on('click', markerOnClick).openPopup().addTo(interstplaces);
        }
    });

    /** Обработка клика по кнопке выбора маркеров выходов диких с локации **/
    $('body').on('click','.bandits-b', function(){
        dikieexits.addTo(map);
        $(".bandits-b").attr('id', 'active-bandits-v');
        // $('#dikiyexitmarker').html(staticData[6].content);
        // $(this).remove();
    });

    $('body').on('click','#active-bandits-v', function(){
        map.removeLayer(dikieexits);
        $(this).attr('id', '');
    });

    /** Обработка клика по кнопке выбора маркеров интересных мест **/
    $('body').on('click','.places-b', function(){
        interstplaces.addTo(map);
        $(".places-b").attr('id', 'active-places-v');
        // $('#necessaryplaces').html(staticData[7].content);
        // $(this).remove();
    });

    $('body').on('click','#active-places-v', function(){
        map.removeLayer(interstplaces);
        $(this).attr('id', '');
    });

    /** Обработка клика по кнопке выбора маркеров военного ящика **/
    $('body').on('click','.voenka-b', function(){
        voenloot.addTo(map);
        $(".voenka-b").attr('id' , 'active-bounds-v');
        // $('#voenniymarker').html(staticData[1].content);
        // $(this).remove();
    });

    $('body').on('click','#active-bounds-v', function(){
        map.removeLayer(voenloot);
        $(this).attr('id', '');
    });

    /** Обработка клика по кнопке выбора маркеров диких **/
    $('body').on('click','.dikie-b', function(){
        dikiy.addTo(map);
        $(".dikie-b").attr('id', 'active-dikie-v');
        // $('#dikiymarker').html(staticData[0].content);
        // $(this).remove();
    });

    $('body').on('click','#active-dikie-v', function(){
        map.removeLayer(dikiy);
        $(this).attr('id', '');
    });

    /** Обработка клика по кнопке выбора маркеров квестовых точек **/
    $('body').on('click','.polki-b', function(){
        polki.addTo(map);
        $(".polki-b").attr('id', 'active-polki-v');
        // $('#polkiimarker').html(staticData[2].content);
        // $(this).remove();
    });

    $('body').on('click','#active-polki-v', function(){
        map.removeLayer(polki);
        $(this).attr('id', '');
    });

    /** Обработка клика по кнопке выбора маркеров выходов с карты **/
    $('body').on('click','.exits-b', function(){
        // Добавляем переключатель выхода
        $('.random-exits').fadeIn();
        //  exits.addTo(map);
        try {
            map.removeLayer(garajispawn);
            map.removeLayer(boilersspawn);
        } catch(err) {}

        garajispawn.addTo(map);
        $(".exits-b").attr('id', 'active-exits-v');
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
        $(this).attr('id', '');
        // Убираемы переключатель выхода
        $('.random-exits').hide();
    });

    /** Обработка клика по кнопке выбора маркеров дверей открываемых ключами **/
    $('body').on('click','.keys-b', function(){
        keys.addTo(map);
        $(".keys-b").attr('id', 'active-keys-v');
        // $('#keysmarker').html(staticData[4].content);
        // $(this).remove();
    });

    $('body').on('click','#active-keys-v', function(){
        map.removeLayer(keys);
        $(this).attr('id', '');
    });

    /** Обработка клика по кнопке выбора маркеров спавнов ЧВК BEAR и USEC **/
    $('body').on('click','.gamers-b', function(){
        chvk.addTo(map);
        $(".gamers-b").attr('id', 'active-players-v');
        // $('#playermarker').html(staticData[5].content);
        // $(this).remove();
    });

    $('body').on('click','#active-players-v', function(){
        map.removeLayer(chvk);
        $(this).attr('id', '');
    });

    /** Возвращаем пользователя к центру карты, если он кликнул на кнопку **/
    $('body').on('click','.mapcenter', function(){
        map.panTo(new L.LatLng(81.361, -74.883));
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

    /*** function add special blocks with dop.content to users when inits click on market ***/
    function AddRelations() {

        // Ads were In AppendBlock
        $('.leaflet-popup-content').append('<div class="rl_cnt_bg" data-id="298961"></div>');
    }

    function markerOnClick() {
        AddRelations();
    }


    /** Убираем и показываем боковое меню при клике на стрелочки а также проверки разрешения окна браузера клиента **/
    $.wait = function( callback, seconds){
        return window.setTimeout(callback, seconds * 800 );
    };

    $('.outer-button').click(function () {
        $(".optins_layerstability").animate({ right: -540}, 800);
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