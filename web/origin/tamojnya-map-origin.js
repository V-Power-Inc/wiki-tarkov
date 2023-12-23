/**
 * Created by DIR300NRU-ADMIN on 13.11.2017.
 * Refactoring by PC_Principal on 09.01.2023
 *
 * @link https://javascriptobfuscator.dev/ - Obfuscate JS
 */

/** Вызываем заглушку для страницы в самом начале **/
$('body').before('<div class="loader-maps-background"><img class="preloader_map" src="/img/load.gif"><p class="alert alert-info text-preloader">Идет загрузка...</p></div>');

/** Объявляем проверочные токены для Ajax */
var param = $('meta[name=csrf-param]').attr("content");
var token = $('meta[name=csrf-token]').attr("content");

/** Константа с селекторами, для работы с DOM */
const Selectors = {

    /** Селектор body **/
    body: 'body',

    /** Селекторы чекбоксов, что отвечают за слои на Leaflet JS */
    layerControls: '.form-control input#ids-control',

    /** Селектор чекбокса - показать все слои */
    showLayers:  '#ids-show-all',

    /** Селектор чекбокса - скрыть все слои */
    hideLayers: '#ids-hide-all',

    /** Селектор радиокнопок слоев карт */
    radioLayersMaps: '.map-layers-control',

    /** Селектор всех чекбоксов в боковом навигационном меню Leaflet */
    allMapCheckboxes: '.form-control.map-layers',

    /** Селектор до навигации Leafler JS карты (Все что сгенерено JS'ом) */
    allMapControls: '.all-map-blocks',

    /** Кнопка - скрыть всю навигацию карт */
    buttonShowAllMenu: '#show-allcontrols',

    /** Кнопка - показать всю навигацию карт */
    buttonHideAllMenu: '#hide-allcontrols'
};

/** Добавляем базовый слой интерактивной карты (С опцией - без повторения карты) */
let baseTileLayer = L.tileLayer('/img/tamojnya/{z}/{x}/{y}.png', {
    noWrap: true,
    tms: false
});

/** Вызов карты и указание центра координат и параметров зума **/
const map = L.map('map', {
    center: [67, -70],
    maxzoom: 6,
    minzoom: 2,
    zoom: 2,
    layers: [baseTileLayer]
});

/** Константа с набором иконок для различных маркеров */
const Icons = {

    /** Иконки Военных ящиков */
    ArmyIcon: L.icon({
        iconUrl: '/img/mapicons/voen-yaj.png',
        iconSize: [30, 30],
    }),

    /** Иконки квестовых мест */
    QuestIcon: L.icon({
        iconUrl: '/img/mapicons/quest_icon2.png',
        iconSize: [30, 30]
    }),

    /** Иконки спавнов диких */
    DikieIcon: L.icon({
        iconUrl: '/img/mapicons/dikie.png',
        iconSize: [30, 30]
    }),

    /** Иконки ключей от дверей */
    KeysIcon: L.icon({
        iconUrl: '/img/mapicons/keys.png',
        iconSize: [30, 30]
    }),

    /** Иконки спавнов ЧВК */
    ChvkIcon: L.icon({
        iconUrl: '/img/mapicons/chvk.png',
        iconSize: [30, 30]
    }),

    /** Иконки интересных мест */
    PlacesInt: L.icon({
        iconUrl: '/img/mapicons/whatis.png',
        iconSize: [28, 27]
    })
};

/** Константа с набором слоев для карты (Группы маркеров) */
const Layers = {

    /** Слой маркеров военных ящиков */
    Army: L.layerGroup(),

    /** Слой маркеров Диких */
    Scaws: L.layerGroup(),

    /** Слой маркеров спавнов ЧВК */
    Chvk: L.layerGroup(),

    /** Слой дверей, открываемых ключами */
    Keys: L.layerGroup(),

    /** Слой интересных мест */
    Quest: L.layerGroup(),

    /** Слой интересных мест */
    Places: L.layerGroup(),

    /** Выходы с локации за ЧВК */
    Exits: L.layerGroup(),

    /** Выходы с локации за Диких */
    DikieExits: L.layerGroup()
};

/** Ассоциативный набор объектов названий классов чекбоксов и их соответствий в виде Leaflet слоев с маркерами
 * (Необходимо для работы маркеров и лаконичности их вызова) **/
const LayerControls = {
    ScawsControl : Layers.Scaws,
    ChvkControl : Layers.Chvk,
    KeysControl : Layers.Keys,
    QuestControl : Layers.Quest,
    ArmyControl: Layers.Army,
    PlacesControl: Layers.Places,
    ExitsControl: Layers.Exits,
    DikieExitsControl: Layers.DikieExits
};

/** Добавляем чекбоксы слоев для Leaflet карты */
let MainControl = L.Control.extend({

    /** Опции положения элементов управления (Положение на карте) */
    options: {
        position: 'topright'
    },

    /** Обработчик события при добавлении на карту */
    onAdd: function () {

        /** Создание необходимых HTML блоков */
        let div = L.DomUtil.create('div', 'leaflet-control-layers');

        /** Создание необходимых Checkbox блоков и радиокнопок - в теле Leaflet */
        div.innerHTML = '<button class="btn btn-primary" id="hide-allcontrols">Скрыть меню</button>' +
            '<button class="btn btn-success" id="show-allcontrols" style="display: none">Показать меню</button>' +
            '<div class="all-map-blocks">' +
            '<div class="form-control map-layers"><input id="ids-control" class="ScawsControl" type="checkbox"/>Спавны Диких</div>' +
            '<div class="form-control map-layers"><input id="ids-control" class="ChvkControl" type="checkbox"/>Спавн ЧВК</div>' +
            '<div class="form-control map-layers"><input id="ids-control" class="ArmyControl" type="checkbox"/>Военные ящики</div>' +
            '<div class="form-control map-layers"><input id="ids-control" class="PlacesControl" type="checkbox"/>Интересные места</div>' +
            '<div class="form-control map-layers"><input id="ids-control" class="KeysControl" type="checkbox"/>Отпираемые двери</div>' +
            '<div class="form-control map-layers"><input id="ids-control" class="QuestControl" type="checkbox"/>Квестовые места</div>' +
            '<div class="form-control map-layers"><input id="ids-control" class="DikieExitsControl" type="checkbox"/>Выходы за Диких</div>' +
            '<div class="form-control map-layers"><input id="ids-control" class="ExitsControl" type="checkbox"/>Выходы за ЧВК</div>' +

            '<div class="leaflet-control-layers-separator"></div>' +
            '<div class="form-control map-layers"><input id="ids-show-all" class="MainControls" type="checkbox"/>Показать все маркеры</div>' +
            '<div class="form-control map-layers"><input id="ids-hide-all" class="MainControls" type="checkbox"/>Скрыть все маркеры</div>' +
            '</div>';

        /** Возвращаем конечный Html результат */
        return div;
    }
});

/** Добавляем на карту интерактивные элементы */
map.addControl(new MainControl());

/** Функция обработчика чекбокса слоев карты (Параметр сюда должен прилететь this)
 *
 * @param Data - Объект this, с которым произошло событие
 */
function LayershandleControl(Data) {

    /** Переменная с классом чекбокса, который кликнули */
    let _className = $(Data).attr('class');

    /** При взаимодействии с чекбоксом из списка слоев - отключаем чекбокс, показать все маркеры */
    $(Selectors.showLayers).prop('checked', false);

    /** При взаимодействии с чекбоксом из списка слоев - отключаем чекбокс, скрыть все маркеры */
    $(Selectors.hideLayers).prop('checked', false);

    /** Если чекбокс выбран - делаем активным слой чекбокса, если нет, то отключаем его */
    if (Data.checked === true) {
        map.addLayer(LayerControls[_className]);
    } else {
        map.removeLayer(LayerControls[_className]);
    }
}

/**
 * Функция обработчика чекбоксов - Показать и скрыть все слои
 *
 * @param Data - Объект this, с которым произошло событие
 */
function MainhandleControl(Data) {

    /** Переменная с ID чекбокса, который кликнули */
    let id = $(Data).attr('id');

    /** В свитче смотрим, какой чекбокс пришел - на показ или на скрытие всех слоев */
    switch (id) {

        /** Кейс, показать все слои */
        case 'ids-show-all':

            /** Если чекбокс в true положении, тогда будет дальнейшая логика */
            if ($(Selectors.showLayers).is(':checked') === true) {

                /** В цикле включаем все слои маркеров на карте */
                $.each(Layers, function(i) {
                    map.addLayer(Layers[i]);
                });

                /** Проставляем всем чекбоксам слоев атрибут checked - true */
                $(Selectors.layerControls).each(function() {

                    /** Каждый чекбокс слоев Leaflet с маркерами становится checked - true */
                    $(this).prop('checked', true);

                    /** Устанавливаем чекбокс - скрыть все слои в false */
                    $(Selectors.body + ' ' + Selectors.hideLayers).prop('checked', false);
                });

                /** Прерываем цикл */
                break;
            }

            /** Прерываем цикл */
            break;

        /** Кейс, скрыть все слои */
        case 'ids-hide-all':

            /** Если чекбокс в true положении, тогда будет дальнейшая логика */
            if ($(Selectors.hideLayers).is(':checked') === true) {

                /** В цикле выключаем все слои маркеров на карте */
                $.each(Layers, function(i) {
                    map.removeLayer(Layers[i]);
                });

                /** Проставляем всем чекбоксам слоев атрибут checked - false */
                disableMapCheckboxes();

                /** Прерываем цикл */
                break;
            }

            /** Прерываем цикл */
            break;
    }
}

/** Функция отключает prop Checked, для всех чекбоксов слоев на интерактивных картах */
function disableMapCheckboxes(bool = false) {

    /** Проставляем всем чекбоксам слоев атрибут checked - false */
    $(Selectors.layerControls).each(function() {

        /** Каждый чекбокс слоев Leaflet с маркерами становится checked - false */
        $(this).prop('checked', false);

        /** Устанавливаем чекбокс - показать все слои в false */
        $(Selectors.body + ' ' + Selectors.showLayers).prop('checked', false);
    });

    /** Если прилетел флаг all, тогда ставим checked false и для чекбокса - скрыть все слои */
    if (bool === true) {

        /** Убираем чекед и для чекбокса - скрыть все маркеры */
        $(Selectors.body + ' ' + Selectors.hideLayers).prop('checked', false);
    }
}

/*** function add special blocks with dop.content to users when inits click on market ***/
function AddRelations() {
    // Ads were In AppendBlock
    $('.leaflet-popup-content');
}

/** Добавляем слушатель событий изменения базовых чекбоксов Leaflet */
$(Selectors.body).on('click', '#ids-show-all, #ids-hide-all', function() {

    /** Вызываем обработчик события и передаем в него this - для дальнейшей работы */
    MainhandleControl(this);
});

/** Добавляем слушатель событий изменения чекбоксов слоев Leaflet */
$(Selectors.body).on('click', '#ids-control', function() {

    /** Вызываем обработчик события и передаем в него this - для дальнейшей работы */
    LayershandleControl(this);
});

/** Добавляем слушатель событий - клик по кнопке показа всей навигации Leaflet JS */
$(Selectors.body).on('click', Selectors.buttonShowAllMenu, function() {

    /** Скрываем кнопку - показать все элементы навигации */
    $(this).fadeOut();

    /** Показываем кнопку - скрыть все элементы навигации */
    $(Selectors.buttonHideAllMenu).fadeIn();

    /** Показываем всю навигацию */
    $(Selectors.allMapControls).fadeIn();
});

/** Добавляем слушатель событий - клик по кнопке скрытия всей навигации Leaflet JS */
$(Selectors.body).on('click', Selectors.buttonHideAllMenu, function() {

    /** Скрываем кнопку - скрыть все элементы навигации */
    $(this).fadeOut();

    /** Показываем кнопку - показать все элементы навигации */
    $(Selectors.buttonShowAllMenu).fadeIn();

    /** Скрываем всю навигацию */
    $(Selectors.allMapControls).fadeOut();
});

/** Подключаем хэш в url для учета текущего зума и центра координат пользователя **/
var hash = new L.Hash(map);

/** Устанавливаем зум карты на 2 также указываем что минимальный зум 2 а максимальный 6 **/
map.setMaxZoom(6);
map.setMinZoom(2);

/** Получаем текщие координаты по местонахождению мышки **/
function onMouseMove(e) {
    $('#mapCoords').text((e.latlng.lat).toFixed(3) + ", " + (e.latlng.lng).toFixed(3));
}

/** Добавляем слушатель события - движение мышки по карте */
map.on('mousemove', onMouseMove);

/** По прогрузке документа получаем данные по ajax с координатами и описаниями маркеров всех слоев **/
$(document).ready(function() {
    $.ajax({
        url: '/maps/get-markers',
        dataType: 'json',
        data: {param: param, token : token, map: 'tamojnya'},
        async: false,
        success: function(markersData) {

            $.each(markersData, function(i) {
                if (markersData[i].marker_group == "Маркеры выходов") {
                    let ExitsIcon = L.icon({
                        iconSize: [181, 26],
                        iconUrl: markersData[i].customicon,
                    });
                    L.marker([markersData[i].coords_x, markersData[i].coords_y], {icon: ExitsIcon}).bindPopup(markersData[i].content).on('click', AddRelations).openPopup().addTo(Layers.Exits);
                } else if (markersData[i].marker_group == "Военные ящики" && markersData[i].customicon == null) {
                    L.marker([markersData[i].coords_x, markersData[i].coords_y], {icon: Icons.ArmyIcon}).bindPopup(markersData[i].content).on('click', AddRelations).openPopup().addTo(Layers.Army);
                } else if (markersData[i].marker_group == "Военные ящики"  && markersData[i].customicon !== null) {
                    var CustomVoenIcon = L.icon({
                        iconSize: [30, 30],
                        iconUrl: markersData[i].customicon,
                    });
                    L.marker([markersData[i].coords_x, markersData[i].coords_y], {icon: CustomVoenIcon}).bindPopup(markersData[i].content).on('click', AddRelations).openPopup().addTo(Layers.Army);
                } else if (markersData[i].marker_group == "Спавны диких" && markersData[i].content !== "") {
                    L.marker([markersData[i].coords_x, markersData[i].coords_y], {icon: Icons.DikieIcon}).bindPopup(markersData[i].content).on('click', AddRelations).openPopup().addTo(Layers.Scaws);
                } else if (markersData[i].marker_group == "Спавны диких" && markersData[i].content == "") {
                    L.marker([markersData[i].coords_x, markersData[i].coords_y], {icon: Icons.DikieIcon}).addTo(Layers.Scaws);
                } else if (markersData[i].marker_group == "Квестовые точки") {
                    L.marker([markersData[i].coords_x, markersData[i].coords_y], {icon: Icons.QuestIcon}).bindPopup(markersData[i].content).on('click', AddRelations).openPopup().addTo(Layers.Quest);
                } else if (markersData[i].marker_group == "Спавны игроков ЧВК") {
                    L.marker([markersData[i].coords_x, markersData[i].coords_y], {icon: Icons.ChvkIcon}).bindPopup(markersData[i].content).on('click', AddRelations).openPopup().addTo(Layers.Chvk);
                } else if (markersData[i].marker_group == "Маркеры ключей") {
                    L.marker([markersData[i].coords_x, markersData[i].coords_y], {icon: Icons.KeysIcon}).bindPopup(markersData[i].content).on('click', AddRelations).openPopup().addTo(Layers.Keys);
                } else if (markersData[i].marker_group == "Выходы за Диких") {
                    var DikiyExitIcon = L.icon({
                        iconSize: [181, 26],
                        iconUrl: markersData[i].customicon,
                    });
                    L.marker([markersData[i].coords_x, markersData[i].coords_y], {icon: DikiyExitIcon}).bindPopup(markersData[i].content).on('click', AddRelations).openPopup().setZIndexOffset(990).addTo(Layers.DikieExits);
                } else if (markersData[i].marker_group == "Интересные места" && markersData[i].customicon == null) {
                    L.marker([markersData[i].coords_x, markersData[i].coords_y], {icon: Icons.PlacesInt}).bindPopup(markersData[i].content).on('click', AddRelations).openPopup().addTo(Layers.Places);
                } else if (markersData[i].marker_group == "Интересные места" && markersData[i].customicon !== null) {
                    var InterestPlaces = L.icon({
                        iconSize: [30, 30],
                        iconUrl: markersData[i].customicon,
                    });
                    L.marker([markersData[i].coords_x, markersData[i].coords_y], {icon: InterestPlaces}).bindPopup(markersData[i].content).on('click', AddRelations).openPopup().addTo(Layers.Places);
                }
            });

            /** Убираем loader, если карта корректно подгрузилась */
            $('.loader-maps-background').fadeOut();
        }
    });

    /** Отключаем на минимальном зуме кнопку минуса **/
    $('a.leaflet-control-zoom-out').addClass('leaflet-disabled');

    /** Возвращаем пользователя к центру карты, если он кликнул на кнопку **/
    $(Selectors.body).on('click','.mapcenter', function(){
        map.panTo(new L.LatLng(67, -70));
    });

    /** Инициализация OpenPopup **/
    $(Selectors.body).on('click','.leaflet-marker-icon', function() {
        /** Указываем оборачивать все изображения в popup окнах классом JS Magnific - отлавливаем ошибки на несуществующие классы **/
        try {
            var MagnificImg = $('.leaflet-popup-content p img');
            var MagnificTitle = MagnificImg.attr("alt").length > 0;
        }

        catch(error) {}

        /** Кейс, когда у картинки есть title */
        if (MagnificTitle) {
            $(MagnificImg).unwrap();
            $(MagnificImg).wrap('<a class="image-link" title="'+$(MagnificImg).attr('alt')+'" href='+$(MagnificImg).attr('src')+'></a>');
        }

        /** Кейс, когда есть картинка в попапе */
        if (MagnificImg) {
            $(MagnificImg).unwrap();
            $(MagnificImg).wrap('<a class="image-link" title="'+$(MagnificImg).attr('alt')+'" href='+$(MagnificImg).attr('src')+'></a>');
        }

        /** Инициализация самого скрипта **/
        $('.image-link').magnificPopup(
            {
                type: 'image',
                showCloseBtn: true,
                mainClass: 'image-link'
            });

        /** Обработка галерей в попапе */
        $('.parent-container').each(function () { // the containers for all your galleries
            $(this).magnificPopup({
                delegate: 'a', // the selector for gallery item
                type: 'image',
                gallery: {
                    enabled: true
                }
            });
        });
    });
});