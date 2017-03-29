<?php

use Lenvendo\Canvas\Controller\DefaultController;
use Lenvendo\Canvas\Controller\ErrorController;

$config = [
    'id' => 'basic',
    'basePath' => SRC_DIRECTORY,
    'runtimePath' => RUNTIME_DIRECTORY,
    'viewPath' => VIEW_DIRECTORY,
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            'cookieValidationKey' => '5ZchfBZI_UeSwn_VHGxtqUh7tjniVT0x',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'error/index',
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => require(__DIR__ . '/routes.php'),
        ],
        'imageRepository' => [
            'class' => \Lenvendo\Canvas\ImageRepository\FileImageRepository::class
        ],
        'idGenerator' => [
            'class' => \Lenvendo\Canvas\IdGenerator\IdGenerator::class
        ],
    ],
    'params' => require(__DIR__ . '/params.php'),
    'controllerMap' => [
        'default' => DefaultController::class,
        'error' => ErrorController::class
    ],
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];
}

return $config;
