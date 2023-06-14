<?php


namespace frontend\assets;


use yii\web\AssetBundle;

class ProductAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css
        = [
            'css/product_styles.css',
            'css/product_responsive.css',
        ];
    public $js
        = [
            'js/product_custom.js',

        ];

    public $depends
        = [
            'frontend\assets\MainAsset',
        ];
}