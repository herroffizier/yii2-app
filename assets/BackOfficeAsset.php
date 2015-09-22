<?php

namespace app\assets;

use yii\web\AssetBundle;

class BackofficeAsset extends AssetBundle
{
    public $sourcePath = '@app/static/backoffice';
    public $css = [
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
