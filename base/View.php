<?php

namespace app\base;

use Yii;
use yii\web\View as YiiView;

class View extends YiiView
{
    public $h1;

    protected function addMetaTag($name, $content)
    {
        if (Yii::$app->request->isAjax) {
            return;
        }

        $this->registerMetaTag(['name' => $name, 'content' => $content,], $name);
    }

    public function setKeywords($value)
    {
        $this->addMetaTag('keywords', $value);
    }

    public function setDescription($value)
    {
        $this->addMetaTag('description', $value);
    }
}
