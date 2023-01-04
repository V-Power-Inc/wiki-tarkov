/**
 * JS Обработчик карты - улицы Таркова
 *
 * @link https://mourner.github.io/Leaflet/reference.html - Documentation LeafletJS
 */

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
    })
};

/** Константа с набором слоев для карты (Группы маркеров) */
const Layers = {

    /** Слой маркеров Диких */
    Scaws: L.layerGroup(),

    /** Слой маркеров спавнов ЧВК */
    Chvk: L.layerGroup()
};

/** Добавляем базовый слой интерактивной карты (С опцией - без повторения карты) **/
let baseTileLayer = L.tileLayer('/img/streets-of-tarkov/{z}/{x}/{y}.webp', {noWrap: true}).addTo(Map);

/** Добавляем чекбокс слоя с Дикими */
let ScawsControl = L.Control.extend({

    /** Опции чекбокса (Положение на карте) */
    options: {
        position: 'topright'
    },

    /** Обработчик события при добавлении на карту */
    onAdd: function () {

        /** Создание необходимых HTML блоков */
        let div = L.DomUtil.create('div', 'scaws-c');

        /** Создание необходимых HTML блоков */
        div.innerHTML = '<div class="form-control"><input id="ids-control" class="scaws-control" type="checkbox"/>Спавны Диких</div>';
        return div;
    }
});

/** Добавляем чекбокс слоя с ЧВК */
let ChvkControl = L.Control.extend({

    /** Опции чекбокса (Положение на карте) */
    options: {
        position: 'topright'
    },

    /** Обработчик события при добавлении на карту */
    onAdd: function () {

        /** Создание необходимых HTML блоков */
        let div = L.DomUtil.create('div', 'chvk-c');

        /** Создание необходимых HTML блоков */
        div.innerHTML = '<div class="form-control"><input id="ids-control" class="chvk-control" type="checkbox"/>Спавн ЧВК</div>';
        return div;
    }
});

/** Добавляем на карту интерактивные элементы */
Map.addControl(new ScawsControl());
Map.addControl(new ChvkControl());

/** Функция обработчика чекбокса со спавнами диких (Параметр сюда должен прилететь this */
function handleControl(Data) {

    /** В свитче отлавливаем класс чекбокса и в зависимости от состояния слоев, показываем их или нет */
    switch (Data.className) {
        case 'scaws-control':
            if (Data.checked === true) {
                Map.addLayer(Layers.Scaws)
            } else {
                Map.removeLayer(Layers.Scaws)
            }
            break;
        case 'chvk-control': {
            if (Data.checked === true) {
                Map.addLayer(Layers.Chvk)
            } else {
                Map.removeLayer(Layers.Chvk)
            }
            break;
        }
    }
}

/** Добавляем слушатель событий изменения чекбоксов Leaflet */
$('body').on('click', '#ids-control', function() {

    /** Вызываем обработчик события и передаем в него this - для дальнейшей работы */
    handleControl(this);
});

/** Добавляем в слои карты Маркеры (Потом это можно будет сделать нормально - когда данные в бекенд положим (Switch например */
L.marker([43.299, -18.457], {icon: Icons.ScawsIcon}).bindPopup('Спавн диких').openPopup().addTo(Layers.Scaws);
L.marker([28.179, -70.664], {icon: Icons.ScawsIcon}).bindPopup('Спавн диких').openPopup().addTo(Layers.Scaws);
L.marker([68.986, -36.914], {icon: Icons.ScawsIcon}).bindPopup('Спавн диких').openPopup().addTo(Layers.Scaws);
L.marker([21.811, 33.047], {icon: Icons.ScawsIcon}).bindPopup('Спавн диких').openPopup().addTo(Layers.Scaws);
L.marker([34.479, -127.266], {icon: Icons.ScawsIcon}).bindPopup('Спавн диких').openPopup().addTo(Layers.Scaws);

/** ЧВК тестовые Icons */
L.marker([3.020, -120.586], {icon: Icons.ChvkIcon}).bindPopup('Спавн ЧВК').openPopup().addTo(Layers.Chvk);
L.marker([-2.954, -10.547], {icon: Icons.ChvkIcon}).bindPopup('Спавн ЧВК').openPopup().addTo(Layers.Chvk);
L.marker([53.455, -27.070], {icon: Icons.ChvkIcon}).bindPopup('Спавн ЧВК').openPopup().addTo(Layers.Chvk);






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
    $('body').css({'background':'black'});

    /** Отключаем на минимальном зуме кнопку минуса **/
    $('a.leaflet-control-zoom-out').addClass('leaflet-disabled');

    /** Возвращаем пользователя к центру карты, если он кликнул на кнопку **/
    $('body').on('click','.mapcenter', function(){
        Map.panTo(new L.LatLng(53, -8));
    });
});