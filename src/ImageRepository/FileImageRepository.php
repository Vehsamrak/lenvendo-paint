<?php

namespace Lenvendo\Canvas\ImageRepository;

use Lenvendo\Canvas\IdGenerator\IdGenerator;

/**
 * @author Vehsamrak
 */
class FileImageRepository implements ImageRepository
{

    /** @var IdGenerator */
    private $idGenerator;

    public function __construct(IdGenerator $idGenerator)
    {
        $this->idGenerator = $idGenerator;
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

    public function saveImageSchema(string $imageSchema): string
    {
        $imageSchemaId = $this->idGenerator->generateRandomId();
        $fileName = $imageSchemaId . '.json';
        $filePath = implode(DIRECTORY_SEPARATOR, [$this->getImageSchemaDirectory(), $fileName]);

        file_put_contents($filePath, $imageSchema);

        return $imageSchemaId;
    }

    private function getImageSchemaDirectory(): string
    {
        return implode(DIRECTORY_SEPARATOR, [ROOT_DIRECTORY, 'schemes']);
    }
}
