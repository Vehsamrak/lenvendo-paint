<?php

namespace Lenvendo\Canvas\Service\ImageRepository;

use Lenvendo\Canvas\Service\ImageRepository\ImageScheme\ImageSchemeFactory;
use Lenvendo\Canvas\Service\ImageRepository\ImageScheme\ImageScheme as ImageScheme;

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

    public function getImageSchemaById(string $id): string
    {
        $imageSchema = json_encode(['test_schema']);

        return $imageSchema;
    }

    public function saveImageSchema(string $image): ImageScheme
    {
        $imageScheme = $this->imageSchemeFactory->createImageScheme();
        $imageSchemeId = $imageScheme->getId();
        $filePath = implode(DIRECTORY_SEPARATOR, [$this->getImageSchemaDirectory(), $imageSchemeId]);

        file_put_contents($filePath, $image);

        return $imageScheme;
    }

    private function getImageSchemaDirectory(): string
    {
        return implode(DIRECTORY_SEPARATOR, [ROOT_DIRECTORY, 'schemes']);
    }
}
