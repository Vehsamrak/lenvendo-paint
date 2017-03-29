<?php

namespace Lenvendo\Canvas\Controller;

use Lenvendo\Canvas\Service\ImageRepository\ImageRepository;

/**
 * @author Vehsamrak
 */
class ImageController extends AbstractController
{

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
