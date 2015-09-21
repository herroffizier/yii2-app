<?php

namespace app\controllers\backoffice;

use app\base\BackOfficeController;

class DashboardController extends BackOfficeController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
