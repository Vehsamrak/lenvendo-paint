<?php

namespace Lenvendo\Canvas\Service\ImageRepository;

use Lenvendo\Canvas\Service\ImageRepository\ImageScheme\Image;

/**
 * @author Vehsamrak
 */
interface ImageRepository
{

    public function getAllImageSchemeIds(): array;
    public function getImageById(string $id): Image;
    public function saveImageSchema(string $imageSchema): Image;
}
