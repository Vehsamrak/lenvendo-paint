<?php

namespace Lenvendo\Canvas\Service\ImageRepository;

use Lenvendo\Canvas\Service\ImageRepository\ImageScheme\ImageSchemeFactory;
use Lenvendo\Canvas\Service\ImageRepository\ImageScheme\ImageScheme as ImageScheme;
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

    public function getAllImageSchemeIds(): array
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

    public function getImageSchemaById(string $id): ImageScheme
    {
        $filePath = implode(DIRECTORY_SEPARATOR, [$this->getImageSchemaDirectory(), $id]);
        $image = file_get_contents($filePath);

        if (!$image) {
        	throw new NotFoundHttpException('No image scheme was found.');
        }

        $image = json_decode($image, true);
        $password = $image['password'];
        unset($image['password']);
        $image = json_encode($image);

        return new ImageScheme($id, $password, $image);
    }

    public function saveImageSchema(string $image): ImageScheme
    {
        $imageScheme = $this->imageSchemeFactory->createImageScheme($image);
        $imageSchemeId = $imageScheme->getId();
        $filePath = implode(DIRECTORY_SEPARATOR, [$this->getImageSchemaDirectory(), $imageSchemeId]);

        $image = json_decode($image, true);
        $image['password'] = $imageScheme->getPassword();
        $image = json_encode($image);

        file_put_contents($filePath, $image);

        return $imageScheme;
    }

    private function getImageSchemaDirectory(): string
    {
        return implode(DIRECTORY_SEPARATOR, [ROOT_DIRECTORY, 'schemes']);
    }
}
