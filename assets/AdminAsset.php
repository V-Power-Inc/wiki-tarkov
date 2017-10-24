<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 24.10.2017
 * Time: 15:08
 */

namespace app\assets;

use yii\web\AssetBundle;

class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    //    'css/owl-css/owl.carousel.css',
    //    'css/owl-css/owl.theme.default.min.css',
        'css/font-awesome/font-awesome.min.css',
        'css/custom.css',
        'css/media-queryes.css'
    ];
    public $js = [
        'js/bootstrap-js/bootstrap.min.js',
     //   'js/main.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}