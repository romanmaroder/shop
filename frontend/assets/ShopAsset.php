<?php


namespace frontend\assets;


use yii\web\AssetBundle;

class ShopAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css
        = [
            'plugins/jquery-ui-1.12.1.custom/jquery-ui.css',
            'css/shop_styles.css',
            'css/shop_responsive.css',
        ];
    public $js
        = [
            'plugins/Isotope/isotope.pkgd.min.js',
            'plugins/jquery-ui-1.12.1.custom/jquery-ui.js',
            'plugins/parallax-js-master/parallax.min.js',
            'js/shop_custom.js',

        ];

    public $depends
        = [
            'frontend\assets\MainAsset',
        ];
}