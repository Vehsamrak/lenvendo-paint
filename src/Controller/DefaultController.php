<?php

namespace Lenvendo\Canvas\Controller;

class DefaultController extends AbstractController
{

    public function actionIndex(): string
    {
        return $this->render('index');
    }
}
