<?php

namespace Lenvendo\Canvas\Service\ImageRepository\ImageScheme;

use Lenvendo\Canvas\Service\IdGenerator\IdGenerator;
use Lenvendo\Canvas\Service\ImageRepository\DTO\ImageScheme;

/**
 * @author Vehsamrak
 */
class ImageSchemeFactory
{

    /** @var IdGenerator */
    private $idGenerator;

    public function __construct(IdGenerator $idGenerator)
    {
        $this->idGenerator = $idGenerator;
    }

    public function createImageScheme(): ImageScheme
    {
        $id = $this->idGenerator->generateRandomId();
        $password = $this->generateRandomPassword();

        return new ImageScheme($id, $password);
    }

    public function generateRandomPassword(): string
    {
        $password = '';
        $passwordLength = 6;

        for ($length = 0; $length < $passwordLength; $length++) {
            $password .= chr(rand(32, 126));
        }

        return $password;
    }
}
