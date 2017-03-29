<?php

namespace Lenvendo\Canvas\Controller;

use Lenvendo\Canvas\ImageRepository\ImageRepository;
use yii\helpers\Url;

class DefaultController extends AbstractController
{

    public function actionIndex(): string
    {
        $images = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13];

        $parameters = [
            'createImageUrl' => Url::to(['image/create']),
        ];
        foreach ($images as $imageId) {
            $parameters['imageUrl'][] = sprintf('%s/%s', Url::to(['image/show']), $imageId);
        }

        return $this->render('index', $parameters);
    }

    public function actionPost(): string
    {
        $result = [
            'id'   => mt_rand(0, 1000),
            'code' => md5(mt_rand(0, 1000)),
        ];

        /** @var ImageRepository $imageRepository */
        $imageRepository = $this->getService('imageRepository');
        $image = $imageRepository->saveImageSchema(json_encode($result));

        return $this->respondJson($result);
    }
}
