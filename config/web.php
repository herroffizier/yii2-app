<?php

// @codingStandardsIgnoreFile

$config = [
    'id' => 'PROJECT-NAME',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
        ],

        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['frontoffice/auth/login'],
        ],

        'errorHandler' => [
            'errorAction' => 'frontoffice/site/error',
        ],

        'assetManager' => [
            'appendTimestamp' => true,
            'linkAssets' => true,
            'bundles' => require __DIR__.'/assets.php',
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*'],
    ];
}

$config = \yii\helpers\ArrayHelper::merge(require __DIR__.'/common.php', $config);

return $config;
