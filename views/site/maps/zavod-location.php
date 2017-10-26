<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 26.10.2017
 * Time: 15:05
 */
$this->registerCssFile("css/leaflet.css", ['depends' => ['app\assets\AppAsset']]);
$this->registerJsFile('js/leaflet.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->title = 'Карта локации Завод в Escape from Tarkov - интерактивная карта Завода с просмотром ключей от помещений';
?>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<div class="heading-class">
    <div class="container">
        <h1 class="main-site-heading">Карта локации завод</h1>
    </div>
</div>

<!-- Контент в правой колонке - справа от интерактивной карты -->
<div class="right__content">
    <div class="col-lg-12">
        <h2 class="white">Информация о ключах</h2>
        <p></p>
    </div>
</div>


<style type="text/css">
    #map { position: absolute; width: 100%;     left: 0;  top: 182px;  bottom: 60px;  right: 800px; z-index:1;}
    #slider { position: absolute; top: 10px; right: 10px; }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ol3/3.8.2/ol.min.css" type="text/css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/ol3/3.8.2/ol.min.js" type="text/javascript"></script>
</head>
<body>
<div id="map"></div>
<input id="slider" type="range" min="0" max="1" step="0.1" value="1" oninput="layer.setOpacity(this.value)">
<script type="text/javascript">
    var mapExtent = [0.00000000, -2032.00000000, 2890.00000000, 0.00000000];
    var mapMinZoom = 2;
    var mapMaxZoom = 4;
    var mapMaxResolution = 1.00000000;
    var tileExtent = [0.00000000, -2032.00000000, 2890.00000000, 0.00000000];

    var mapResolutions = [];
    for (var z = 0; z <= mapMaxZoom; z++) {
        mapResolutions.push(Math.pow(2, mapMaxZoom - z) * mapMaxResolution);
    }

    var mapTileGrid = new ol.tilegrid.TileGrid({
        extent: tileExtent,
        minZoom: mapMinZoom,
        resolutions: mapResolutions
    });

    var layer = new ol.layer.Tile({
        source: new ol.source.XYZ({
            projection: 'PIXELS',
            tileGrid: mapTileGrid,
            url: "/img/zavod/{z}/{x}/{y}.png"
        })
    });

    var map = new ol.Map({
        target: 'map',
        layers: [
            layer,
        ],
        view: new ol.View({
            projection: ol.proj.get('PIXELS'),
            extent: mapExtent,
            maxResolution: mapTileGrid.getResolution(mapMinZoom)
        })
    });
    map.getView().fit(mapExtent, map.getSize());
</script>
<div class="containter">
    
</div>