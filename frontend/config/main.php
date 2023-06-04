<?php

use yii\log\FileTarget;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id'                  => 'app-frontend',
    'name'                => 'OneTech',
    'basePath'            => dirname(__DIR__),
    'bootstrap'           => ['log'],
    'aliases'             => [
        '@staticRoot' => $params['staticPath'],
        '@static'     => $params['staticHostInfo'],
    ],
    'controllerNamespace' => 'frontend\controllers',
    'components'          => [
        'request'      => [
            'baseUrl'             => '',
            'csrfParam'           => '_csrf-frontend',
            'cookieValidationKey' => $params['cookieValidationKey']
        ],
        'user'         => [
            'identityClass'   => 'core\entities\user\User',
            'enableAutoLogin' => true,
            'loginUrl'        => ['auth/auth/login'],
            'identityCookie'  => [
                'name'     => '_identity',
                'httpOnly' => true,
                'domain'   => $params['cookieDomain']
            ],
        ],
        'session'      => [
            // this is the name of the session cookie used for login on the frontend
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

        'frontendUrlManager' => require __DIR__ . '/urlManager.php',
        'backendUrlManager'  => require __DIR__ . '/../../backend/config/urlManager.php',
        'urlManager'         => function () {
            return Yii::$app->get('frontendUrlManager');
        },

    ],
    'params'              => $params,
];
