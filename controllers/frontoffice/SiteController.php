<?php

namespace app\controllers\frontoffice;

use app\base\FrontOfficeController;

class SiteController extends FrontOfficeController
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'app\base\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}
