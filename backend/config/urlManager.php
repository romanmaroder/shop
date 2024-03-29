<?php

/** @var  $params */

return
    [
        'class'           => 'yii\web\UrlManager',
        'hostInfo'        => $params['backendHostInfo'],
        'enablePrettyUrl' => true,
        'showScriptName'  => false,
        'rules'           => [
            '' => 'site/index',

            '<_a:login|logout>' => 'auth/<_a>',


            '<_c:[\w\-]+>'                       => '<_c>/index',
            '<_c:[\w\-]+>/<id:\d+>'              => '<_c>/view',
            '<_c:[\w\-]+>/<_a:[\w-]+>/<id:\d+>'  => '<_c>/<_a>',
            '<_c:[\w\-]+>/<_a:[\w-]+>'           => '<_c>/<_a>',
            '<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => '<_c>/<_a>',
        ],
    ];
