<?php

namespace Lenvendo\Canvas\Service\ImageRepository;

use Lenvendo\Canvas\Service\ImageRepository\ImageScheme\ImageScheme;

/**
 * @author Vehsamrak
 */
interface ImageRepository
{

    public function getAllImageSchemeIds(): array;
    public function getImageSchemaById(string $id): ImageScheme;
    public function saveImageSchema(string $imageSchema): ImageScheme;
}
