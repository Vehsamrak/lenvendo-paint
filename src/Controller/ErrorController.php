<?php

namespace Lenvendo\Canvas\Controller;

class ErrorController extends AbstractController
{

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
