<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 *
 * TODO: dark-theme должна подключаться JS'ом и должна быть возможность менять темы сайта по нажатию специальных иконок темная/светлая
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.min.css',
        'css/site.css',
        'css/owl-css/owl.carousel.css',
        'css/owl-css/owl.theme.default.min.css',
        'css/font-awesome/font-awesome.min.css',
        'css/popup/magnific-popup.css',
        ['css/custom.css', 'id' => 'custom_site_styles'],
    ];
    public $js = [
        'js/bootstrap-js/bootstrap.min.js',
        'js/popup/magnific-popup.js',
        'js/jquery.cookie.js',
        'js/main.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
