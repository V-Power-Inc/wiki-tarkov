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
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css?v=6.5.24',
        'css/owl-css/owl.carousel.css',
        'css/owl-css/owl.theme.default.min.css',
        'css/font-awesome/font-awesome.min.css',
        'css/popup/magnific-popup.css',
        ['css/custom.css?v=6.5.24', 'id' => 'custom_site_styles'],
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
