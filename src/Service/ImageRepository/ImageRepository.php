<?php

namespace Lenvendo\Canvas\Service\ImageRepository;

/**
 * @author Vehsamrak
 */
interface ImageRepository
{

    public function getAllImageSchemeIds(): array;
    public function getImageSchemaById(string $id): string;
    public function saveImageSchema(string $imageSchema): string;
}
