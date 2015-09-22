<?php

namespace app\controllers\frontoffice;

use Yii;
use app\base\FrontOfficeController;

class SiteController extends FrontOfficeController
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}
