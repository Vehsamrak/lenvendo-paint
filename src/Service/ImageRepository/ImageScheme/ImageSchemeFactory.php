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

    /**
     * Numeric password generation.
     * @return string
     */
    private function generateRandomPassword(int $passwordLength = 5): string
    {
        $password = '';
        for ($length = 0; $length < $passwordLength; $length++) {
            $password .= chr(rand(48, 57));
        }

        return $password;
    }
}
