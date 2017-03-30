<?php

namespace Lenvendo\Canvas\Controller;

use Lenvendo\Canvas\Service\ImageRepository\ImageRepository;
use yii\helpers\Url;
use yii\web\UnauthorizedHttpException;

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
        $imageSchema = $this->getParameter('data');

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
        return $this->render(
            'image/image.html.twig',
            [
                'isNewImage'    => true,
                'imagesListUrl' => Url::to(['default/index']),
            ]
        );
    }

    public function actionView(string $id): string
    {
        /** @var ImageRepository $imageRepository */
        $imageRepository = $this->getService('imageRepository');
        $image = $imageRepository->getImageSchemaById($id);

        return $this->render(
            'image/image.html.twig',
            [
                'imagesListUrl' => Url::to(['default/index']),
                'imageId'       => $id,
                'scheme'        => $image->getScheme(),
                'isNewImage'    => false,
            ]
        );
    }

    public function actionCheck(): string
    {
        $id = $this->getParameter('id');
        $password = $this->getParameter('password');

        if (!$id || !$password) {
        	throw new UnauthorizedHttpException();
        }

        /** @var ImageRepository $imageRepository */
        $imageRepository = $this->getService('imageRepository');
        $image = $imageRepository->getImageSchemaById($id);

        if ($password != $image->getPassword()) {
        	throw new UnauthorizedHttpException();
        }

        $result = [
            'id'       => $image->getId(),
            'password' => $image->getPassword(),
        ];

        return $this->respondJson($result);
    }
}
