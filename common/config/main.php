<?php

return [
    'aliases'    => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'bootstrap'=>[
        'class'=>'common\bootstrap\SetUp',
    ],
    'components' => [
        'cache' => [
            #'class'     => \yii\caching\FileCache::class,
            #'cachePath' => '@common/runtime/cache',
            'class' => yii\caching\MemCache::class,
            'useMemcached' => true,
            /*'servers' => [
                [
                    'host' => '127.0.0.1',
                    'port' => 11211,
                    'weight' => 100,
                ],
            ],*/
        ],
    ],
];
