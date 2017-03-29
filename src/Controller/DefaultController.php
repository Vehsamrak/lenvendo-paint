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
}
