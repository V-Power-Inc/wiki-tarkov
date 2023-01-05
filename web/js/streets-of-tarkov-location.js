/**
 * JS Обработчик карты - улицы Таркова
 * Добавляя новые маркеры и группы важно делать следующее:
 *
 * - Сетап иконки (Константа Icons)
 * - Сетап слоя (Константа Layers)
 * - Сетап чекбокса слоев (Константа LayerControls)
 *
 * @link https://mourner.github.io/Leaflet/reference.html - Documentation LeafletJS
 * @link https://www.obfuscator.io/ - Obfuscate JS
 */

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

    /** Селектор радиокнопки слоя основной карты (Решетку перед вызовом дописывать) */
    radioMainMap: 'FirstMap',

    /** Селектор радиокнопки слоя вспомогательной карты (Решетку перед вызовом дописывать) */
    radioSecondMap: 'SecondMap',

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
let baseTileLayer = L.tileLayer('/img/streets-of-tarkov/{z}/{x}/{y}.webp', {
    noWrap: true,
    tms: false
});

/** Вспомогательная версия локации (С опцией - без повторения карты) */
let AlternativeTileLayers = L.tileLayer('/img/streets-of-tarkov-v2/{z}/{x}/{y}.png', {
    noWrap: true,
    tms: false
});

/** Константа с опциями карты **/
const Map = L.map('map', {

    /** Положение центра карты */
    center: [67, -5],

    /** Максимально возможный зум карты */
    maxzoom: 4,

    /** Минимально возможный зум карты */
    minzoom: 1,

    /** Дефолтный зум карты */
    zoom: 1,

    layers: [baseTileLayer],
});

/** Константа с набором иконок для различных маркеров */
const Icons = {

    /** Иконки Диких */
    ScawsIcon: L.icon({
        iconUrl: '/img/mapicons/dikie.png',
        iconSize: [30, 30]
    }),

    /** Иконки ЧВК */
    ChvkIcon: L.icon({
        iconUrl: '/img/mapicons/chvk.png',
        iconSize: [30, 30]
    }),

    /** Иконки дверей - отпираемых ключами */
    KeysIcon: L.icon({
        iconUrl: '/img/mapicons/keys.png',
        iconSize: [30, 30]
    }),

    /** Иконки выдвижных шкафов */
    ChkafIcon: L.icon({
        iconUrl: '/img/mapicons/chkaf.png',
        iconSize: [30, 30]
    })
};

/** Константа с набором слоев для карты (Группы маркеров) */
const Layers = {

    /** Слой маркеров Диких */
    Scaws: L.layerGroup(),

    /** Слой маркеров спавнов ЧВК */
    Chvk: L.layerGroup(),

    /** Слой дверей, открываемых ключами */
    Keys: L.layerGroup(),

    /** Слой выдвижных шкафов */
    Chkaf: L.layerGroup()
};

/** Ассоциативный набор объектов названий классов чекбоксов и их соответствий в виде Leaflet слоев с маркерами
 * (Необходимо для работы маркеров и лаконичности их вызова) **/
const LayerControls = {
    ScawsControl : Layers.Scaws,
    ChvkControl : Layers.Chvk,
    KeysControl : Layers.Keys,
    ChkafControl : Layers.Chkaf
};

/** Подключаем хэш в url для учета текущего зума и центра координат пользователя **/
let hash = new L.Hash(Map);

/** Устанавливаем масимальный зум карты - 4 **/
Map.setMaxZoom(4);

/** Устанавливаем минимальный зум карты - 4 **/
Map.setMinZoom(1);

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
            '<div class="form-control"><input type="radio" id="FirstMap" class="map-layers-control" name="map-group" checked>Основная версия карты</div>' +
            '<div class="form-control"><input type="radio" id="SecondMap" class="map-layers-control" name="map-group">Доп. версия карты</div>' +
            '<div class="leaflet-control-layers-separator"></div>' +
            '<div class="form-control map-layers"><input id="ids-control" class="ScawsControl" type="checkbox"/>Спавны Диких</div>' +
            '<div class="form-control map-layers"><input id="ids-control" class="ChvkControl" type="checkbox"/>Спавн ЧВК</div>' +
            '<div class="form-control map-layers"><input id="ids-control" class="KeysControl" type="checkbox"/>Отпираемые двери</div>' +
            '<div class="form-control map-layers"><input id="ids-control" class="ChkafControl" type="checkbox"/>Выдвижные ящики</div>' +
            '<div class="leaflet-control-layers-separator"></div>' +
            '<div class="form-control map-layers"><input id="ids-show-all" class="MainControls" type="checkbox"/>Показать все маркеры</div>' +
            '<div class="form-control map-layers"><input id="ids-hide-all" class="MainControls" type="checkbox"/>Скрыть все маркеры</div>' +
            '</div>';

        /** Возвращаем конечный Html результат */
        return div;
    }
});

/** Добавляем на карту интерактивные элементы */
Map.addControl(new MainControl());

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
        Map.addLayer(LayerControls[_className]);
    } else {
        Map.removeLayer(LayerControls[_className]);
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
                    Map.addLayer(Layers[i]);
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
                    Map.removeLayer(Layers[i]);
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

/**
 * Функция обработчика изменения состояния радиокнопок
 * Если в перспективе будет идея пихать несколько слоев карт в 1 страницу, это будет очень кстати
 *
 * @param Data - Объект this, с которым произошло событие
 */
function radioHandleControl(Data) {

    /** Переменная с ID радиокнопки, который кликнули */
    let id = $(Data).attr('id');

    /** В свитче смотрим, какой id сюда пришел */
    switch (id) {

        /** Пришел id основного слоя карты */
        case Selectors.radioMainMap:

            /** Удаляем слой вспомогательной интерактивной карты */
            Map.removeLayer(AlternativeTileLayers);

            /** Устанавливаем базовый слой карты */
            Map.addLayer(baseTileLayer);

            /** Показываем все чекбосы слоев на конкретной карте */
            $(Selectors.allMapCheckboxes).fadeIn();

            /** Показываем чекбокс - показать все слои */
            $(Selectors.showLayers).fadeIn();

            /** Показываем чекбокс - скрыть все слои */
            $(Selectors.hideLayers).fadeIn();

            /** Убираем checked с другого чекбокса */
            $(Selectors.body + ' ' + '#' +  Selectors.radioSecondMap).val('off');

            /** Прерываем цикл */
            break;

        /** Пришел id вспомогательного слоя карты */
        case Selectors.radioSecondMap:

            /** В цикле выключаем все слои маркеров на карте */
            $.each(Layers, function(i) {
                Map.removeLayer(Layers[i]);
            });

            /** Удаляем базовый слой карты */
            Map.removeLayer(baseTileLayer);

            /** Добавляем альтернативную карту локации */
            Map.addLayer(AlternativeTileLayers);

            /** Убираем все чекбоксы слоев с карты */
            $(Selectors.allMapCheckboxes).fadeOut();

            /** Скрываем чекбокс - показать все слои */
            $(Selectors.showLayers).fadeOut();

            /** Скрываем чекбокс - скрыть все слои */
            $(Selectors.hideLayers).fadeOut();

            /** Убираем checked с другого чекбокса */
            $(Selectors.body + ' ' + '#' + Selectors.radioMainMap).val('off');

            /** Удаляем атрибут checked - основному радиобаттону карты */
            $(Selectors.body + ' ' + '#' + Selectors.radioMainMap).removeAttr('checked');

            /** Проставляем всем чекбоксам слоев атрибут checked - false */
            disableMapCheckboxes(true);

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

/** Получаем текщие координаты по местонахождению мышки - функция **/
function onMouseMove(e) {
    $('#mapCoords').text((e.latlng.lat).toFixed(3) + ", " + (e.latlng.lng).toFixed(3));
}

/** Добавление отслеживания движения мышки по карте **/
Map.on('mousemove', onMouseMove);

/** Добавляем слушатель событий изменения чекбоксов слоев Leaflet */
$(Selectors.body).on('click', '#ids-control', function() {

    /** Вызываем обработчик события и передаем в него this - для дальнейшей работы */
    LayershandleControl(this);
});

/** Добавляем слушатель событий изменения базовых чекбоксов Leaflet */
$(Selectors.body).on('click', '#ids-show-all, #ids-hide-all', function() {

    /** Вызываем обработчик события и передаем в него this - для дальнейшей работы */
    MainhandleControl(this);
});

/** Добавляем слушатель событий изменения выбранной радиокнопки */
$(Selectors.body).on('click', Selectors.radioLayersMaps, function() {

    /** Вызываем обработчик события и передаем в него this - для дальнейшей работы */
    radioHandleControl(this);
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

/** Добавляем в слои карты Маркеры (Данные в хардкоде, в перспективе перенос на Бэкэнд) */
L.marker([43.299, -18.457], {icon: Icons.ScawsIcon}).bindPopup('Спавн диких').openPopup().addTo(Layers.Scaws);
L.marker([28.179, -70.664], {icon: Icons.ScawsIcon}).bindPopup('Спавн диких').openPopup().addTo(Layers.Scaws);
L.marker([68.986, -36.914], {icon: Icons.ScawsIcon}).bindPopup('Спавн диких').openPopup().addTo(Layers.Scaws);
L.marker([21.811, 33.047], {icon: Icons.ScawsIcon}).bindPopup('Спавн диких').openPopup().addTo(Layers.Scaws);
L.marker([34.479, -127.266], {icon: Icons.ScawsIcon}).bindPopup('Спавн диких').openPopup().addTo(Layers.Scaws);

/** Добавляем ЧВК маркеры в группы (Данные в хардкоде, в перспективе перенос на Бэкэнд) */
L.marker([69.936, 50.273], {icon: Icons.ChvkIcon}).bindPopup('Спавн ЧВК').openPopup().addTo(Layers.Chvk);
L.marker([78.581, -62.402], {icon: Icons.ChvkIcon}).bindPopup('Спавн ЧВК').openPopup().addTo(Layers.Chvk);
L.marker([72.586, -104.590], {icon: Icons.ChvkIcon}).bindPopup('Спавн ЧВК в кинотеатре Родина').openPopup().addTo(Layers.Chvk);
L.marker([67.529, -141.592], {icon: Icons.ChvkIcon}).bindPopup('Спавн ЧВК').openPopup().addTo(Layers.Chvk);
L.marker([61.211, -121.553], {icon: Icons.ChvkIcon}).bindPopup('Спавн ЧВК').openPopup().addTo(Layers.Chvk);
L.marker([32.739, 1.758], {icon: Icons.ChvkIcon}).bindPopup('Спавн ЧВК в отеле').openPopup().addTo(Layers.Chvk);
L.marker([42.241, 12.480], {icon: Icons.ChvkIcon}).bindPopup('Спавн ЧВК').openPopup().addTo(Layers.Chvk);
L.marker([17.073, -81.387], {icon: Icons.ChvkIcon}).bindPopup('Спавн ЧВК').openPopup().addTo(Layers.Chvk);

/** Добавляем маркеры дверей, открываемых ключами (Данные в хардкоде, в перспективе перенос на Бэкэнд) */
L.marker([72.675, 37.266], {icon: Icons.KeysIcon}).bindPopup('Нужен ключ от Комнаты охраны Concordia').openPopup().addTo(Layers.Keys);
L.marker([71.005, 50.361], {icon: Icons.KeysIcon}).bindPopup('Нужен ключ от комнаты квартиры Concordia 34 (3 этаж)').openPopup().addTo(Layers.Keys);
L.marker([71.374, 50.273], {icon: Icons.KeysIcon}).bindPopup('Нужен ключ от квартиры 64 в Concordia').openPopup().addTo(Layers.Keys);
L.marker([63.415, 24.346], {icon: Icons.KeysIcon}).bindPopup('Нужен ключ от времянки на стройке').openPopup().addTo(Layers.Keys);
L.marker([49.014, -12.920], {icon: Icons.KeysIcon}).bindPopup('Нужен ключ от железной решетки (3 этаж)').openPopup().addTo(Layers.Keys);
L.marker([49.758, -108.369], {icon: Icons.KeysIcon}).bindPopup('Нужен Ключ от малого кабинета в финучреждении (2 этаж)').openPopup().addTo(Layers.Keys);

/** Добавляем маркеры выдвижных шкафов */
L.marker([42.462, -43.506], {icon: Icons.ChkafIcon}).bindPopup('Выдвижной ящик, расположенный на улице').openPopup().addTo(Layers.Chkaf);

/** События по Document Ready */
$(document).ready(function() {

    /** Делаем бэкграунд черным **/
    $(Selectors.body).css({'background':'black'});

    /** Отключаем на минимальном зуме кнопку минуса **/
    $('a.leaflet-control-zoom-out').addClass('leaflet-disabled');

    /** Возвращаем пользователя к центру карты, если он кликнул на кнопку **/
    $(Selectors.body).on('click','.mapcenter', function(){
        Map.panTo(new L.LatLng(53, -8));
    });
});