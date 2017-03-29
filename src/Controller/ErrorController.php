<?php

namespace Lenvendo\Canvas\Controller;

use yii\web\NotFoundHttpException;

class ErrorController extends AbstractController
{

    public function actionIndex(): string
    {
        $exception = $this->getException();

        return $this->render(
            'error/error.html.twig',
            [
                'name' => $exception->getName(),
                'code' => $exception->statusCode,
                'message' => $exception->getMessage(),
            ]
        );
    }

    protected function getException()
    {
        if (($exception = \Yii::$app->getErrorHandler()->exception) === null) {
            $exception = new NotFoundHttpException('Page not found.');
        }

        return $exception;
    }
}
