<?php

namespace Lenvendo\Canvas\ImageRepository;

/**
 * @author Vehsamrak
 */
interface ImageRepository
{

    public function getImageSchemaById(string $id): string;

    public function saveImageSchema(string $imageSchema): string;
}
