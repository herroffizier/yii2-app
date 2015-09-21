<?php

namespace app\controllers;

use app\base\FrontOfficeController;

class PageController extends FrontOfficeController
{
    public function actionIndex($page)
    {
        return $this->render('index', compact('page'));
    }
}
