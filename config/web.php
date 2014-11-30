<?php
$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => 'product/index',
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'register'      => 'user/new',
                'GET login'     => 'session/new',
                'POST login'    => 'session/create',
                'DELETE logout' => 'session/delete',
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'product',
                    'extraPatterns' => [
                        'GET my' => 'my',
                        'GET <id>/edit' => 'edit',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'user',
                    'except' => ['index', 'delete'],
                    'extraPatterns' => [
                        'GET <id>/edit' => 'edit'
                    ],
                ],
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '1234',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'cleveroad.test@gmail.com',
                'password' => 'cleveroadsmtp',
                'port' => '465',
                'encryption' => 'ssl',
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
    ],
    'modules' => [
        'yii2images' => [
            'class' => 'rico\yii2images\Module',
            //be sure, that permissions ok
            //if you cant avoid permission errors you have to create "images" folder in web root manually and set 777 permissions
            'imagesStorePath' => '@webroot/images/store', //path to origin images
            'imagesCachePath' => '@webroot/images/cache', //path to resized copies
            'graphicsLibrary' => 'Imagick', //but really its better to use 'Imagick'
        ],
    ],

    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
