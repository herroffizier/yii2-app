<?php

// @codingStandardsIgnoreFile

$bundles = [];

$bundles = \yii\helpers\ArrayHelper::merge($bundles, [
    'yii\bootstrap\BootstrapPluginAsset' => [
        'sourcePath' => '@bower/flat-ui/dist',
        'js' => [
            'js/flat-ui.min.js',
        ],
    ],
]);

return $bundles;
