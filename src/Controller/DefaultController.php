<?php

namespace Lenvendo\Canvas\Controller;

class DefaultController extends AbstractController
{

    protected function getControllerName(): string
    {
        return 'site';
    }

    public function actionIndex(): string
    {
        return $this->render('index');
    }
}
