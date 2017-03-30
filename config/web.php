<?php

use Lenvendo\Canvas\Controller\DefaultController;
use Lenvendo\Canvas\Controller\ErrorController;
use Lenvendo\Canvas\Controller\ImageController;
use Lenvendo\Canvas\Service\IdGenerator\IdGenerator;
use Lenvendo\Canvas\Service\ImageRepository\FileImageRepository;
use Lenvendo\Canvas\Service\ImageRepository\ImageScheme\ImageSchemeFactory;
use Lenvendo\Canvas\Service\Twig\Twig;

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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => require(__DIR__ . '/routes.php'),
        ],
        'imageRepository' => [
            'class' => FileImageRepository::class
        ],
        'idGenerator' => [
            'class' => IdGenerator::class
        ],
        'twig' => [
            'class' => Twig::class
        ],
        'imageSchemeFactory' => [
            'class' => ImageSchemeFactory::class
        ],
    ],
    'params' => require(__DIR__ . '/params.php'),
    'controllerMap' => [
        'error' => ErrorController::class,
        'default' => DefaultController::class,
        'image' => ImageController::class,
    ],
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];
}

return $config;
