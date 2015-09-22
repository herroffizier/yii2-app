<?php

namespace app\controllers\frontoffice;

class PageController extends FrontOfficeController
{
    public function actionIndex($page)
    {
        return $this->render('index', compact('page'));
    }
}
