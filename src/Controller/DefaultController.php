<?php

namespace Lenvendo\Canvas\Controller;

use Lenvendo\Canvas\Service\ImageRepository\ImageRepository;
use yii\helpers\Url;

class DefaultController extends AbstractController
{

    public function actionIndex(): string
    {
        /** @var ImageRepository $imageRepository */
        $imageRepository = $this->getService('imageRepository');

        $parameters = [
            'createImageUrl' => Url::to(['image/create']),
        ];

        $allImageIds = $imageRepository->getAllImageSchemeIds();

        foreach ($allImageIds as $imageId) {
            $parameters['imageUrls'][] = sprintf('%s/%s', Url::to(['image/show']), $imageId);
        }

        return $this->render('default/index.html.twig', $parameters);
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
}
