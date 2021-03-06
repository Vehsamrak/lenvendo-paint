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

        $allImageIds = $imageRepository->getAllImageIds();

        foreach ($allImageIds as $imageId) {
            $parameters['images'][$imageId] = [
                'id'          => $imageId,
                'imageUrl'    => sprintf('%s/%s', Url::to(['image/view']), $imageId),
                'imageScheme' => $imageRepository->getImageById($imageId)->getScheme(),
            ];
        }

        return $this->render('default/index.html.twig', $parameters);
    }
}
