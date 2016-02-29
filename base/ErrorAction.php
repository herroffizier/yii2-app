<?php

namespace app\base;

use Yii;
use yii\web\HttpException;
use yii\base\Action;

class ErrorAction extends Action
{
    public $view;

    public function run()
    {
        if (($exception = Yii::$app->getErrorHandler()->exception) === null) {
            $exception = new HttpException(404, Yii::t('yii', 'Page not found.'));
        }

        $isHttpError = $exception instanceof HttpException;

        $statusCode = $isHttpError ? $exception->statusCode : 500;
        switch ($statusCode) {
            case 403:
                $name = 'Доступ запрещён';
                $message = 'Доступ к этой странице запрещён.';
                break;

            case 404:
                $name = 'Не найдено';
                $message = 'Страница не найдена.';
                break;

            default:
                $name = 'Внутренняя ошибка';
                $message = 'Произошла внутренняя ошибка.';
                break;
        }

        if (Yii::$app->getRequest()->getIsAjax()) {
            return "$name: $message";
        } else {
            return $this->controller->render($this->view ?: $this->id, [
                'statusCode' => $statusCode,
                'name' => $name,
                'message' => $message,
                'exception' => $exception,
            ]);
        }
    }
}
