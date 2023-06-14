<?php


namespace frontend\assets;


use yii\web\AssetBundle;

class HomeAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css
        = [
            'plugins/slick-1.8.0/slick.css',
            'css/main_styles.css',
            'css/responsive.css',

        ];
    public $js
        = [
            'plugins/slick-1.8.0/slick.js',
            'js/custom.js',


        ];

    public $depends
        = [
            'frontend\assets\MainAsset',
        ];
}