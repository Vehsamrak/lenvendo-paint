<?php

namespace Lenvendo\Canvas\Service\ImageRepository\ImageScheme;

use Lenvendo\Canvas\Service\IdGenerator\IdGenerator;

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

    private function generateRandomPassword(): string
    {
        $password = '';
        $passwordLength = 6;

        for ($length = 0; $length < $passwordLength; $length++) {
            $password .= chr(rand(32, 126));
        }

        return $password;
    }
}
