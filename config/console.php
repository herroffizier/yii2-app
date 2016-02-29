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
        'urlManager' => [
            'baseUrl' => WEB_ALIAS,
            'hostInfo' => WEB_HOST_PROTOCOL.WEB_HOST_SUFFIX,
        ],
    ],
];

$config = \yii\helpers\ArrayHelper::merge(require __DIR__.'/common.php', $config);

return $config;
