<?php

namespace app\base;

use yii\filters\AccessControl;

class BackOfficeController extends Controller
{
    public $layout = 'backoffice';

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => [$this->id],
                    ],
                ],
            ],
        ]);
    }
}
