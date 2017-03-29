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

        $imageSchema = \Yii::$app->request->post('data');

        $image = $imageRepository->saveImageSchema($imageSchema);

        $result = [
            'id'       => $image->getId(),
            'password' => $image->getPassword(),
        ];

        return $this->respondJson($result);
    }

    public function actionCreate(): string
    {
        return $this->render('image/create.html.twig', ['imagesListUrl' => Url::to(['default/index'])]);
    }
}
