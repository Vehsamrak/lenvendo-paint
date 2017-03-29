<?php

namespace Lenvendo\Canvas\Service\ImageRepository\ImageScheme;

/**
 * @author Vehsamrak
 */
class ImageScheme
{

    private $id;
    private $password;

    public function __construct(string $id, string $password)
    {
        $this->id = $id;
        $this->password = $password;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
