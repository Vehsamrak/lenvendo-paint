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
        $imageSchema = \Yii::$app->request->post('data');

        /** @var ImageRepository $imageRepository */
        $imageRepository = $this->getService('imageRepository');
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

    public function actionView(string $id): string
    {
        /** @var ImageRepository $imageRepository */
        $imageRepository = $this->getService('imageRepository');
        $imageScheme = $imageRepository->getImageSchemaById($id);

        return $this->render(
            'image/create.html.twig',
            [
                'imagesListUrl' => Url::to(['default/index']),
                'imageId'       => $id,
                'scheme'        => $imageScheme,
            ]
        );
    }
}
