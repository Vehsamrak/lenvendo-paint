<?php

namespace Lenvendo\Canvas\Controller;

use yii\web\Controller;

abstract class AbstractController extends Controller
{

    public function getViewPath(): string
    {
        return VIEW_DIRECTORY . DIRECTORY_SEPARATOR . static::getControllerName();
    }

    abstract protected function getControllerName(): string;
}
