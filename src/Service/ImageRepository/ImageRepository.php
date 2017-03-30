<?php

namespace Lenvendo\Canvas\Service\ImageRepository;

use Lenvendo\Canvas\Service\ImageRepository\ImageScheme\Image;

/**
 * @author Vehsamrak
 */
interface ImageRepository
{

    public function getAllImageIds(): array;
    public function getImageById(string $id): Image;
    public function createImage(string $imageSchema): Image;
    public function saveImage(Image $image): void;
}
