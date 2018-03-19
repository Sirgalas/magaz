<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap-theme.min.css',
        'css/font-awesome.min.css',
        'css/normalize.css',
        'css/owl.carousel.min.css',
        'css/owl.theme.default.min.css',
        'css/owl.theme.green.min.css',
        'css/jquery.formstyler.css',
        'css/jquery.fancybox.css',
        'css/jquery.fancybox-thumbs.css',
        'css/styles.css',
    ];
    public $js = [
        'js/owl.carousel.min.js',
        'js/waypoints.js',
        'js/jquery.formstyler.min.js',
        'js/enquire.min.js',
        'js/bootstrap.min.js',
        'js/jquery.fancybox.pack.js',
        'js/jquery.fancybox-thumbs.js',
        'js/jquery.jcarousel.js',
        'js/jquery.jcarousel-control.min.js',
        'js/jquery.jcarousel-autoscroll.min.js',
        'js/jquery.jcarousel-pagination.min.js',
        'js/jquery.jcarousel-scrollintoview.min.js',
        'js/script.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\jui\JuiAsset',
    ];
}
