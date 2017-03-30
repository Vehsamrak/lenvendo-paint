<?php

namespace Lenvendo\Canvas\Service\ImageRepository;

use Lenvendo\Canvas\Service\ImageRepository\ImageScheme\ImageSchemeFactory;
use Lenvendo\Canvas\Service\ImageRepository\ImageScheme\Image as Image;
use yii\web\NotFoundHttpException;

/**
 * @author Vehsamrak
 */
class FileImageRepository implements ImageRepository
{

    /** @var ImageSchemeFactory */
    private $imageSchemeFactory;

    public function __construct(ImageSchemeFactory $imageSchemeFactory)
    {
        $this->imageSchemeFactory = $imageSchemeFactory;
    }

    public function getAllImageIds(): array
    {
        $allFiles = scandir($this->getImageSchemaDirectory());
        $unnecessaryFiles = ['.', '..', '.gitkeep'];

        foreach ($unnecessaryFiles as $unnecessaryFileKey => $unnecessaryFile) {
            if(($key = array_search($unnecessaryFile, $allFiles)) !== false) {
                unset($allFiles[$key]);
            }
        }

        return array_values($allFiles);
    }

    public function getImageById(string $id): Image
    {
        $filePath = implode(DIRECTORY_SEPARATOR, [$this->getImageSchemaDirectory(), $id]);

        if (!file_exists($filePath)) {
        	throw new NotFoundHttpException('No image scheme was found.');
        }

        $image = file_get_contents($filePath);

        if (!$image) {
        	throw new NotFoundHttpException('No image scheme was found.');
        }

        $image = json_decode($image, true);
        $password = $image['password'];
        unset($image['password']);
        $image = json_encode($image);

        return new Image($id, $password, $image);
    }

    public function createImage(string $imageScheme): Image
    {
        $image = $this->imageSchemeFactory->createImageScheme($imageScheme);
        $this->saveImage($image);

        return $image;
    }

    public function saveImage(Image $image): void
    {
        $filePath = implode(DIRECTORY_SEPARATOR, [$this->getImageSchemaDirectory(), $image->getId()]);

        $imageScheme = json_decode($image->getScheme(), true);
        $imageScheme['password'] = $image->getPassword();
        $imageScheme = json_encode($imageScheme);

        file_put_contents($filePath, $imageScheme);
    }

    private function getImageSchemaDirectory(): string
    {
        return implode(DIRECTORY_SEPARATOR, [ROOT_DIRECTORY, 'schemes']);
    }
}
