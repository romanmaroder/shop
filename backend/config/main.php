<?php

use yii\log\FileTarget;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id'                  => 'app-backend',
    'name'                => 'ADMIN PANEL',
    'basePath'            => dirname(__DIR__),
    'aliases'             => [

        '@staticRoot' => $params['staticPath'],
        '@static'     => $params['staticHostInfo'],
    ],
    'controllerNamespace' => 'backend\controllers',
    'bootstrap'           => ['log'],
    'modules'             => [],
    'components'          => [
        'request'      => [
            'baseUrl'             => '/admin',
            'csrfParam'           => '_csrf-backend',
            'cookieValidationKey' => $params['cookieValidationKey']
        ],
        'user'         => [
            'identityClass'   => 'core\entities\user\User',
            'enableAutoLogin' => true,
            'loginUrl'        => ['auth/login'],
            'identityCookie'  => [
                'name'     => '_identity',
                'httpOnly' => true,
                'domain'   => $params['cookieDomain']
            ],
        ],
        'session'      => [
            // this is the name of the session cookie used for login on the backend
            'name'         => '_session',
            'cookieParams' => [
                'domain'   => $params['cookieDomain'],
                'httpOnly' => true,

            ]
        ],
        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'backendUrlManager'  => require __DIR__ . '/urlManager.php',
        'frontendUrlManager' => require __DIR__ . '/../../frontend/config/urlManager.php',
        'urlManager'         => function () {
            return Yii::$app->get('backendUrlManager');
        },

    ],
    'as access'           => [
        'class'  => 'yii\filters\AccessControl',
        'except' => ['auth/login', 'site/error'],
        'rules'  => [
            [
                'allow' => true,
                'roles' => ['@']
            ]

        ]
    ],
    'params'              => $params,
];
