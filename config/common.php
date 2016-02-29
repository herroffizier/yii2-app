<?php

// @codingStandardsIgnoreFile

return [
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru',
    'components' => [
        'log' => [
            'traceLevel' => 5,
            'targets' => [
                'file' => [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],

        'cache' => [
            'class' => YII_ENV === 'prod' ? 'yii\caching\MemCache' : 'yii\caching\DummyCache',
        ],

        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host='.DB_HOST.';dbname='.DB_NAME,
            'username' => DB_USER,
            'password' => DB_PASSWORD,
            'charset' => 'utf8',
            'enableSchemaCache' => YII_ENV === 'prod',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'suffix' => '/',
            'rules' => require __DIR__.'/rules.php',
        ],

        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],

        'formatter' => [
            'locale' => 'ru_RU',
            'numberFormatterOptions' => [
                NumberFormatter::FRACTION_DIGITS => 0,
            ],
        ],

        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
        ],
    ],

    'params' => [
        'adminEmail' => 'admin@example.com',
    ],
];
