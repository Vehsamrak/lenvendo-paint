<?php

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
const ROOT_DIRECTORY = __DIR__ . DIRECTORY_SEPARATOR . '..';
const SRC_DIRECTORY = ROOT_DIRECTORY . DIRECTORY_SEPARATOR . 'src';
const VIEW_DIRECTORY = SRC_DIRECTORY . DIRECTORY_SEPARATOR . 'Views';
const RUNTIME_DIRECTORY = ROOT_DIRECTORY . DIRECTORY_SEPARATOR . 'runtime';

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');

$application = new yii\web\Application($config);
$application->run();
