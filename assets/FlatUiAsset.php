<?php

namespace app\assets;

use yii\web\AssetBundle;

class FlatUiAsset extends AssetBundle
{
    public $sourcePath = '@bower/flat-ui/dist';
    public $css = [
        'css/flat-ui.min.css',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
