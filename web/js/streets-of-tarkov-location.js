/**
 * JS Обработчик карты - улицы Таркова
 * Добавляя новые маркеры и группы важно делать следующее:
 *
 * - Сетап иконки (Константа Icons)
 * - Сетап слоя (Константа Layers)
 * - Сетап чекбокса слоев (Константа LayerControls)
 *
 * todo: Сократить громоздкое объявление каждого типа новых UI Элементов (Чекбоксы)
 *
 * @link https://mourner.github.io/Leaflet/reference.html - Documentation LeafletJS
 */

/** Константа с селекторами, для работы с DOM */
const Selectors = {
    body: 'body'
};

/** Константа с опциями карты **/
const Map = L.map('map', {

    /** Положение центра карты */
    center: [67, -5],

    /** Максимально возможный зум карты */
    maxzoom: 4,

    /** Минимально возможный зум карты */
    minzoom: 1,

    /** Дефолтный зум карты */
    zoom: 1
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

/** Добавляем базовый слой интерактивной карты (С опцией - без повторения карты) **/
let baseTileLayer = L.tileLayer('/img/streets-of-tarkov/{z}/{x}/{y}.webp', {noWrap: true}).addTo(Map);

/** Добавляем чекбоксы слоев для Leaflet карты */
let MainControl = L.Control.extend({

    /** Опции положения элементов управления (Положение на карте) - todo: Чекнуть какие тут есть опции */
    options: {
        position: 'topright'
    },

    /** Обработчик события при добавлении на карту */
    onAdd: function () {

        /** Создание необходимых HTML блоков */
        let div = L.DomUtil.create('div', 'leaflet-control-layers');

        /** Создание необходимых Checkbox блоков - в теле Leaflet */
        div.innerHTML = '<div class="form-control"><input id="ids-control" class="ScawsControl" type="checkbox"/>Спавны Диких</div>' +
                        '<div class="form-control"><input id="ids-control" class="ChvkControl" type="checkbox"/>Спавн ЧВК</div>' +
                        '<div class="form-control"><input id="ids-control" class="KeysControl" type="checkbox"/>Двери, отпираемые ключами</div>' +
                        '<div class="form-control"><input id="ids-control" class="ChkafControl" type="checkbox"/>Выдвижные ящики</div>';

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
function handleControl(Data) {

    /** Переменная с классом чекбокса, который кликнули */
    let _className = $(Data).attr('class');

    /** Если чекбокс выбран - делаем активным слой чекбокса, если нет, то отключаем его */
    if (Data.checked === true) {
        Map.addLayer(LayerControls[_className]);
    } else {
        Map.removeLayer(LayerControls[_className]);
    }
}

/** Добавляем слушатель событий изменения чекбоксов Leaflet */
$(Selectors.body).on('click', '#ids-control', function() {

    /** Вызываем обработчик события и передаем в него this - для дальнейшей работы */
    handleControl(this);
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








/** OLD CODE PART **/

/** Подключаем хэш в url для учета текущего зума и центра координат пользователя **/
let hash = new L.Hash(Map);

/** Устанавливаем зум карты на 2 также указываем что минимальный зум 0 а максимальный 2 **/
Map.setMaxZoom(4);
Map.setMinZoom(1);


/** Получаем текщие координаты по местонахождению мышки - функция **/
function onMouseMove(e) {
    $('#mapCoords').text((e.latlng.lat).toFixed(3) + ", " + (e.latlng.lng).toFixed(3));
}

/** Добавление отслеживания движения мышки по карте **/
Map.on('mousemove', onMouseMove);


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