<?php

namespace Lenvendo\Canvas\Controller;

class ErrorController extends AbstractController
{

    protected function getControllerName(): string
    {
        return 'error';
    }

    /** @inheritdoc */
    public function actions()
    {
        return [
            'index' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
}
