<?php

namespace Lenvendo\Canvas\Controller;

class DefaultController extends AbstractController
{

    public function actionIndex(): string
    {
        return $this->render('index');
    }

    public function actionPost(): string
    {
        $result = [
            'id' => mt_rand(0, 1000),
            'code' => md5(mt_rand(0, 1000)),
        ];

        return $this->respondJson($result);
    }
}
