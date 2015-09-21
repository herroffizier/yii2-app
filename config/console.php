<?php

// @codingStandardsIgnoreFile

Yii::setAlias('@tests', dirname(__DIR__).'/tests');
Yii::setAlias('@webroot', dirname(__DIR__).'/web/');
Yii::setAlias('@web', WEB_ALIAS);

$config = [
    'id' => 'PROJECT-NAME',
    'controllerNamespace' => 'app\commands',
    'modules' => [
        'gii' => 'yii\gii\Module',
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\MemCache',
        ],
        'log' => [
        ],
        'uploads' => [
            'class' => 'app\components\UploadManager',
            'uploadDir' => '@app/web/upload',
        ],
        'urlManager' => [
            'baseUrl' => WEB_ALIAS,
            'hostInfo' => WEB_HOST,
        ],
    ],
];

$config = \yii\helpers\ArrayHelper::merge(require __DIR__.'/common.php', $config);

return $config;
