<?php

namespace Lenvendo\Canvas\ImageRepository;

/**
 * @author Vehsamrak
 */
class FileImageRepository implements ImageRepository
{

    public function getImageSchemaById(string $id): string
    {
        $imageSchema = json_encode(['test_schema']);


        return $imageSchema;
    }

    public function saveImageSchema(string $imageSchema): string
    {
        $imageSchemaId = 1;
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
