<?php

// @codingStandardsIgnoreFile

return [
        'backoffice' => 'backoffice/dashboard/index',
        'backoffice/<controller:[\w\-_]+>/page/<page:\d+>' => 'backoffice/<controller>/index',
        'backoffice/<controller:[\w\-_]+>' => 'backoffice/<controller>/index',
        'backoffice/<controller:[\w\-_]+>/<action:[\w\-_]+>/<id:\d+>' => 'backoffice/<controller>/<action>',
        'backoffice/<controller:[\w\-_]+>/<action:[\w\-_]+>' => 'backoffice/<controller>/<action>',

        '<page:about>' => 'page/index',

        '/' => 'site/index',

        '<action:login|logout>' => 'auth/<action>',

        '<controller:[\w\-_]+>' => '<controller>/index',
        '<controller:[\w\-_]+>/<action:[\w\-_]+>' => '<controller>/<action>',
];
