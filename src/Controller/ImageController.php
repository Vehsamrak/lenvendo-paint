<?php

namespace Lenvendo\Canvas\Controller;

use Lenvendo\Canvas\Service\ImageRepository\ImageRepository;
use yii\helpers\Url;

/**
 * @author Vehsamrak
 */
class ImageController extends AbstractController
{

    /** {@inheritDoc} */
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionPost(): string
    {
        /** @var ImageRepository $imageRepository */
        $imageRepository = $this->getService('imageRepository');

        $result = [
            'id'   => mt_rand(0, 1000),
            'code' => md5(mt_rand(0, 1000)),
        ];

        $image = $imageRepository->saveImageSchema(json_encode($result));

        return $this->respondJson($result);
    }

    public function actionCreate(): string
    {
        return $this->render('image/create.html.twig', ['imagesListUrl' => Url::to(['default/index'])]);
    }
}
