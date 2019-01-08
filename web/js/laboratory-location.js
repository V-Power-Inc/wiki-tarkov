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
    // errorTileUrl: '/img/error-bg.jpg',
}).addTo(map);

/** Устанавливаем зум карты на 2 также указываем что минимальный зум 2 а максимальный 4 **/
map.setMaxZoom(4);
map.setMinZoom(1);
// map.setZoom(3);

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
var ChvkIcon = L.icon({
    iconUrl: '/img/mapicons/chvk.png',
    iconSize: [30, 30]
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
        catch(err1) {}

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
        catch(err2) {}

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

    /** По прогрузке документа получаем данные по ajax с координатами и описаниями маркеров всех слоев **/
    // ajax should be here

    /** Отключаем на минимальном зуме кнопку минуса **/
    $('a.leaflet-control-zoom-out').addClass('leaflet-disabled');

    /** Объявляем группы маркеров всех возможных слоев **/
    var voenloot = L.layerGroup();
    var dikiy = L.layerGroup();
    var polki = L.layerGroup();
    var exits = L.layerGroup();
    var keys = L.layerGroup();
    var chvk = L.layerGroup();
    var dikieexits =  L.layerGroup();
    var interstplaces = L.layerGroup();

    /***************** Принимаем координаты всех маркеров с помощью циклов со всеми проверками *****************/
    // code of groups should be here



    /** Обработка клика по кнопке выбора маркеров выходов диких с локации **/
    $('body').on('click','.bandits-b', function(){
        dikieexits.addTo(map);
        $(".bandits-b").attr('id', 'active-bandits-v');
    });

    $('body').on('click','#active-bandits-v', function(){
        map.removeLayer(dikieexits);
        $(this).attr('id', '');
    });

    /** Обработка клика по кнопке выбора маркеров интересных мест **/
    $('body').on('click','.places-b', function(){
        interstplaces.addTo(map);
        $(".places-b").attr('id', 'active-places-v');
    });

    $('body').on('click','#active-places-v', function(){
        map.removeLayer(interstplaces);
        $(this).attr('id', '');
    });

    /** Обработка клика по кнопке выбора маркеров военного ящика **/
    $('body').on('click','.voenka-b', function(){
        voenloot.addTo(map);
        $(".voenka-b").attr('id' , 'active-bounds-v');
    });

    $('body').on('click','#active-bounds-v', function(){
        map.removeLayer(voenloot);
        $(this).attr('id', '');
    });

    /** Обработка клика по кнопке выбора маркеров диких **/
    $('body').on('click','.dikie-b', function(){
        dikiy.addTo(map);
        $(".dikie-b").attr('id', 'active-dikie-v');
    });

    $('body').on('click','#active-dikie-v', function(){
        map.removeLayer(dikiy);
        $(this).attr('id', '');
    });

    /** Обработка клика по кнопке выбора маркеров квестовых точек **/
    $('body').on('click','.polki-b', function(){
        polki.addTo(map);
        $(".polki-b").attr('id', 'active-polki-v');
    });

    $('body').on('click','#active-polki-v', function(){
        map.removeLayer(polki);
        $(this).attr('id', '');
    });

    /** Обработка клика по кнопке выбора маркеров выходов с карты **/
    $('body').on('click','.exits-b', function(){
        $('#exitsmarker').fadeIn();
        exits.addTo(map);
        $(".exits-b").attr('id', 'active-exits-v');
    });

    $('body').on('click','#active-exits-v', function(){
        map.removeLayer(exits);
        $(this).attr('id', '');
    });

    /** Обработка клика по кнопке выбора маркеров дверей открываемых ключами **/
    $('body').on('click','.keys-b', function(){
        keys.addTo(map);
        $(".keys-b").attr('id', 'active-keys-v');
    });

    $('body').on('click','#active-keys-v', function(){
        map.removeLayer(keys);
        $(this).attr('id', '');
    });

    /** Обработка клика по кнопке выбора маркеров спавнов ЧВК BEAR и USEC **/
    $('body').on('click','.gamers-b', function(){
        chvk.addTo(map);
        $(".gamers-b").attr('id', 'active-players-v');
    });

    $('body').on('click','#active-players-v', function(){
        map.removeLayer(chvk);
        $(this).attr('id', '');
    });



    /** Возвращаем пользователя к центру карты, если он кликнул на кнопку **/
    $('body').on('click','.mapcenter', function(){
        map.panTo(new L.LatLng(33.724, -48.516));
    });

    /** Инициализация OpenPopup **/
    $('body').on('click','.leaflet-marker-icon', function() {
        /** Указываем оборачивать все изображения в popup окнах классом JS Magnific - отлавливаем ошибки на несуществующие классы **/
        try {
            var MagnificImg = $('.leaflet-popup-content p img, .leaflet-popup-content img');
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
        $('.leaflet-popup-content').append('<br><br><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>\n' +
            '<ins class="adsbygoogle"\n' +
            '     style="display:block; text-align:center;"\n' +
            '     data-ad-layout="in-article"\n' +
            '     data-ad-format="fluid"\n' +
            '     data-ad-client="ca-pub-5071904663034434"\n' +
            '     data-ad-slot="9226765946"></ins>\n' +
            '<script>\n' +
            '     (adsbygoogle = window.adsbygoogle || []).push({});\n' +
            '</script>');
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